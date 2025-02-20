<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\SubCategory;
Use Alert;

class CategoryController extends Controller
{
    public function create()
    {
        $category = Category::with('subCateg')->paginate(10);
        return view('apps.categori', compact('category'));
    }

    public function store(Request $request)
    {

        // $request->validate([
        //     'name' => 'required|string|max:255',
        // ]);
        
        $category = Category::create([
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori)
          ]);
          Alert::success('Success', 'Add Categori Success');
        return redirect()->route('categori.create')->with('success', 'Category added successfully');
    }

    public function edit($id)
    {
        $category = Category::findorfail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'name' => 'required|min:3'
      ]);

      $category_data = [
        'name' => $request->name,
        'slug' => Str::slug($request->name)
      ];

      Category::whereId($id)->update($category_data);

      return redirect()->route('category.index')->with('success', 'Category Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $category = Category::findorfail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category Berhasil Dihapus');
    }
    
    public function getSubcategories($categoryId)
    {
        try {
            $subcategories = SubCategory::where('category_id', $categoryId)->get();
            
            if ($subcategories->isEmpty()) {
                return response()->json(['message' => 'No subcategories found'], 404);
            }

            return response()->json($subcategories);
        } catch (\Exception $e) {
            \Log::error('Tidak ada subcategori ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch subcategories'], 500);
        }
    }
}
