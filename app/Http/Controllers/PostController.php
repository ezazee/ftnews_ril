<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tags;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
Use Alert;
use Illuminate\Pagination\LengthAwarePaginator;

class PostController extends Controller
{   
    public function create()
    {
        $categori = Category::with('subCategories')->get();
        return view('project.create', compact('categori'));
    }

    public function store(Request $request)
    { 
        $rules = [
            'title' => 'required|string',
            'images' => 'required|array',
            'image_caption' => 'required|string'
        ];
    
        $request->validate($rules, [
            'title.required' => 'Title is required.',
            'images.required' => 'Images is required.',
            'image_caption.required' => 'Image Caption is required',
            'status.required' => 'Status is required.',
        ]);
    
        $user_id = Auth::id();

        $content = Post::create([
            'title' => $request->title,
            'kategori_id' => $request->category_id,
            'status' => $request->status,
            'headline' => $request->headline ?: 'no',
            'start_date' => Carbon::parse($request->start_date)->format('Y-m-d'),
            'content' => $request->editor_content,
            'image_caption' => $request->image_caption,
            'start_time' => Carbon::parse($request->start_time)->format('H:i'),
            'keyword' => $request->keyword,
            'description' => $request->description,
            'user_id' => $user_id,
            'slug' => Str::slug($request->title),
            'sub_category_id' => $request->subcategory_id ?: null
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
            $content->tags()->attach($tagIds);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $image->getClientOriginalName();
                $path = $image->storeAs('public/images/content', $filename);
                $content->update(['gambar' => str_replace('public/', '', $path)]);
            }
        }
    
        Alert::success('Success', 'Add Post Success');
        return redirect()->back()->with('success', 'Content created successfully.');
    }
    


   public function publishScheduledPosts()
    {
        $nowDate = Carbon::now()->format('Y-m-d');
        $nowTime = Carbon::now()->format('H:i:s');
    
        try {
            // Mengambil post berdasarkan tanggal dan waktu
            $posts = Post::where('status', 'schedule')
                ->where('start_date', '<=', $nowDate)
                ->where('start_time', '<=', $nowTime)
                ->get();
    
            foreach ($posts as $post) {
                $post->update([
                    'status' => 'public',
                    'start_date' => null,
                    'start_time' => null,
                    'created_at' => Carbon::now()
                ]);
            }
    
        } catch (\Exception $e) {
            // Handle exception
        }
    }
}
