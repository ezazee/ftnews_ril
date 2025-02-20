<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tags;
use App\Models\User;
use App\Models\Media;
use App\Models\Post;
use App\Models\SubCategory;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function category($categorySlug, $subCategorySlug = null)
    {
        $category = Category::with('subCateg')->where('slug', $categorySlug)->firstOrFail();
        $subCategory = $subCategorySlug ? SubCategory::where('slug', $subCategorySlug)
            ->where('category_id', $category->id)
            ->firstOrFail() : null;
        $media = Media::all();
        $categories = Category::with('subCateg')->get();
        $postQuery = Post::with('kategori', 'user')->where('kategori_id', $category->id);

        if ($subCategory) {
            $postQuery->where('sub_category_id', $subCategory->id);
        }
        $post = $postQuery->where('status', 'public')->orderBy('created_at', 'desc')->latest()->paginate(15);

        $allPosts = collect([$post->items()])->flatten();

        foreach ($allPosts as $singlePost) {
            if ($singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }

        return view('blog.categori', compact('media', 'categories', 'category', 'subCategory', 'post'));
    }

    public function bytitle($slug)
{
    $populer = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->orderBy('view', 'desc')
        ->take(4)
        ->get();
    
    if ($populer->isEmpty()) {
        $weekCounter = 1;
        while ($populer->isEmpty() && $weekCounter <= 4) {
            $populer = Post::with('kategori', 'user')
                ->where('status', 'public')
                ->whereBetween('created_at', [
                    Carbon::now()->subWeeks($weekCounter)->startOfWeek(),
                    Carbon::now()->subWeeks($weekCounter)->endOfWeek()
                ])
                ->orderBy('view', 'desc')
                ->take(4)
                ->get();
            
            $weekCounter++;
        }
    }
    
    $post = Post::with(['kategori.subCateg', 'user'])->where('slug', $slug)->where('status', 'public')->firstOrFail();
    $postTerkini = Post::with('kategori', 'user')
    ->where('status', 'public')
    ->latest()
    ->take(5)
    ->get();
    
    

    // Regular expressions for embedding content
    $patterns = [
        '/\[embed\](https?:\/\/(?:www\.)?youtube\.com\/watch\?v=([^\s&]+))\[\/embed\]/i' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/$2" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
        '/\[embed\](https?:\/\/(?:www\.)?tiktok\.com\/@[\w\-]+\/video\/(\d+))\[\/embed\]/i' => '<blockquote class="tiktok-embed" cite="$1" data-video-id="$2" style="max-width: 605px;min-width: 325px;"> <section> </section> </blockquote><script async src="https://www.tiktok.com/embed.js"></script>',
        '/\[embed\](https?:\/\/(?:www\.)?instagram\.com\/p\/([^\s\/]+))\[\/embed\]/i' => '<blockquote class="instagram-media" data-instgrm-permalink="$1" data-instgrm-version="12" style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"></blockquote><script async src="//www.instagram.com/embed.js"></script>',
        '/\[embed\](https?:\/\/(?:www\.)?twitter\.com\/[^\s]+\/status\/(\d+))\[\/embed\]/i' => '<blockquote class="twitter-tweet"><a href="$1"></a></blockquote><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>',
        '/\[embed\](https?:\/\/(?:www\.)?facebook\.com\/[^\s]+\/posts\/(\d+))\[\/embed\]/i' => '<iframe src="https://www.facebook.com/plugins/post.php?href=$1&width=500" width="500" height="684" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allow="encrypted-media"></iframe>',
    ];

    // Replace patterns in content
    foreach ($patterns as $pattern => $replacement) {
        $post->content = preg_replace($pattern, $replacement, $post->content);
    }

    $post->increment('view');

    $tagsdetail = $post->tags;
    $categoripost = $post->kategori->subCateg->where('id', $post->sub_category_id)->first();

    $categories = Category::with('subCateg')->get();
    $media = Media::all();

    // Related posts by category and subcategory
    $relatedPosts = Post::where(function ($query) use ($post) {
        $query->where('kategori_id', $post->kategori_id)
              ->where('sub_category_id', $post->sub_category_id);
    })
    ->where('id', '!=', $post->id) 
    ->where('status', 'public') 
    ->take(8)
    ->get();

    // Related posts by tags
    $bacaJugaPosts = Post::whereHas('tags', function ($query) use ($post) {
        $query->whereIn('tags.id', $post->tags->pluck('id'));
    })
    ->where('id', '!=', $post->id)  
    ->where('status', 'public')     
    ->take(2)
    ->get();


    $blockquotes = [];
    foreach ($bacaJugaPosts as $relatedPost) {
        $blockquotes[] = "<div><blockquote>Baca Juga: <a href='" . route('bytitle', $relatedPost->slug) . "' style='color: #50a6d6;'>" . $relatedPost->title . "</a></blockquote></div>";
    }
    
    // $ads = [
    // "<script async src='https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814' crossorigin='anonymous'></script>
    // <ins class='adsbygoogle' style='display:block; text-align:center;' data-ad-layout='in-article' data-ad-format='fluid' data-ad-client='ca-pub-7366174212541814' data-ad-slot='2995019997'></ins>
    // <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>"
    // ];
    
    $contentParagraphs = preg_split('/(<\/?p>|\\n)/', $post->content, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    
    while (count($contentParagraphs) < 7) {
        $contentParagraphs[] = "";
    }
    
    if (count($contentParagraphs) >= 6) {
        if (isset($blockquotes[0])) {
            array_splice($contentParagraphs, 12, 0, $blockquotes[0]); 
        }
    
        if (isset($blockquotes[1])) {
            $blockquoteWithMargin = '<div class="mt-3">' . $blockquotes[1] . '</div>';
            array_splice($contentParagraphs, 25, 0, $blockquoteWithMargin);
        }
    
        if (isset($ads[0])) {
            $blockquoteWithMarginads = '<div class="mt-3">' . $ads[0] . '</div>';
            array_splice($contentParagraphs, 8, 0, $blockquoteWithMarginads);
        }
    
        if (isset($ads[1])) {
            array_splice($contentParagraphs, 20, 0, $ads[1]);
        }
    }
    

    $post->content = implode("", $contentParagraphs);


    $allPosts = collect([$post, $relatedPosts, $populer,$postTerkini])->flatten();

    foreach ($allPosts as $singlePost) {
        if ($singlePost && $singlePost->gambar) {
            $singlePost->gambar = explode('|', $singlePost->gambar);
        }
    }

    return view('blog.detail', compact('post', 'categories', 'categoripost', 'media', 'relatedPosts', 'tagsdetail', 'populer','postTerkini'));
}

    

    public function bytags($slug)
    {
        $tag = Tags::where('slug', $slug)->firstOrFail();
        $post = $tag->posts()->where('status', 'public')->orderBy('created_at', 'desc')->paginate(15);
        $categories = Category::with('subCategories')->get();
        $media = Media::all();
        $postTerkini = Post::with('kategori', 'user')
            ->where('status', 'public')
            ->latest()
            ->take(5)
            ->get();
            
        $populer = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->orderBy('view', 'desc')
        ->take(4)
        ->get();
    
        if ($populer->isEmpty()) {
            $weekCounter = 1;
            while ($populer->isEmpty() && $weekCounter <= 4) {
                $populer = Post::with('kategori', 'user')
                    ->where('status', 'public')
                    ->whereBetween('created_at', [
                        Carbon::now()->subWeeks($weekCounter)->startOfWeek(),
                        Carbon::now()->subWeeks($weekCounter)->endOfWeek()
                    ])
                    ->orderBy('view', 'desc')
                    ->take(4)
                    ->get();
                
                $weekCounter++;
            }
        }

        $allPosts = collect([$populer, $post->items()])->flatten();
        foreach ($allPosts as $singlePost) {
            if ($singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }

        return view('blog.tags', compact('post', 'categories', 'media', 'populer', 'tag', 'postTerkini'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $post = Post::whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($query) . '%'])
            ->where('status', 'public')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        $post->appends(['search' => $query]);
          $populer = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->orderBy('view', 'desc')
        ->take(4)
        ->get();
    
        if ($populer->isEmpty()) {
            $weekCounter = 1;
            while ($populer->isEmpty() && $weekCounter <= 4) {
                $populer = Post::with('kategori', 'user')
                    ->where('status', 'public')
                    ->whereBetween('created_at', [
                        Carbon::now()->subWeeks($weekCounter)->startOfWeek(),
                        Carbon::now()->subWeeks($weekCounter)->endOfWeek()
                    ])
                    ->orderBy('view', 'desc')
                    ->take(4)
                    ->get();
                
                $weekCounter++;
            }
        }      
        $media = Media::all();
        $categories = Category::with('subCategories')->get();

        $allPosts = collect([$populer, $post->items()])->flatten();
        foreach ($allPosts as $singlePost) {
            if ($singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }
        return view('blog.search-results', compact('post', 'query', 'populer', 'media', 'categories'));
    }


    public function byauthor($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        $posts = Post::where('user_id', $user->id)
            ->with('kategori', 'user')
            ->where('status', 'public')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $postCount = $posts->total();

        $categories = Category::with('subCateg')->get();
        $media = Media::all();

        $allPosts = collect([$posts->items()])->flatten();
        foreach ($allPosts as $singlePost) {
            if ($singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }

        return view('blog.author', compact('categories', 'media', 'user', 'posts', 'postCount'));
    }

    public function byindex()
    {
        $post = Post::where('status', 'public')
        ->orderBy('created_at', 'desc')
        ->paginate(17);
        
         $populer = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->orderBy('view', 'desc')
        ->take(4)
        ->get();
    
        if ($populer->isEmpty()) {
            $weekCounter = 1;
            while ($populer->isEmpty() && $weekCounter <= 4) {
                $populer = Post::with('kategori', 'user')
                    ->where('status', 'public')
                    ->whereBetween('created_at', [
                        Carbon::now()->subWeeks($weekCounter)->startOfWeek(),
                        Carbon::now()->subWeeks($weekCounter)->endOfWeek()
                    ])
                    ->orderBy('view', 'desc')
                    ->take(4)
                    ->get();
                
                $weekCounter++;
            }
        }   
        $media = Media::all();
        $categories = Category::with('subCategories')->get();
        $postTerkini = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->latest()
        ->take(5)
        ->get();

        $allPosts = collect([$populer,$postTerkini, $post->items()])->flatten();

        foreach ($allPosts as $singlePost) {
            if ($singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }

        return view('blog.byindex',compact('post', 'populer', 'media', 'categories','postTerkini'));
    }
    
    public function slim()
    {
        $categories = Category::with('subCategories')->get();
        $media = Media::all();
        $populer = Post::with('kategori', 'user')
            ->where('status', 'public')
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->orderBy('view', 'desc')
            ->take(4)
            ->get();

        if ($populer->isEmpty()) {
            $weekCounter = 1;
            while ($populer->isEmpty() && $weekCounter <= 4) {
                $populer = Post::with('kategori', 'user')
                    ->where('status', 'public')
                    ->whereBetween('created_at', [
                        Carbon::now()->subWeeks($weekCounter)->startOfWeek(),
                        Carbon::now()->subWeeks($weekCounter)->endOfWeek()
                    ])
                    ->orderBy('view', 'desc')
                    ->take(4)
                    ->get();

                $weekCounter++;
            }
        }
        $postTerkini = Post::with('kategori', 'user')
            ->where('status', 'public')
            ->latest()
            ->take(4)
            ->get();

            $allPosts = collect([$populer, $postTerkini])->flatten();
            foreach ($allPosts as $singlePost) {
                if ($singlePost && $singlePost->gambar) {
                    $singlePost->gambar = explode('|', $singlePost->gambar);
                }
            }

        return view('blog.slim', compact('categories', 'media', 'populer', 'postTerkini'));
    }
    
    
    public function by404()
    {
        $categories = Category::with('subCategories')->get();
        $media = Media::all();
        $populer = Post::with('kategori', 'user')
            ->where('status', 'public')
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->orderBy('view', 'desc')
            ->take(4)
            ->get();

        if ($populer->isEmpty()) {
            $weekCounter = 1;
            while ($populer->isEmpty() && $weekCounter <= 4) {
                $populer = Post::with('kategori', 'user')
                    ->where('status', 'public')
                    ->whereBetween('created_at', [
                        Carbon::now()->subWeeks($weekCounter)->startOfWeek(),
                        Carbon::now()->subWeeks($weekCounter)->endOfWeek()
                    ])
                    ->orderBy('view', 'desc')
                    ->take(4)
                    ->get();

                $weekCounter++;
            }
        }
        $postTerkini = Post::with('kategori', 'user')
            ->where('status', 'public')
            ->latest()
            ->take(4)
            ->get();

            $allPosts = collect([$populer, $postTerkini])->flatten();
            foreach ($allPosts as $singlePost) {
                if ($singlePost && $singlePost->gambar) {
                    $singlePost->gambar = explode('|', $singlePost->gambar);
                }
            }

        return view('errors.temp404', compact('categories', 'media', 'populer', 'postTerkini'));
    }

}
