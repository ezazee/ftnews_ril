<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tags;
use Illuminate\Support\Str;
Use Alert;

class TagsController extends Controller
{
    public function create(Request $request)
    {
        $search = $request->input('search');

        $query = Tags::query();
        if ($search) {
            $query->whereRaw('LOWER(nama_tags) LIKE ?', ["%{$search}%"]);
        }

        $tags = $query->orderBy('nama_tags', 'asc')->paginate(20);
        return view('apps.tags', compact('tags'));
    }

    public function store(Request $request)
    {
        $tags = Tags::create([
            'nama_tags' => $request->nama_tags,
            'slug' => Str::slug($request->nama_tags)
          ]);
        Alert::success('Success', 'Add Categori Success');
        return redirect()->route('tags.create')->with('success', 'Category added successfully');
    }

    public function destroy($id)
    {
        $tags = Tags::findorfail($id);
        $tags->delete();

        return redirect()->back()->with('success', 'Category Berhasil Dihapus');
    }

    public function update(Request $request, $id)
    {
        $tags = Tags::findOrFail($id);
        $tags->nama_tags = $request->input('nama_tags');
        $tags->save();
        return redirect()->back()->with('success', 'Category Berhasil Dihapus');
    }

    public function addtag(Request $request)
    {
        $validatedData = $request->validate([
            'nama_tags' => 'required|string|max:255',
        ]);
    
        $tagName = $validatedData['nama_tags'];
    
        $existingTag = Tags::where('nama_tags', $tagName)->first();
        if ($existingTag) {
            return response()->json([
                'success' => false,
                'message' => 'Tag already exists.',
            ], 400);
        }
    
        try {
            $tag = Tags::create([
                'nama_tags' => $tagName,
                'slug' => Str::slug($tagName),
            ]);
    
            return response()->json([
                'success' => true,
                'id' => $tag->id,
                'nama_tags' => $tag->nama_tags,
            ], 201);
    
        } catch (\Exception $e) {
            \Log::error('Tag creation failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding the tag.',
            ], 500);
        }
    }

}
