<?php

namespace App\Http\Controllers;
use App\Models\SubCategory;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function store(Request $request)
    {
        SubCategory::create([
            'nama_sub_kategori' => $request->nama_sub_kategori,
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->nama_sub_kategori)
        ]);

        return redirect()->back()->with('success', 'Sub Kategori berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();

        return redirect()->back()->with('success', 'Subcategory deleted successfully.');
    }

}
