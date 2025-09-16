<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categori;
use App\Models\Reporter;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageResizeHelper;
use \App\Models\ImageMetadata;
use App\Models\Log;

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
                    $value = strtolower($value);

                    if ($column === 'categori') {
                        $query->whereHas('kategori', function ($q) use ($operator, $value) {
                            if ($operator === 'like') {
                                $value = "%$value%";
                            }
                            $q->whereRaw('LOWER(nama_kategori) ' . $operator . ' ?', [$value]);
                        });
                    } elseif ($column === 'author') {
                        $query->whereHas('user', function ($q) use ($operator, $value) {
                            if ($operator === 'like') {
                                $value = "%$value%";
                            }
                            $q->whereRaw('LOWER(name) ' . $operator . ' ?', [$value]);
                        });
                    }elseif ($column === 'created_at') {
                        $input = str_replace('/', '-', $value);
                        $parts = explode('-', $input);

                        $searchPattern = '';

                        if (count($parts) === 3) {
                            [$d, $m, $y] = $parts;
                            $searchPattern = "$y-$m-$d";
                        } elseif (count($parts) === 2) {
                            [$d, $m] = $parts;
                            $searchPattern = "-$m-$d";
                        } elseif (strlen($input) === 2 || strlen($input) === 1) {
                            $searchPattern = "-$input";
                        } elseif (strlen($input) === 4) {
                            $searchPattern = "$input-";
                        } else {
                            $searchPattern = $value;
                        }

                        $query->whereRaw("CAST(created_at AS TEXT) ILIKE ?", ["%$searchPattern%"]);
                    }else {
                        if ($operator === 'like') {
                            $value = "%$value%";
                        }
                        $query->whereRaw('LOWER(' . $column . ') ' . $operator . ' ?', [$value]);
                    }
                }
            }
        }

        $filters = $request->all();

        $post = $query->latest()->paginate(20)->appends($filters);

        return view('backend.pages.blog.posting.index', compact('post'));
    }

    public function editPost($id){
        $post = Post::with('kategori','reporter')->findOrFail($id);
        $category = Categori::all();
        $allPosts = collect([$post])->flatten();
        $reporter = Reporter::where(function ($query) use ($post) {
            $query->where('is_deleted', 'no');
            
            if ($post->reporter_id) {
                $query->orWhere('id', $post->reporter_id);
            }
        })->get();


        foreach ($allPosts as $singlePost) {
            if ($singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }

        return view('backend.pages.blog.posting.edit',compact('post','category','reporter'));
    }

    public function createPost()
    {
        $category = Categori::all();
        $reporter = Reporter::where('is_deleted', 'no')->get();
        return view('backend.pages.blog.posting.create', compact('category','reporter'));
    }



    public function PostAdd(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'banner_image' => 'required',
            ]);

            $bannerImageUrl = $request->input('banner_image');

            $metadata = ImageMetadata::where('comp_url', $bannerImageUrl)->first();

            if ($metadata) {
                if ($request->filled('image_caption')) {
                    $metadata->caption = $request->input('image_caption');
                    $metadata->save();
                }
            }
            
            $post = Post::create([
                'title' => $request->input('title'),
                'slug' => Str::slug($request->input('title')),
                'image_caption' =>  $metadata->caption ?? null,
                'content' => $request->input('content'),
                'keyword' => $request->input('seo_meta.seo_title'),
                'description' => $request->input('seo_meta.seo_description'),
                'start_date' => \Carbon\Carbon::parse($request->input('scheduled_date'))->format('Y-m-d'),
                'start_time' => \Carbon\Carbon::parse($request->input('scheduled_time'))->format('H:i'),
                'status' => $request->input('status'),
                'headline' => $request->input('headline', 'no'),
                'adult' => $request->input('adult', 'no'),
                'kategori_id' => $request->input('categories')[0] ?? null,
                'sub_category_id' => $request->input('subcategories')[0] ?? null,
                'gambar' => $bannerImageUrl,
                'user_id' => Auth::id(),
                'multipages' => $request->input('multipages', 'no'),
                'reporter_id' => $request->input('reporter_id')[0] ?? null,
                'seo' => $request->input('seo', 'no'),
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

            Alert::success('Success', 'Post added successfully!');
            return redirect()->back()->with('success', 'Post Added successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::create([
                'created_datetime'   => now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'title_article'      => $request->input('title'),
                'id_article'         => null,
                'activity'           => 'create_error',
                'user_name'          => Auth::user()->name ?? 'System',
                'user_id'            => Auth::id(),
                'roles'              => optional(Auth::user()->role)->name ?? 'unknown',
                'status'             => 'error',
                'scheduled_time'     => $request->input('scheduled_date').' '.$request->input('scheduled_time'),
                'article_created_at' => null,
                'article_published_at'=> null,
                'message'            => 'Validasi gagal: '.implode(', ', $e->validator->errors()->all())
            ]);

            Alert::warning('Warning', implode(', ', $e->validator->errors()->all()));
            return redirect()->back()->withErrors($e->validator)->withInput();

        } catch (\Exception $e) {
            Log::create([
                'created_datetime'   => now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'title_article'      => $request->input('title'),
                'id_article'         => null,
                'activity'           => 'create_error',
                'user_name'          => Auth::user()->name ?? 'System',
                'user_id'            => Auth::id(),
                'roles'              => optional(Auth::user()->role)->name ?? 'unknown',
                'status'             => 'error',
                'scheduled_time'     => $request->input('scheduled_date').' '.$request->input('scheduled_time'),
                'article_created_at' => null,
                'article_published_at'=> null,
                'message'            => 'Kesalahan: '.$e->getMessage()
            ]);

            Alert::error('Error', 'Terjadi kesalahan: '.$e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function PostUpdate(Request $request, $id) {
    try {
        $post = Post::findOrFail($id);

        $bannerImageUrl = $request->input('banner_image');

        $metadata = ImageMetadata::where('comp_url', $bannerImageUrl)->first();

        if ($metadata) {
            if ($request->filled('image_caption')) {
                $metadata->caption = $request->input('image_caption');
                $metadata->save();
            }
        }

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image_caption' =>  $metadata->caption ?? null,
            'keyword' => $request->input('seo_meta.seo_title'),
            'description' => $request->input('seo_meta.seo_description'),
            'start_date' => \Carbon\Carbon::parse($request->input('scheduled_date'))->format('Y-m-d'),
            'start_time' => \Carbon\Carbon::parse($request->input('scheduled_time'))->format('H:i'),
            'status' => $request->input('status'),
            'headline' => $request->input('headline', 'no'),
            'adult' => $request->input('adult', 'no'),
            'kategori_id' => $request->input('categories')[0] ?? null,
            'sub_category_id' => $request->input('subcategories')[0] ?? null,
            'reporter_id' => $request->input('reporter_id')[0] ?? null,
            'multipages' => $request->input('multipages', 'no'),
            'gambar' => $request->input('banner_image'),
            'seo' => $request->input('seo', 'no')
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

        } catch (\Exception $e) {
            Log::create([
                'created_datetime'     => now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'title_article'        => $request->input('title') ?? ($post->title ?? 'Unknown'),
                'id_article'           => $post->id ?? $id,
                'activity'             => 'update_error',
                'user_name'            => Auth::user()->name ?? 'System',
                'user_id'              => Auth::id(),
                'roles'                => optional(Auth::user()->role)->name ?? 'unknown',
                'status'               => 'error',
                'scheduled_time'       => $request->input('scheduled_date').' '.$request->input('scheduled_time'),
                'article_created_at'   => $post->created_at?->format('Y-m-d H:i:s'),
                'article_published_at' => null,
                'message'              => 'Kesalahan update: '.$e->getMessage()
            ]);

            Alert::error('Error', 'Terjadi kesalahan saat update: '.$e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function deletePost($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            Alert::error('Delete',"Post Deleted!!");
            return redirect()->route('blog.post')->with('success',"Post deleted successfully.");
        } catch (\Exception $e) {
            Log::create([
                'created_datetime'=>now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'title_article'=>'Unknown',
                'id_article'=>$id,
                'activity'=>'delete_error',
                'user_name'=>Auth::user()->name ?? 'System',
                'user_id'=>Auth::id(),
                'roles'=>optional(Auth::user()->role)->name ?? 'unknown',
                'status'=>'error',
                'message'=>'Kesalahan delete: '.$e->getMessage()
            ]);
            Alert::error('Error','Gagal menghapus post: '.$e->getMessage());
            return redirect()->back();
        }
    }


    public function restorePost($id)
    {
        try {
            $post = Post::onlyTrashed()->findOrFail($id);
            $post->restore();

            Log::create([
                'created_datetime'     => now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'title_article'        => $post->title,
                'id_article'           => $post->id,
                'activity'             => 'restore',
                'user_name'            => Auth::user()->name ?? 'System',
                'user_id'              => Auth::id(),
                'roles'                => optional(Auth::user()->role)->name ?? 'unknown',
                'status'               => $post->status,
                'scheduled_time'       => $post->status === 'schedule'
                                            ? "{$post->start_date} {$post->start_time}" : null,
                'article_created_at'   => $post->created_at
                                            ? $post->created_at->format('Y-m-d H:i:s') : null,
                'article_published_at' => $post->status === 'publish'
                                            ? $post->created_at->format('Y-m-d H:i:s') : null,
                'message'              => "Post '{$post->title}' berhasil direstore."
            ]);

            Alert::success('Success', "Post '{$post->title}' berhasil direstore.");
            return redirect()->route('blog.post');

        } catch (\Exception $e) {
            Log::create([
                'created_datetime'   => now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'title_article'      => $post->title ?? 'Unknown',
                'id_article'         => $id,
                'activity'           => 'restore_error',
                'user_name'          => Auth::user()->name ?? 'System',
                'user_id'            => Auth::id(),
                'roles'              => optional(Auth::user()->role)->name ?? 'unknown',
                'status'             => 'error',
                'message'            => "Gagal restore post ID {$id}: " . $e->getMessage(),
            ]);

            Alert::error('Error', 'Gagal merestore post: '.$e->getMessage());
            return redirect()->route('blog.trash');
        }
    }

    public function forceDeletePost($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->forceDelete();
        Alert::error('Delete',"Post '{$post->title}' dihapus permanen.");
        return redirect()->route('blog.post');
    }

    public function trash(Request $request)
    {
        $query = Post::onlyTrashed()->with('kategori', 'user');

        if ($request->has('filter_columns')) {
            foreach ($request->filter_columns as $index => $column) {
                $operator = $request->filter_operators[$index] ?? 'like';
                $value = $request->filter_values[$index] ?? '';

                if (!empty($column) && !empty($value)) {
                    $value = strtolower($value);

                    if ($column === 'categori') {
                        $query->whereHas('kategori', function ($q) use ($operator, $value) {
                            if ($operator === 'like') {
                                $value = "%$value%";
                            }
                            $q->whereRaw('LOWER(nama_kategori) '.$operator.' ?', [$value]);
                        });
                    } elseif ($column === 'author') {
                        $query->whereHas('user', function ($q) use ($operator, $value) {
                            if ($operator === 'like') {
                                $value = "%$value%";
                            }
                            $q->whereRaw('LOWER(name) '.$operator.' ?', [$value]);
                        });
                    } elseif ($column === 'created_at') {
                        $input = str_replace('/', '-', $value);
                        $parts = explode('-', $input);

                        $searchPattern = '';
                        if (count($parts) === 3) {
                            [$d, $m, $y] = $parts;
                            $searchPattern = "$y-$m-$d";
                        } elseif (count($parts) === 2) {
                            [$d, $m] = $parts;
                            $searchPattern = "-$m-$d";
                        } elseif (strlen($input) === 2 || strlen($input) === 1) {
                            $searchPattern = "-$input";
                        } elseif (strlen($input) === 4) {
                            $searchPattern = "$input-";
                        } else {
                            $searchPattern = $value;
                        }

                        $query->whereRaw("CAST(created_at AS TEXT) ILIKE ?", ["%$searchPattern%"]);
                    } else {
                        if ($operator === 'like') {
                            $value = "%$value%";
                        }
                        $query->whereRaw('LOWER('.$column.') '.$operator.' ?', [$value]);
                    }
                }
            }
        }

        $filters = $request->all();
        $trashedPosts = $query->latest()->paginate(20)->appends($filters);

        return view('backend.pages.blog.trash.index', compact('trashedPosts'));
    }


    // Schedule Post Page
    public function schedulePost(Request $request)
    {

        $query = Post::with('kategori', 'user');

        if ($request->has('filter_columns')) {
            foreach ($request->filter_columns as $index => $column) {
                $operator = $request->filter_operators[$index] ?? 'like';
                $value = $request->filter_values[$index] ?? '';

                if (!empty($column) && !empty($value)) {
                    $value = strtolower($value);

                    if ($column === 'categori') {
                        $query->whereHas('kategori', function ($q) use ($operator, $value) {
                            if ($operator === 'like') {
                                $value = "%$value%";
                            }
                            $q->whereRaw('LOWER(nama_kategori) ' . $operator . ' ?', [$value]);
                        });
                    } elseif ($column === 'author') {
                        $query->whereHas('user', function ($q) use ($operator, $value) {
                            if ($operator === 'like') {
                                $value = "%$value%";
                            }
                            $q->whereRaw('LOWER(name) ' . $operator . ' ?', [$value]);
                        });
                    } else {
                        if ($operator === 'like') {
                            $value = "%$value%";
                        }
                        $query->whereRaw('LOWER(' . $column . ') ' . $operator . ' ?', [$value]);
                    }
                }
            }
        }


        $post = $query->where('status','schedule')->latest()->paginate(20);

        return view('backend.pages.blog.schedule.index',compact('post'));
    }


    public function seoPost(Request $request){
        
    $query = Post::with('kategori', 'user');

        if ($request->has('filter_columns')) {
            foreach ($request->filter_columns as $index => $column) {
                $operator = $request->filter_operators[$index] ?? 'like';
                $value = $request->filter_values[$index] ?? '';

                if (!empty($column) && !empty($value)) {
                    $value = strtolower($value);

                    if ($column === 'categori') {
                        $query->whereHas('kategori', function ($q) use ($operator, $value) {
                            if ($operator === 'like') {
                                $value = "%$value%";
                            }
                            $q->whereRaw('LOWER(nama_kategori) ' . $operator . ' ?', [$value]);
                        });
                    } elseif ($column === 'author') {
                        $query->whereHas('user', function ($q) use ($operator, $value) {
                            if ($operator === 'like') {
                                $value = "%$value%";
                            }
                            $q->whereRaw('LOWER(name) ' . $operator . ' ?', [$value]);
                        });
                    }elseif ($column === 'created_at') {
                        $input = str_replace('/', '-', $value);
                        $parts = explode('-', $input);

                        $searchPattern = '';

                        if (count($parts) === 3) {
                            [$d, $m, $y] = $parts;
                            $searchPattern = "$y-$m-$d";
                        } elseif (count($parts) === 2) {
                            [$d, $m] = $parts;
                            $searchPattern = "-$m-$d";
                        } elseif (strlen($input) === 2 || strlen($input) === 1) {
                            $searchPattern = "-$input";
                        } elseif (strlen($input) === 4) {
                            $searchPattern = "$input-";
                        } else {
                            $searchPattern = $value;
                        }

                        $query->whereRaw("CAST(created_at AS TEXT) ILIKE ?", ["%$searchPattern%"]);
                    }else {
                        if ($operator === 'like') {
                            $value = "%$value%";
                        }
                        $query->whereRaw('LOWER(' . $column . ') ' . $operator . ' ?', [$value]);
                    }
                }
            }
        }

        $filters = $request->all();
        
        $post = $query->where('seo', 'yes')->latest()->paginate(20)->appends($filters);


        return view('backend.pages.blog.seo.index',compact('post'));
    }

    public function logviews(Request $request)
    {
        $search = $request->input('search');

        $logs = Log::when($search, function ($query, $search) {
                $query->where('title_article', 'ILIKE', "%{$search}%")
                    ->orWhere('activity', 'ILIKE', "%{$search}%")
                    ->orWhere('user_name', 'ILIKE', "%{$search}%")
                    ->orWhere('roles', 'ILIKE', "%{$search}%")
                    ->orWhere('status', 'ILIKE', "%{$search}%");
            })
            ->orderBy('created_datetime', 'desc')
            ->paginate(25)
            ->appends(['search' => $search]);

        return view('backend.pages.blog.trash.log', compact('logs', 'search'));
    }

}
