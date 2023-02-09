<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Buku;

class HomeController extends Controller
{
    public function index()
    {
        $buku = Buku::stok();
        $buku = Helper::paginate($buku);
        $title = "Home";
        return view('home', compact("buku", "title"));
    }

    public function semua()
    {
        $buku = Buku::stok();
        $buku = Helper::paginate($buku)->withPath("semua-buku");
        $title = "Semua Buku";
        return view('semua-buku', compact("buku", "title"));
    }

    public function tersedia()
    {
        $buku = Buku::stok()->filter(function ($item) {
            return $item->tersedia > 0;
        });
        $buku = Helper::paginate($buku)->withPath("buku-tersedia");
        $title = "Buku Tersedia";
        return view('buku-tersedia', compact("buku", "title"));
    }

    public function dipinjam()
    {
        $buku = Buku::stok()->filter(function ($item) {
            return $item->dipinjam > 0;
        });
        $buku = Helper::paginate($buku)->withPath('buku-dipinjam');
        $title = "Buku Dipinjam";
        return view('buku-dipinjam', compact("buku", "title"));
    }
}