<?php

namespace App\Http\Controllers;

use Jenssegers\Agent\Agent;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Categori;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    protected $agent;

    public function __construct()
    {
        $this->agent = new Agent();
    }

    public function index()
    {
        $usedPostIds = [];

        $postheadline = Post::with('kategori', 'subCategory', 'user')
        ->where('headline', 'yes')
        ->where('status', 'public')
        ->whereNotIn('id', $usedPostIds)
        ->orderBy('id', 'desc')
        ->take(15)
        ->get();

        $topPostheadline = $postheadline->shift();

        $otherPostsheadline = $postheadline;

        $usedPostIds = array_merge($usedPostIds, $postheadline->pluck('id')->toArray());

        if ($topPostheadline) {
            $usedPostIds[] = $topPostheadline->id;
        }

        $postTerkini = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->latest()
        ->take(5)
        ->get();

        $postTerpopuler = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->orderBy('view', 'desc')
        ->take(5)
        ->get();

        $getPostByCategory = function($categoryName, $limit = 6) use (&$usedPostIds) {
            $posts = Post::with('kategori','user')
                ->whereHas('kategori', function ($query) use ($categoryName) {
                    $query->where('nama_kategori', $categoryName);
                })
                ->whereNotIn('id', $usedPostIds)
                ->where('status', 'public')
                ->latest()
                ->take($limit)
                ->get();

            $usedPostIds = array_merge($usedPostIds, $posts->pluck('id')->toArray());
            return $posts;
        };

        $postsByCategory = [];


        $categoriesAll = Categori::pluck('nama_kategori');
        //kategori
        $postNasional = $getPostByCategory('Nasional', 5);
        $postDaerah = $getPostByCategory('Daerah', 5);
        $postLifestyle = $getPostByCategory('Lifestyle', 5);
        $postTeknologi = $getPostByCategory('Teknologi', 5);
        $postOlahraga = $getPostByCategory('Olahraga', 5);
        $postOtomotif = $getPostByCategory('Otomotif', 5);

        // data Nasional
        $topPostNasional = $postNasional->shift();
        $otherPostsNasional = $postNasional;

        // data Daerah
        $topPostDaerah = $postDaerah->shift();
        $otherPostsDaerah = $postDaerah;

        // data Lifestyle
        $topPostLifestyle = $postLifestyle->shift();
        $otherPostsLifestyle = $postLifestyle;

        // data Teknologi
        $topPostTeknologi = $postTeknologi->shift();
        $otherPostsTeknologi = $postTeknologi;

        // data Olahraga
        $topPostOlahraga = $postOlahraga->shift();
        $otherPostsOlahraga = $postOlahraga;

        // data Otomotif
        $topPostOtomotif = $postOtomotif->shift();
        $otherPostsOtomotif = $postOtomotif;
        // dd($otherPostsDaerah,$topPostLifestyle);

        $collections = [$otherPostsheadline,$topPostheadline,$postNasional, $topPostNasional, $otherPostsNasional, $topPostDaerah, $otherPostsDaerah, $topPostLifestyle, $otherPostsLifestyle, $topPostTeknologi, $otherPostsTeknologi, $topPostOlahraga, $otherPostsOlahraga, $topPostOtomotif, $otherPostsOtomotif, $postTerkini, $postTerpopuler];

        foreach ($collections as &$collection) {
            if (empty($collection)) {
                $collection = null;
                continue;
            }

            foreach ($collection as $post) {
                if (is_object($post) && isset($post->gambar) && is_string($post->gambar)) {
                    $post->gambar = explode('|', $post->gambar);
                }
            }
        }
        unset($collection);


        if ($this->agent->isMobile()) {
            return view('frontend.mobile.mobile', compact('otherPostsheadline','topPostheadline','postTerkini','postTerpopuler','topPostNasional','otherPostsNasional','topPostDaerah','otherPostsDaerah','topPostLifestyle','otherPostsLifestyle','topPostTeknologi','otherPostsTeknologi','topPostOlahraga','otherPostsOlahraga','topPostOtomotif','otherPostsOtomotif'))->with([
                'content' => 'frontend.mobile.pages.index',
            ]);
        } else {
            return view('frontend.dekstop.dekstop', compact('otherPostsheadline','topPostheadline','postTerkini','postTerpopuler','topPostNasional','otherPostsNasional','topPostDaerah','otherPostsDaerah','topPostLifestyle','otherPostsLifestyle','topPostTeknologi','otherPostsTeknologi','topPostOlahraga','otherPostsOlahraga','topPostOtomotif','otherPostsOtomotif'))->with([
                'content' => 'frontend.desktop.pages.index',
            ]);
        }

    }

    public function detail($slug)
    {
        $post = Post::with(['kategori','subCategory','user'])->where('slug', $slug)->where('status', 'public')->firstOrFail();

        $postTerkini = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->latest()
        ->take(5)
        ->get();

        $postTerkiniBottom = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->latest()
        ->take(20)
        ->get();

        $kategoriId = $post->kategori_id;

        $relatedPosts = Post::whereHas('tags', function ($q) use ($post) {
            $q->whereIn('tags.id', $post->tags->pluck('id'));
        })
        ->where('posts.id', '!=', $post->id)
        ->select('posts.*')
        ->take(2)
        ->get();
    
        $firstRelated = $relatedPosts->get(0);
        $secondRelated = $relatedPosts->get(1);
        
        $injectAt3 = '';
        $injectAt6 = '';
        
        if ($firstRelated) {
            $injectAt3 = '<p><strong>Baca Juga: <a href="' . route('detail.desktop', ['slug' => $firstRelated->slug]) . '">' . htmlspecialchars($firstRelated->title) . '</a></strong></p>';
        }
        
        if ($secondRelated) {
            $injectAt6 = '<p><strong>Baca Juga: <a href="' . route('detail.desktop', ['slug' => $secondRelated->slug]) . '">' . htmlspecialchars($secondRelated->title) . '</a></strong></p>';
        }

        // dd($relatedPosts);


        // $postTerpopuler = Post::with('kategori', 'user')
        // ->where('status', 'public')
        // ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        // ->orderBy('view', 'desc')
        // ->take(5)
        // ->get();

                // if ($postTerpopuler->isEmpty()) {
        //     $weekCounter = 1;
        //     while ($postTerpopuler->isEmpty() && $weekCounter <= 4) {
        //         $postTerpopuler = Post::with('kategori', 'user')
        //             ->where('status', 'public')
        //             ->whereBetween('created_at', [
        //                 Carbon::now()->subWeeks($weekCounter)->startOfWeek(),
        //                 Carbon::now()->subWeeks($weekCounter)->endOfWeek()
        //             ])
        //             ->orderBy('view', 'desc')
        //             ->take(5)
        //             ->get();

        //         $weekCounter++;
        //     }
        // }

        $postTerpopuler = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->orderBy('view', 'desc')
        ->take(5)
        ->get();


        $allPosts = collect([$postTerpopuler,$postTerkini,$relatedPosts,$postTerkiniBottom])->flatten();

        foreach ($allPosts as $singlePost) {
            if ($singlePost && $singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }

        $post->increment('view');
        $tagsdetail = $post->tags;

        if ($this->agent->isMobile()) {
            return view('frontend.mobile.pages.detail',compact('relatedPosts','injectAt3', 'injectAt6','postTerkiniBottom','post','postTerkini','postTerpopuler','tagsdetail'));
        } else {
            return view('frontend.dekstop.pages.detail',compact('relatedPosts','injectAt3', 'injectAt6','postTerkiniBottom','post','postTerkini','postTerpopuler','tagsdetail'));
        }
    }

    public function redaksi()
    {
        $postTerkini = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->latest()
        ->take(5)
        ->get();

        $postTerpopuler = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->orderBy('view', 'desc')
        ->take(5)
        ->get();

        $allPosts = collect([$postTerpopuler, $postTerkini])->flatten();

        foreach ($allPosts as $singlePost) {
            if ($singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }

        if ($this->agent->isMobile()) {
            return view('frontend.mobile.pages.redaksi',compact('postTerkini','postTerpopuler'));
        } else {
            return view('frontend.dekstop.pages.redaksi',compact('postTerkini','postTerpopuler'));
        }
    }


    public function kebijakanPrivasi()
    {

        $postTerkini = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->latest()
        ->take(5)
        ->get();

        $postTerpopuler = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->orderBy('view', 'desc')
        ->take(5)
        ->get();

        $allPosts = collect([$postTerpopuler, $postTerkini])->flatten();

        foreach ($allPosts as $singlePost) {
            if ($singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }

        if ($this->agent->isMobile()) {
            return view('frontend.mobile.pages.kebijakan-privasi',compact('postTerkini','postTerpopuler'));
        } else {
            return view('frontend.dekstop.pages.kebijakan-privasi',compact('postTerkini','postTerpopuler'));
        }
    }

    public function kodeEtik()
    {

        $postTerkini = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->latest()
        ->take(5)
        ->get();

        $postTerpopuler = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->orderBy('view', 'desc')
        ->take(5)
        ->get();

        $allPosts = collect([$postTerpopuler, $postTerkini])->flatten();

        foreach ($allPosts as $singlePost) {
            if ($singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }

        if ($this->agent->isMobile()) {
            return view('frontend.mobile.pages.kode-etik',compact('postTerkini','postTerpopuler'));
        } else {
            return view('frontend.dekstop.pages.kode-etik',compact('postTerkini','postTerpopuler'));
        }
    }

    public function visiMisi()
    {
        $postTerkini = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->latest()
        ->take(5)
        ->get();

        $postTerpopuler = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->orderBy('view', 'desc')
        ->take(5)
        ->get();

        $allPosts = collect([$postTerpopuler, $postTerkini])->flatten();

        foreach ($allPosts as $singlePost) {
            if ($singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }

        if ($this->agent->isMobile()) {
            return view('frontend.mobile.pages.visi-misi',compact('postTerkini','postTerpopuler'));
        } else {
            return view('frontend.dekstop.pages.visi-misi',compact('postTerkini','postTerpopuler'));
        }
    }

    public function siteMap()
    {

        $postTerkini = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->latest()
        ->take(5)
        ->get();

        $postTerpopuler = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->orderBy('view', 'desc')
        ->take(5)
        ->get();

        $allPosts = collect([$postTerpopuler, $postTerkini])->flatten();

        foreach ($allPosts as $singlePost) {
            if ($singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }

        if ($this->agent->isMobile()) {
            return view('frontend.mobile.pages.site-map',compact('postTerkini','postTerpopuler'));
        } else {
            return view('frontend.dekstop.pages.site-map',compact('postTerkini','postTerpopuler'));
        }
    }
    public function kanal($slug)
    {
        $category = Categori::with('subCategories')->where('slug', $slug)->firstOrFail();
        $postQuery = Post::with('kategori', 'user')->where('kategori_id', $category->id);
        $post = $postQuery->where('status', 'public')
                ->orderBy('created_at', 'desc')->latest()->paginate(25);

        $postTerkini = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->latest()
        ->take(5)
        ->get();

        $postTerpopuler = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->orderBy('view', 'desc')
        ->take(5)
        ->get();

        $allPosts = collect([$post->items(), $postTerpopuler, $postTerkini])->flatten();

        foreach ($allPosts as $singlePost) {
            if ($singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }


        if ($this->agent->isMobile()) {
            return view('frontend.mobile.pages.kanal',compact('category','post','postTerkini','postTerpopuler', 'allPosts'));
        } else {
            return view('frontend.dekstop.pages.kanal',compact('category','post','postTerkini','postTerpopuler',));
        }
    }

    public function subcateg($categ,$subcateg){

        $category = SubCategory::whereHas('category', function ($query) use ($categ) {
            $query->where('slug', $categ);
        })->where('slug', $subcateg)->firstOrFail();


        $postQuery = Post::with('kategori', 'user')->where('sub_category_id', $category->id);
        $post = $postQuery->where('status', 'public')->orderBy('created_at', 'desc')->latest()->paginate(25);

        $postTerkini = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->latest()
        ->take(5)
        ->get();

        $postTerpopuler = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->orderBy('view', 'desc')
        ->take(5)
        ->get();

        $allPosts = collect([$post->items(), $postTerpopuler, $postTerkini])->flatten();

        foreach ($allPosts as $singlePost) {
            if ($singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }


        if ($this->agent->isMobile()) {
            return view('frontend.mobile.pages.subkanal',compact('category','post','postTerkini','postTerpopuler', 'allPosts'));
        } else {
            return view('frontend.dekstop.pages.subkanal',compact('category','post','postTerkini','postTerpopuler',));
        }
    }

    public function staticat(){

        if ($this->agent->isMobile()) {
            return view('frontend.mobile.pages.kanal');
        } else {
            return view('frontend.dekstop.pages.kanal');
        }
    }

    public function byIndex()
    {
        $postTerkini = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->latest()
        ->take(5)
        ->get();

        $postTerpopuler = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->orderBy('view', 'desc')
        ->take(5)
        ->get();

        $post = Post::where('status', 'public')
        ->orderBy('created_at', 'desc')
        ->paginate(17);

        $allPosts = collect([$post->items(), $postTerpopuler, $postTerkini])->flatten();

        foreach ($allPosts as $singlePost) {
            if ($singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }

        if ($this->agent->isMobile()) {
            return view('frontend.mobile.pages.byIndex',compact('post','postTerkini','postTerpopuler'));
        } else {
            return view('frontend.dekstop.pages.byIndex',compact('post','postTerkini','postTerpopuler'));
        }
    }

    public function byTag($slug){
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $post = $tag->posts()->where('status', 'public')->orderBy('created_at', 'desc')->paginate(17);

        $postTerkini = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->latest()
        ->take(5)
        ->get();

        $postTerpopuler = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->orderBy('view', 'desc')
        ->take(5)
        ->get();

        $allPosts = collect([$post->items(), $postTerpopuler, $postTerkini])->flatten();

        foreach ($allPosts as $singlePost) {
            if ($singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }

        if ($this->agent->isMobile()) {
            return view('frontend.mobile.pages.bytag',compact('post','postTerkini','postTerpopuler', 'tag'));
        } else {
            return view('frontend.dekstop.pages.bytag',compact('post','postTerkini','postTerpopuler', 'tag'));
        }
    }

    public function searchResult(Request $request)
    {

        $query = $request->input('q', '');

        if (is_array($query)) {
            $query = implode(' ', $query);
        }

        $posts = Post::with(['kategori', 'user', 'tags'])
            ->where('status', 'public')
            ->where(function ($q) use ($query) {
                $q->where('title', 'ILIKE', "%{$query}%")
                  ->orWhereHas('kategori', function ($q) use ($query) {
                      $q->where('nama_kategori', 'ILIKE', "%{$query}%");
                  })
                  ->orWhereHas('tags', function ($q) use ($query) {
                      $q->where('nama_tags', 'ILIKE', "%{$query}%");
                  });
            })
            ->latest()
            ->paginate(25);

            $postTerkini = Post::with('kategori', 'user')
            ->where('status', 'public')
            ->latest()
            ->take(5)
            ->get();

            $postTerpopuler = Post::with('kategori', 'user')
            ->where('status', 'public')
            ->orderBy('view', 'desc')
            ->take(5)
            ->get();

            $allPosts = collect([$posts->items(), $postTerpopuler, $postTerkini])->flatten();

            foreach ($allPosts as $singlePost) {
                if ($singlePost->gambar) {
                    $singlePost->gambar = explode('|', $singlePost->gambar);
                }
            }
        if ($this->agent->isMobile()) {
            return view('frontend.mobile.pages.search-result',compact('postTerkini','posts','postTerpopuler'));
        } else {
            return view('frontend.dekstop.pages.search-result',compact('postTerkini','posts','postTerpopuler'));
        }
    }

    public function by404(){
        $postTerkini = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->latest()
        ->take(5)
        ->get();

        $postTerkiniBottom = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->latest()
        ->take(5)
        ->get();

        $postTerpopuler = Post::with('kategori', 'user')
            ->where('status', 'public')
            ->orderBy('view', 'desc')
            ->take(5)
            ->get();

        if ($this->agent->isMobile()) {
            return view('frontend.mobile.pages.404', compact('postTerkini', 'postTerkiniBottom', 'postTerpopuler'));
        } else {
            return view('frontend.dekstop.pages.404', compact('postTerkini', 'postTerkiniBottom', 'postTerpopuler'));
        }
    }

}
