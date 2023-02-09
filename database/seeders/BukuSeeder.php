<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buku = [
            [
                "isbn" => "9786028519939",
                "judul" => "Sampel Judul",
                "gambar" => null,
                "penulis" => "Sampel Penulis",
                "tahun_terbit" => "2013",
                "penerbit" => "Sampel Penerbit",
                "jumlah" => 3,
                "resume" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsam quia voluptatem cupiditate ratione, laborum aut et sequi temporibus minima at consequatur inventore amet accusantium fugit iure laudantium accusamus incidunt itaque?",
            ],
            [
                "isbn" => "9786028519938",
                "judul" => "Sampel Judul 1",
                "gambar" => null,
                "penulis" => "Sampel Penulis 1",
                "tahun_terbit" => "2013",
                "penerbit" => "Sampel Penerbit 1",
                "jumlah" => 3,
                "resume" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsam quia voluptatem cupiditate ratione, laborum aut et sequi temporibus minima at consequatur inventore amet accusantium fugit iure laudantium accusamus incidunt itaque?",
            ],
            [
                "isbn" => "9786028519933",
                "judul" => "Sampel Judul 2",
                "gambar" => null,
                "penulis" => "Sampel Penulis 2",
                "tahun_terbit" => "2013",
                "penerbit" => "Sampel Penerbit 2",
                "jumlah" => 3,
                "resume" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsam quia voluptatem cupiditate ratione, laborum aut et sequi temporibus minima at consequatur inventore amet accusantium fugit iure laudantium accusamus incidunt itaque?",
            ],
            [
                "isbn" => "9786028519937",
                "judul" => "Sampel Judul 3",
                "gambar" => null,
                "penulis" => "Sampel Penulis 3",
                "tahun_terbit" => "2013",
                "penerbit" => "Sampel Penerbit 3",
                "jumlah" => 3,
                "resume" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsam quia voluptatem cupiditate ratione, laborum aut et sequi temporibus minima at consequatur inventore amet accusantium fugit iure laudantium accusamus incidunt itaque?",
            ],
            [
                "isbn" => "9786028519936",
                "judul" => "Sampel Judul 4",
                "gambar" => null,
                "penulis" => "Sampel Penulis 4",
                "tahun_terbit" => "2013",
                "penerbit" => "Sampel Penerbit 4",
                "jumlah" => 3,
                "resume" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsam quia voluptatem cupiditate ratione, laborum aut et sequi temporibus minima at consequatur inventore amet accusantium fugit iure laudantium accusamus incidunt itaque?",
            ],
            [
                "isbn" => "9786028519935",
                "judul" => "Sampel Judul 5",
                "gambar" => null,
                "penulis" => "Sampel Penulis 5",
                "tahun_terbit" => "2013",
                "penerbit" => "Sampel Penerbit 5",
                "jumlah" => 3,
                "resume" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsam quia voluptatem cupiditate ratione, laborum aut et sequi temporibus minima at consequatur inventore amet accusantium fugit iure laudantium accusamus incidunt itaque?",
            ],
            [
                "isbn" => "9786028519934",
                "judul" => "Sampel Judul 6",
                "gambar" => null,
                "penulis" => "Sampel Penulis 6",
                "tahun_terbit" => "2013",
                "penerbit" => "Sampel Penerbit 6",
                "jumlah" => 3,
                "resume" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsam quia voluptatem cupiditate ratione, laborum aut et sequi temporibus minima at consequatur inventore amet accusantium fugit iure laudantium accusamus incidunt itaque?",
            ],
        ];

        Buku::insert($buku);
    }
}