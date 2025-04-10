<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categori;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageResizeHelper;



class BlogController extends Controller
{
    public function blogPost(Request $request)
    {
        $query = Post::with('kategori', 'user');

        if ($request->has('filter_columns')) {
            foreach ($request->filter_columns as $index => $column) {
                $operator = $request->filter_operators[$index] ?? 'like';
                $value = $request->filter_values[$index] ?? '';

                if (!empty($column) && !empty($value)) {
                    if ($column === 'categori') {
                        $query->whereHas('kategori', function ($q) use ($operator, $value) {
                            if ($operator === 'like') {
                                $value = "%$value%";
                            }
                            $q->where('nama_kategori', $operator, $value);
                        });
                    } elseif ($column === 'author') {
                        $query->whereHas('user', function ($q) use ($operator, $value) {
                            if ($operator === 'like') {
                                $value = "%$value%";
                            }
                            $q->where('name', $operator, $value);
                        });
                    }else {
                        if ($operator === 'like') {
                            $value = "%$value%";
                        }
                        $query->where($column, $operator, $value);
                    }
                }
            }
        }

        $post = $query->latest()->paginate(20);

        return view('backend.pages.blog.posting.index', compact('post'));
    }

    public function editPost($id){
        $post = Post::with('kategori')->findOrFail($id);
        $category = Categori::all();
        $allPosts = collect([$post])->flatten();

        foreach ($allPosts as $singlePost) {
            if ($singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }

        return view('backend.pages.blog.posting.edit',compact('post','category'));
    }
    public function createPost() {
        $category = Categori::all();
        return view('backend.pages.blog.posting.create',compact('category'));
    }

    public function PostAdd(Request $request) {
        $validatedData = $request->validate([
            'short_description' => 'nullable|string',
            'content' => 'required|string',
            'headline' => 'nullable|string|in:yes,no',
            'banner_image' => 'required|url',
        ]);

            $post = Post::create([
                'title' => $request->input('title'),
                'slug' => Str::slug($request->input('title')),
                'short_description' => $request->input('short_description'),
                'image_caption' => $request->input('image_caption'),
                'content' => $request->input('content'),
                'keyword' => $request->input('seo_meta.seo_title'),
                'description' => $request->input('seo_meta.seo_description'),
                'start_date' => \Carbon\Carbon::parse($request->input('scheduled_date'))->format('Y-m-d'),
                'start_time' => \Carbon\Carbon::parse($request->input('scheduled_time'))->format('H:i'),
                'status' => $request->input('status'),
                'headline' => $request->input('headline', 'no'),
                'kategori_id' => $request->input('categories'),
                'gambar' => $request->input('banner_image'),
                'user_id' => Auth::id(),
            ]);

            $tags = json_decode($request->input('tag'), true);
            if ($tags && is_array($tags)) {
                $tagIds = [];
                foreach ($tags as $tag) {
                    if (!empty($tag['value'])) {
                        $slug = Str::slug($tag['value']);

                        $tagModel = Tag::firstOrCreate(
                            ['nama_tags' => $tag['value']],
                            ['slug' => $slug]
                        );
                        $tagIds[] = $tagModel->id;
                    }
                }

                $post->tags()->sync($tagIds);
            }
        Alert::success('Success', 'Post added successfully!!');
        return redirect()->back()->with('success', 'post Added successfully.');
    }

    // NEW
    // public function PostAdd(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'slug' => 'nullable|string|max:255|unique:posts,slug',
    //         'short_description' => 'nullable|string',
    //         'content' => 'required|string',
    //         'headline' => 'nullable|string|in:yes,no',
    //         'categories' => 'required|integer|exists:categories,id',
    //         'banner_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    //         'tag' => 'required|json',
    //     ]);

    //     if ($request->hasFile('banner_image')) {
    //         $image = $request->file('banner_image');
    //         $filename = time() . '.' . $image->getClientOriginalExtension();
    //         $thumbFilename = time() . '_thumb.' . $image->getClientOriginalExtension();

    //         $filePath = $image->getRealPath();
    //         if (ImageResizeHelper::isDuplicateFile($filePath, 'public/gambar')) {
    //             return redirect()->back()->with('error', 'File gambar sudah ada di sistem.');
    //         }

    //         $imagePaths = ImageResizeHelper::resizeImage($image, $filename, $thumbFilename);

    //         if (isset($imagePaths['error'])) {
    //             return redirect()->back()->with('error', $imagePaths['error']);
    //         }
    //     } else {
    //         return redirect()->back()->with('error', 'Gambar wajib diunggah.');
    //     }

    //     $post = Post::create([
    //         'title' => $request->input('title'),
    //         'slug' => $request->input('slug', Str::slug($request->input('title'))),
    //         'short_description' => $request->input('short_description'),
    //         'image_caption' => $request->input('image_caption'),
    //         'content' => $request->input('content'),
    //         'keyword' => $request->input('seo_meta.seo_title'),
    //         'description' => $request->input('seo_meta.seo_description'),
    //         'start_date' => \Carbon\Carbon::parse($request->input('scheduled_date'))->format('Y-m-d'),
    //         'start_time' => \Carbon\Carbon::parse($request->input('scheduled_time'))->format('H:i'),
    //         'status' => $request->input('status'),
    //         'headline' => $request->input('headline', 'no'),
    //         'kategori_id' => $request->input('categories'),
    //         'gambar' => 'storage/gambar/' . $filename,
    //         'thumbs' => 'storage/photos/shares' . $thumbFilename,
    //         'user_id' => Auth::id(),
    //     ]);

    //     $tags = json_decode($request->input('tag'), true);
    //     if ($tags && is_array($tags)) {
    //         $tagIds = [];
    //         foreach ($tags as $tag) {
    //             if (!empty($tag['value'])) {
    //                 $slug = Str::slug($tag['value']);

    //                 $tagModel = Tag::firstOrCreate(
    //                     ['nama_tags' => $tag['value']],
    //                     ['slug' => $slug]
    //                 );
    //                 $tagIds[] = $tagModel->id;
    //             }
    //         }

    //         $post->tags()->sync($tagIds);
    //     }

    //     Alert::success('Success', 'Post added successfully!!');
    //     return redirect()->back()->with('success', 'Post added successfully.');
    // }


    public function PostUpdate(Request $request, $id) {
        // dd($request);
        $post = Post::findOrFail($id);

        $post->update([
            'title' => $request->input('title'),
            'short_description' => $request->input('short_description'),
            'content' => $request->input('content'),
            'image_caption' => $request->input('image_caption'),
            'keyword' => $request->input('seo_meta.seo_title'),
            'description' => $request->input('seo_meta.seo_description'),
            'start_date' => \Carbon\Carbon::parse($request->input('scheduled_date'))->format('Y-m-d'),
            'start_time' => \Carbon\Carbon::parse($request->input('scheduled_time'))->format('H:i'),
            'status' => $request->input('status'),
            'headline' => $request->input('headline', 'no'),
            'kategori_id' => $request->input('categories'),
            'gambar' => $request->input('banner_image'),
        ]);

        $tags = json_decode($request->input('tag'), true);
        if ($tags && is_array($tags)) {
            $tagIds = [];
            foreach ($tags as $tag) {
                if (!empty($tag['value'])) {
                    $slug = Str::slug($tag['value']);

                    $tagModel = Tag::firstOrCreate(
                        ['nama_tags' => $tag['value']],
                        ['slug' => $slug]
                    );
                    $tagIds[] = $tagModel->id;
                }
            }

            $post->tags()->sync($tagIds);
        }

        Alert::success('Success', 'Post updated successfully!!');
        return redirect()->back()->with('success', 'post Added successfully.');
    }


    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        Alert::error('Delete', 'Post Deleted!!');
        return redirect()->route('blog.post')->with('success', 'Post deleted successfully.');
    }

}
