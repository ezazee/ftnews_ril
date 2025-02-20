<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tags;
use Carbon\Carbon;
Use Alert;
use Illuminate\Support\Str;

class ListController extends Controller
{
    public function create(Request $request)
    {
        
        $search = $request->input('search');

        $query = Post::with(['kategori.subCateg', 'user']);
        if ($search) {
            $query->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($search) . '%']);
        }
    
        $post = $query->where('status', 'public')->orderBy('id', 'desc')->paginate(15);

        return view('project.list',compact('post'));
    }

    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $categori = Category::with('subCategories')->get();
        
        $selectedTagIds = session()->get('selected_tags', []);    
        $tagsQuery = Tags::orderBy('nama_tags', 'asc');
        if (!empty($selectedTagIds)) {
            $tagsQuery->orderByRaw('CASE WHEN id IN (' . implode(',', $selectedTagIds) . ') THEN 0 ELSE 1 END');
        }

        $tags = $tagsQuery->get();
    
        $selectedTags = $post->tags->pluck('id')->toArray();
    
        $sortedTags = $tags->sortByDesc(function ($tag) use ($selectedTags) {
            return in_array($tag->id, $selectedTags) ? 1 : 0;
        });
        
        return view('project.edit', compact('categori', 'sortedTags', 'post'));
    }
    
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            // 'slug' => Str::slug($request->input('title')),
            'image_caption' => $request->input('image_caption'),
            'kategori_id' => $request->input('category_id'),
            'sub_category_id' => $request->input('subcategory_id'),
            'status' => $request->input('status'),
            'headline' => $request->input('headline') ?: 'no',
            'start_date' => Carbon::parse($request->input('start_date'))->format('Y-m-d'),
            'start_time' => Carbon::parse($request->input('start_time'))->format('H:i:s'),
            'keyword' => $request->input('keyword'),
            'description' => $request->input('description'),
        ]);

        $tags = $request->input('tags');
        $tagIds = [];
        if ($tags) {
            $tagNames = explode(',', $tags);
            foreach ($tagNames as $tagName) {
                $tagName = trim($tagName);
                $tagSlug = Str::slug($tagName, '-');
                $tag = Tags::firstOrCreate(['slug' => $tagSlug], ['nama_tags' => $tagName]);
                $tagIds[] = $tag->id;
            }
            $post->tags()->sync($tagIds); 
        } else {
            $post->tags()->detach();
        }


        if ($request->hasFile('images')) {
            $oldImages = explode(',', $post->gambar);
            foreach ($oldImages as $oldImage) {
                $oldImagePath = public_path('storage/images/content/' . $oldImage);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
    
            $newImagePaths = [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '-' . $image->getClientOriginalName();
                $path = $image->storeAs('public/images/content', $filename);
                $newImagePaths[] = str_replace('public/', '', $path);
            }
    
            $post->gambar = implode(',', $newImagePaths);
            $post->save();
        }

        Alert::success('Success', 'Post updated successfully.');
        return redirect()->back()->with('success', 'Post Berhasil Diupdate');
    }


    public function destroy(string $id)
    {
        $post = Post::findorfail($id);
        $post->delete();

        return redirect()->back()->with('success', 'Category Berhasil Dihapus');
    }


    public function private(Request $request)
    {
        $search = $request->input('search');
        
        $userId = auth()->id(); 
        $isAdmin = auth()->user()->role === 'admin';
        
        $query = Post::with(['kategori.subCateg', 'user'])
                    ->where(function($q) use ($userId, $isAdmin) {
                        $q->where('user_id', $userId)
                        ->orderby('created_at', 'desc')
                        ->orderBy('id', 'desc')
                        ->orWhere(function($q) use ($isAdmin) {
                            if ($isAdmin) {
                                $q->where('status', 'private');
                            }
                        });
                    })
                    ->where('status', 'private');
        
        if ($search) {
            $query->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($search) . '%']);
        }
        
        $post = $query->paginate(15);
        
        return view('project.privatelist', compact('post'));
    }

    public function mypost(Request $request)
    {
        $search = $request->input('search');
        $userId = auth()->id();

        $query = Post::with(['kategori.subCateg', 'user'])
                    ->where('user_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->orderBy('id', 'desc'); 

        if ($search) {
            $query->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($search) . '%']);
        }

        $post = $query->paginate(15);

        return view('project.mypost', compact('post'));
    }

}
