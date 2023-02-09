<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "useSidebar" => false,
            "title" => "Manajemen Buku"
        ];
        return view("manajemen-buku", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            "useSidebar" => false,
            "title" => "Tambah Buku"
        ];
        return view("tambah-buku", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            "isbn" => "required|max:13|unique:buku,isbn",
            "judul" => "required|max:128",
            "jumlah" => "required|numeric",
            "penerbit" => "required|max:128",
            "penulis" => "required|max:64",
            "resume" => "present",
            "tahun_terbit" => "required|numeric",
            "gambar" => "required|array",
            "gambar.*" => "required|mimes:jpeg,png,jpg,pdf|max:10240",
        ];
        $attributeNames = [
            "isbn" => "ISBN",
            "judul" => "Judul",
            "jumlah" => "Jumlah",
            "penerbit" => "Penerbit",
            "penulis" => "Penulis",
            "resume" => "Resume",
            "tahun_terbit" => "Tahun Terbit",
            "gambar" => "Gambar",
            "gambar.*" => "Item Gambar",
        ];
        $customMessages = [
            "gambar.*.mimes" => ":attribute tidak valid atau bukan berkas berjenis: :values.",
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->setCustomMessages($customMessages);
        if ($validator->fails()) {
            return [
                "validation" => $validator->errors()
            ];
        }

        Log::info("Start BukuController->store()", ["request" => $request->all()]);
        try {
            $isbn = $request->input("isbn");
            $judul = $request->input("judul");
            $jumlah = $request->input("jumlah");
            $penerbit = $request->input("penerbit");
            $penulis = $request->input("penulis");
            $resume = $request->input("resume");
            $tahunTerbit = $request->input("tahun_terbit");
            $resume = $request->input("resume");
            $gambar = $request->file("gambar");

            $uploadedGambar = Helper::saveFiles(
                files: $gambar,
                argPath: "buku",
                argName: Str::slug($judul)
            );

            $buku = new Buku();
            $buku->isbn = $isbn;
            $buku->judul = $judul;
            $buku->jumlah = $jumlah;
            $buku->penerbit = $penerbit;
            $buku->penulis = $penulis;
            $buku->resume = $resume;
            $buku->tahun_terbit = $tahunTerbit;
            $buku->resume = $resume;
            $buku->gambar = $uploadedGambar;
            $buku->save();

            Helper::flashMessage(
                title: "Berhasil menambahkan buku baru!",
                icon: "success"
            );
            Log::info("End BukuController->store()");
            return response()->json([
                "redirect" => URL::to("manajemen-buku")
            ], 200);
        } catch (Throwable $t) {
            $message = "Error on BukuController->store() | " . $t->getMessage();
            Log::error($message, ["message" => $message, "trace" => $t->getTraceAsString()]);
            return $message;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            "useSidebar" => false,
            "title" => "Detail Buku",
            "buku" => Buku::find($id),
        ];
        return view("detail-buku", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            "useSidebar" => false,
            "title" => "Edit Buku",
            "buku" => Buku::find($id),
        ];
        return view("edit-buku", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            "isbn" => "required|max:13",
            "judul" => "required|max:128",
            "jumlah" => "required|numeric",
            "penerbit" => "required|max:128",
            "penulis" => "required|max:64",
            "resume" => "present",
            "tahun_terbit" => "required|numeric",
            "gambar" => "nullable|array",
            "gambar.*" => "nullable|mimes:jpeg,png,jpg,pdf|max:10240",
        ];
        $attributeNames = [
            "isbn" => "ISBN",
            "judul" => "Judul",
            "jumlah" => "Jumlah",
            "penerbit" => "Penerbit",
            "penulis" => "Penulis",
            "resume" => "Resume",
            "tahun_terbit" => "Tahun Terbit",
            "gambar" => "Gambar",
            "gambar.*" => "Item Gambar",
        ];
        $customMessages = [
            "gambar.*.mimes" => ":attribute tidak valid atau bukan berkas berjenis: :values.",
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->setCustomMessages($customMessages);
        if ($validator->fails()) {
            return [
                "validation" => $validator->errors()
            ];
        }

        Log::info("Start BukuController->update()", ["request" => $request->all()]);
        try {
            $isbn = $request->input("isbn");
            $judul = $request->input("judul");
            $jumlah = $request->input("jumlah");
            $penerbit = $request->input("penerbit");
            $penulis = $request->input("penulis");
            $resume = $request->input("resume");
            $tahunTerbit = $request->input("tahun_terbit");
            $resume = $request->input("resume");
            $gambar = $request->file("gambar");

            $buku = Buku::find($id);
            if ($buku->isbn != $isbn) {
                if (Buku::where("isbn", $isbn)->exists()) {
                    return Helper::sendResponse(["message" => "ISBN $isbn ini telah digunakan"]);
                }
            }

            if ($gambar) {
                $uploadedGambar = Helper::saveFiles(
                    files: $gambar,
                    argPath: "buku",
                    argName: Str::slug($judul)
                );

                if ($uploadedGambar) {
                    if ($buku->gambar) {
                        foreach ($buku->gambar as $item) {
                            Storage::delete($item["path"] . "/" . $item["name"]);
                        }
                    }
                    $buku->gambar = $uploadedGambar;
                }
            }

            $buku->isbn = $isbn;
            $buku->judul = $judul;
            $buku->jumlah = $jumlah;
            $buku->penerbit = $penerbit;
            $buku->penulis = $penulis;
            $buku->resume = $resume;
            $buku->tahun_terbit = $tahunTerbit;
            $buku->resume = $resume;
            $buku->save();

            Helper::flashMessage(
                title: "Berhasil mengubah data buku!",
                icon: "success"
            );
            Log::info("End BukuController->update()");
            return response()->json([
                "redirect" => URL::to("manajemen-buku")
            ], 200);
        } catch (Throwable $t) {
            $message = "Error on BukuController->update() | " . $t->getMessage();
            Log::error($message, ["message" => $message, "trace" => $t->getTraceAsString()]);
            return $message;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::find($id);
        if ($buku->gambar) {
            foreach ($buku->gambar as $item) {
                Storage::delete($item["path"] . "/" . $item["name"]);
            }
        }
        $buku->delete();
        return Helper::jsonMessage(title: "Data berhasil dihapus!", icon: "success");
    }

    public function datatable()
    {
        $buku = Buku::all();
        return DataTables::of($buku)
            ->addColumn('action', function ($data) {
                $html = "<a href='" . url("manajemen-buku/{$data->id}") . "' class='m-1 btn btn-info' title='Detail Buku'><i class='fa fa-info-circle'></i></a>
                            <a href='" . url("manajemen-buku/{$data->id}/edit") . "' class='m-1 btn btn-warning' title='Edit Buku'><i class='fas fa-pencil-alt'></i></a>
                            <a href='javascript;' data-id='{$data->id}' class='m-1 btn btn-danger btn-hapus-buku' title='Hapus Buku'><i class='fas fa-trash'></i></a>
                            ";
                return $html;
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}