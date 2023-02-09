<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = "buku";
    protected $casts = ["gambar" => "array"];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, "id_buku");
    }

    public static function stok()
    {
        return Buku::with(["peminjaman" => function ($query) {
            $query->where("tgl_kembali", null);
        }])->get()->transform(function ($item, $key) {
            $item->tersedia = $item->jumlah - $item->peminjaman->count();
            $item->dipinjam = $item->peminjaman->count();
            return $item;
        });
    }
}