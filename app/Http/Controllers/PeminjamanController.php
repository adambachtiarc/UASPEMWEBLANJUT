<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Throwable;

class PeminjamanController extends Controller
{
    public function pinjamBuku($id)
    {
        Log::info("Start PeminjamanController->pinjamBuku()", ["id_buku" => $id]);
        try {
            $peminjaman = new Peminjaman();
            $peminjaman->id_buku = $id;
            $peminjaman->tgl_pinjam = date("Y-m-d H:i:s");
            $peminjaman->save();

            Helper::flashMessage(
                title: "Peminjaman buku berhasil!",
                icon: "success"
            );
            Log::info("End PeminjamanController->pinjamBuku()");
            return redirect()->back();
        } catch (Throwable $t) {
            $message = "Error on PeminjamanController->pinjamBuku() | " . $t->getMessage();
            Log::error($message, ["message" => $message, "trace" => $t->getTraceAsString()]);
            return $message;
        }
    }

    public function kembalikanBuku($id)
    {
        Log::info("Start PeminjamanController->kembalikanBuku()", ["id_buku" => $id]);
        try {
            $peminjaman = Peminjaman::firstWhere(["id_buku" => $id, "tgl_kembali" => null]);
            $peminjaman->tgl_kembali = date("Y-m-d H:i:s");
            $peminjaman->save();

            Helper::flashMessage(
                title: "Pengembalian buku berhasil!",
                icon: "success"
            );
            Log::info("End PeminjamanController->kembalikanBuku()");
            return redirect()->back();
        } catch (Throwable $t) {
            $message = "Error on PeminjamanController->kembalikanBuku() | " . $t->getMessage();
            Log::error($message, ["message" => $message, "trace" => $t->getTraceAsString()]);
            return $message;
        }
    }
}