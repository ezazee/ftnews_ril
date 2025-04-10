<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Categori;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $category = [
            ['nama_kategori' => 'Flexing']
        ];

        foreach ($category as $cat) {
            $cat['slug'] = Str::slug($cat['nama_kategori']);
            Categori::create($cat);
        }
    }
}
