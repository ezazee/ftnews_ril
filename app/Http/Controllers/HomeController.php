<?php

namespace App\Http\Controllers;

use Jenssegers\Agent\Agent;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Categori;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helpers\CacheHelper;

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

        $postheadline = CacheHelper::remember('home_headline', now()->addMinutes(2), function () use (&$usedPostIds) {
            return Post::with('kategori', 'subCategory', 'user')
                ->where('headline', 'yes')
                ->where('status', 'public')
                ->whereNotIn('id', $usedPostIds)
                ->orderBy('id', 'desc')
                ->take(15)
                ->get();
        });

        $topPostheadline = $postheadline->shift();
        $otherPostsheadline = $postheadline;

        if ($topPostheadline) {
            $usedPostIds[] = $topPostheadline->id;
        }
        $usedPostIds = array_merge($usedPostIds, $postheadline->pluck('id')->toArray());

        $postTerkini = CacheHelper::remember('home_terkini', now()->addMinutes(2), function () {
            return Post::with('kategori','user')
                ->where('status', 'public')
                ->latest()
                ->take(5)
                ->get();
        });

        $postTerpopuler = CacheHelper::remember('home_terpopuler', now()->addMinutes(2), function () {
            return Post::with('kategori','user')
                ->where('status', 'public')
                ->orderBy('view', 'desc')
                ->take(5)
                ->get();
        });

        $getPostByCategory = function ($categoryName, $limit = 5) use (&$usedPostIds) {
            return CacheHelper::remember("home_category_{$categoryName}", now()->addMinutes(2), function () use ($categoryName, $limit, &$usedPostIds) {
                $posts = Post::with('kategori','user')
                    ->whereHas('kategori', function ($query) use ($categoryName) {
                        $query->where('nama_kategori', $categoryName);
                    })
                    ->whereNotIn('id', $usedPostIds)
                    ->where('status','public')
                    ->latest()
                    ->take($limit)
                    ->get();

                $usedPostIds = array_merge($usedPostIds, $posts->pluck('id')->toArray());
                return $posts;
            });
        };

        $postNasional   = $getPostByCategory('Nasional', 5);
        $postDaerah     = $getPostByCategory('Daerah', 5);
        $postLifestyle  = $getPostByCategory('Lifestyle', 5);
        $postTeknologi  = $getPostByCategory('Teknologi', 5);
        $postOlahraga   = $getPostByCategory('Olahraga', 5);
        $postOtomotif   = $getPostByCategory('Otomotif', 5);

        $topPostNasional    = $postNasional->shift();  $otherPostsNasional   = $postNasional;
        $topPostDaerah      = $postDaerah->shift();    $otherPostsDaerah     = $postDaerah;
        $topPostLifestyle   = $postLifestyle->shift(); $otherPostsLifestyle  = $postLifestyle;
        $topPostTeknologi   = $postTeknologi->shift(); $otherPostsTeknologi  = $postTeknologi;
        $topPostOlahraga    = $postOlahraga->shift();  $otherPostsOlahraga   = $postOlahraga;
        $topPostOtomotif    = $postOtomotif->shift();  $otherPostsOtomotif   = $postOtomotif;

        $collections = [
            $otherPostsheadline,$topPostheadline,
            $postNasional,$topPostNasional,$otherPostsNasional,
            $topPostDaerah,$otherPostsDaerah,
            $topPostLifestyle,$otherPostsLifestyle,
            $topPostTeknologi,$otherPostsTeknologi,
            $topPostOlahraga,$otherPostsOlahraga,
            $topPostOtomotif,$otherPostsOtomotif,
            $postTerkini,$postTerpopuler
        ];

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
            return view('frontend.mobile.mobile', compact(
                'otherPostsheadline','topPostheadline','postTerkini','postTerpopuler',
                'topPostNasional','otherPostsNasional',
                'topPostDaerah','otherPostsDaerah',
                'topPostLifestyle','otherPostsLifestyle',
                'topPostTeknologi','otherPostsTeknologi',
                'topPostOlahraga','otherPostsOlahraga',
                'topPostOtomotif','otherPostsOtomotif'
            ))->with(['content' => 'frontend.mobile.pages.index']);
        } else {
            return view('frontend.dekstop.dekstop', compact(
                'otherPostsheadline','topPostheadline','postTerkini','postTerpopuler',
                'topPostNasional','otherPostsNasional',
                'topPostDaerah','otherPostsDaerah',
                'topPostLifestyle','otherPostsLifestyle',
                'topPostTeknologi','otherPostsTeknologi',
                'topPostOlahraga','otherPostsOlahraga',
                'topPostOtomotif','otherPostsOtomotif'
            ))->with(['content' => 'frontend.desktop.pages.index']);
        }
    }

    public function detail($slug)
    {
        $post = CacheHelper::remember("article_{$slug}", now()->addHours(24), function () use ($slug) {
            return Post::with(['kategori','subCategory','user','reporter','tags'])
                ->where('slug', $slug)
                ->where('status', 'public')
                ->firstOrFail();
        });

        $postTerkini = CacheHelper::remember("detail_terkini", now()->addMinutes(2), function () {
            return Post::with('kategori','user')
                ->where('status', 'public')
                ->latest()
                ->take(5)
                ->get();
        });

        $postTerkiniBottom = CacheHelper::remember("detail_terkini_bottom", now()->addMinutes(2), function () {
            return Post::with('kategori','user')
                ->where('status', 'public')
                ->latest()
                ->take(20)
                ->get();
        });

        $postTerpopuler = CacheHelper::remember("detail_terpopuler", now()->addMinutes(2), function () {
            return Post::with('kategori','user')
                ->where('status', 'public')
                ->orderBy('view', 'desc')
                ->take(7)
                ->get();
        });

        $relatedPosts = CacheHelper::remember("article_related_{$post->id}", now()->addMinutes(2), function () use ($post) {
            return Post::whereHas('tags', function ($q) use ($post) {
                    $q->whereIn('tags.id', $post->tags->pluck('id'));
                })
                ->where('posts.id', '!=', $post->id)
                ->select('posts.*')
                ->take(2)
                ->get();
        });

        $firstRelated  = $relatedPosts->get(0);
        $secondRelated = $relatedPosts->get(1);

        $injectAt3 = $firstRelated
            ? '<blockquote class="bacajuga"><strong>Baca Juga:</strong>
                <a href="' . route('detail.desktop', ['slug' => $firstRelated->slug]) . '">' . htmlspecialchars($firstRelated->title) . '</a>
            </blockquote>'
            : '';

        $injectAt6 = $secondRelated
            ? '<blockquote class="bacajuga"><strong>Baca Juga:</strong>
                <a href="' . route('detail.desktop', ['slug' => $secondRelated->slug]) . '">' . htmlspecialchars($secondRelated->title) . '</a>
            </blockquote>'
            : '';

        if ($this->agent->isMobile()) {
            $par1 = '<div>
                       <p style="display:none;">rb-1</p>
                     </div>';
            $par3 = '<div>
                       <p style="display:none;">rb-3</p>
                     </div>';
            $ads1 = '<div data-type="_mgwidget" data-widget-id="1799017"> 
                     </div> 
                     <script>(function(w,q){w[q]=w[q]||[];w[q].push(["_mgc.load"])})(window,"_mgq"); 
                     </script>';
            $ads2 = '';
            $par5 ='';
            $par7 = '<div id="bn_gF8Xt2Vk94"></div><script>;(function(C,b,m,r){function t(){b.removeEventListener("scroll",t);f()}function u(){p=new IntersectionObserver(a=>{a.forEach(n=>{n.isIntersecting&&(p.unobserve(n.target),f())})},{root:null,rootMargin:"400px 200px",threshold:0});p.observe(e)}function f(){(e=e||b.getElementById("bn_"+m))?(e.innerHTML="",e.id="bn_"+v,q={act:"init",id:m,rnd:v,ms:w},(d=b.getElementById("rcMain"))?c=d.contentWindow:D(),c.rcMain?c.postMessage(q,x):c.rcBuf.push(q)):g("!bn")}function E(a,n,F,y){function z(){var h=
                    n.createElement("script");h.type="text/javascript";h.src=a;h.onerror=function(){k++;5>k?setTimeout(z,10):g(k+"!"+a)};h.onload=function(){y&&y();k&&g(k+"!"+a)};F.appendChild(h)}var k=0;z()}function D(){try{d=b.createElement("iframe"),d.style.setProperty("display","none","important"),d.id="rcMain",b.body.insertBefore(d,b.body.children[0]),c=d.contentWindow,l=c.document,l.open(),l.close(),A=l.body,Object.defineProperty(c,"rcBuf",{enumerable:!1,configurable:!1,writable:!1,value:[]}),E("https://go.rcvlink.com/static/main.js",
                    l,A,function(){for(var a;c.rcBuf&&(a=c.rcBuf.shift());)c.postMessage(a,x)})}catch(a){B(a)}}function B(a){g(a.name+": "+a.message+"\t"+(a.stack?a.stack.replace(a.name+": "+a.message,""):""))}function g(a){console.error(a);(new Image).src="https://go.rcvlinks.com/err/?code="+m+"&ms="+((new Date).getTime()-w)+"&ver="+G+"&text="+encodeURIComponent(a)}try{var G="231101-0007",x=location.origin||location.protocol+"//"+location.hostname+(location.port?":"+location.port:""),e=b.getElementById("bn_"+m),v=Math.random().toString(36).substring(2,
                    15),w=(new Date).getTime(),p,H=!("IntersectionObserver"in C),q,d,c,l,A;e?"scroll"==r?b.addEventListener("scroll",t):"lazy"==r?H?f():"loading"==b.readyState?b.addEventListener("DOMContentLoaded",u):u():f():"loading"==b.readyState?b.addEventListener("DOMContentLoaded",f):g("!bn")}catch(a){B(a)}})(window,document,"gF8Xt2Vk94","");
                    </script>';
            $par8 = '';
            $par9 = '<div><script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"	
                    crossorigin="anonymous"></script>
                    <ins class="adsbygoogle"
                    style="display:inline-block;width:336px;height:280px"
                    data-ad-client="ca-pub-7366174212541814"
                    data-ad-slot="1614428017"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script></div>';
            $par10 ='<div><script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814
                    crossorigin="anonymous"></script>
                    <ins class="adsbygoogle"
                    style="display:inline-block;width:336px;height:280px"
                    data-ad-client="ca-pub-7366174212541814"
                    data-ad-slot="6378102865"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>	
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});	
                    </script></div>';
        } else {
            $par1 = '<div>
                       <p style="display:none;">rb-1</p>
                     </div>';
            $par3 = '<div>
                       <p style="display:none;">rb-3</p>
                     </div>';
            $ads1 = '<div data-type="_mgwidget" data-widget-id="1799017"> 
                     </div> 
                     <script>(function(w,q){w[q]=w[q]||[];w[q].push(["_mgc.load"])})(window,"_mgq"); 
                     </script>';
            $ads2 = '';
            $par5 ='<div id="bn_gF8Xt2Vk94"></div><script>;(function(C,b,m,r){function t(){b.removeEventListener("scroll",t);f()}function u(){p=new IntersectionObserver(a=>{a.forEach(n=>{n.isIntersecting&&(p.unobserve(n.target),f())})},{root:null,rootMargin:"400px 200px",threshold:0});p.observe(e)}function f(){(e=e||b.getElementById("bn_"+m))?(e.innerHTML="",e.id="bn_"+v,q={act:"init",id:m,rnd:v,ms:w},(d=b.getElementById("rcMain"))?c=d.contentWindow:D(),c.rcMain?c.postMessage(q,x):c.rcBuf.push(q)):g("!bn")}function E(a,n,F,y){function z(){var h=
                    n.createElement("script");h.type="text/javascript";h.src=a;h.onerror=function(){k++;5>k?setTimeout(z,10):g(k+"!"+a)};h.onload=function(){y&&y();k&&g(k+"!"+a)};F.appendChild(h)}var k=0;z()}function D(){try{d=b.createElement("iframe"),d.style.setProperty("display","none","important"),d.id="rcMain",b.body.insertBefore(d,b.body.children[0]),c=d.contentWindow,l=c.document,l.open(),l.close(),A=l.body,Object.defineProperty(c,"rcBuf",{enumerable:!1,configurable:!1,writable:!1,value:[]}),E("https://go.rcvlink.com/static/main.js",
                    l,A,function(){for(var a;c.rcBuf&&(a=c.rcBuf.shift());)c.postMessage(a,x)})}catch(a){B(a)}}function B(a){g(a.name+": "+a.message+"\t"+(a.stack?a.stack.replace(a.name+": "+a.message,""):""))}function g(a){console.error(a);(new Image).src="https://go.rcvlinks.com/err/?code="+m+"&ms="+((new Date).getTime()-w)+"&ver="+G+"&text="+encodeURIComponent(a)}try{var G="231101-0007",x=location.origin||location.protocol+"//"+location.hostname+(location.port?":"+location.port:""),e=b.getElementById("bn_"+m),v=Math.random().toString(36).substring(2,
                    15),w=(new Date).getTime(),p,H=!("IntersectionObserver"in C),q,d,c,l,A;e?"scroll"==r?b.addEventListener("scroll",t):"lazy"==r?H?f():"loading"==b.readyState?b.addEventListener("DOMContentLoaded",u):u():f():"loading"==b.readyState?b.addEventListener("DOMContentLoaded",f):g("!bn")}catch(a){B(a)}})(window,document,"gF8Xt2Vk94","");
                    </script>';
            $par7 = '<div><script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"							
                    crossorigin="anonymous"></script>
                    <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-7366174212541814"		
                    data-ad-slot="2212429475"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>			
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});				
                    </script></div>';
            $par8 = '<div><script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"							
                    crossorigin="anonymous"></script>
                    <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-7366174212541814"
                    data-ad-slot="4647021127"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script></div>';
            $par9 = '<div><script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                    crossorigin="anonymous"></script>
                    <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-7366174212541814"
                    data-ad-slot="4044487523"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script></div>';
            $par10 ='';
        }

        $page        = request()->get('page', 1);
        $currentPage = $page == 'all' ? 'all' : (int) $page;

        $formatted_content = $this->formatPostContent(
            $post->content,
            $injectAt3,
            $injectAt6,
            $par1,$par3,$ads1,$ads2,$par5,$par7,$par8,$par9,$par10
        );

        $totalPages = 1;
        if ($post->multipages === 'yes' && $currentPage !== 'all') {
            $parts   = preg_split('/(<\/p>)/i', $formatted_content, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
            $chunks  = array_chunk($parts, ceil(count($parts) / 2));
            $formatted_chunks = array_map(fn($chunk) => implode('', $chunk), $chunks);

            $formatted_content = $formatted_chunks[$currentPage - 1] ?? '';
            $totalPages = count($formatted_chunks);
        }

        $allPosts = collect([$postTerpopuler,$postTerkini,$relatedPosts,$postTerkiniBottom])->flatten();
        foreach ($allPosts as $singlePost) {
            if ($singlePost && $singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }

        $post->increment('view');

        $tagsdetail = $post->tags;

        if ($this->agent->isMobile()) {
            return view('frontend.mobile.pages.detail', compact(
                'relatedPosts','injectAt3','injectAt6',
                'postTerkiniBottom','post','postTerkini',
                'postTerpopuler','tagsdetail',
                'formatted_content','totalPages','currentPage'
            ));
        } else {
            return view('frontend.dekstop.pages.detail', compact(
                'relatedPosts','injectAt3','injectAt6',
                'postTerkiniBottom','post','postTerkini',
                'postTerpopuler','tagsdetail',
                'formatted_content','totalPages','currentPage'
            ));
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

        $post = CacheHelper::remember("kanal_{$slug}_posts", now()->addMinutes(2), function () use ($category) {
            return Post::with('kategori', 'user')
                ->where('kategori_id', $category->id)
                ->where('status', 'public')
                ->latest()
                ->paginate(25);
        });

        $postTerkini = CacheHelper::remember("kanal_{$slug}_terkini", now()->addMinutes(2), function () {
            return Post::with('kategori', 'user')
                ->where('status', 'public')
                ->latest()
                ->take(5)
                ->get();
        });

        $postTerpopuler = CacheHelper::remember("kanal_{$slug}_terpopuler", now()->addMinutes(2), function () {
            return Post::with('kategori', 'user')
                ->where('status', 'public')
                ->orderBy('view', 'desc')
                ->take(5)
                ->get();
        });

        $allPosts = collect([$post->items(), $postTerpopuler, $postTerkini])->flatten();

        foreach ($allPosts as $singlePost) {
            if ($singlePost && $singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }

        if ($this->agent->isMobile()) {
            return view('frontend.mobile.pages.kanal', compact('category','post','postTerkini','postTerpopuler','allPosts'));
        } else {
            return view('frontend.dekstop.pages.kanal', compact('category','post','postTerkini','postTerpopuler'));
        }
    }

    public function subcateg($categ, $subcateg)
    {
        $category = SubCategory::whereHas('category', function ($query) use ($categ) {
            $query->where('slug', $categ);
        })->where('slug', $subcateg)->firstOrFail();

        $cacheKeyPrefix = "subkanal_{$categ}_{$subcateg}";

        $post = CacheHelper::remember("{$cacheKeyPrefix}_posts", now()->addMinutes(2), function () use ($category) {
            return Post::with('kategori', 'user')
                ->where('sub_category_id', $category->id)
                ->where('status', 'public')
                ->latest()
                ->paginate(25);
        });

        $postTerkini = CacheHelper::remember("{$cacheKeyPrefix}_terkini", now()->addMinutes(2), function () {
            return Post::with('kategori', 'user')
                ->where('status', 'public')
                ->latest()
                ->take(5)
                ->get();
        });

        $postTerpopuler = CacheHelper::remember("{$cacheKeyPrefix}_terpopuler", now()->addMinutes(2), function () {
            return Post::with('kategori', 'user')
                ->where('status', 'public')
                ->orderBy('view', 'desc')
                ->take(5)
                ->get();
        });

        $allPosts = collect([$post->items(), $postTerpopuler, $postTerkini])->flatten();

        foreach ($allPosts as $singlePost) {
            if ($singlePost && $singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }

        if ($this->agent->isMobile()) {
            return view('frontend.mobile.pages.subkanal', compact('category','post','postTerkini','postTerpopuler','allPosts'));
        } else {
            return view('frontend.dekstop.pages.subkanal', compact('category','post','postTerkini','postTerpopuler'));
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
        $post = CacheHelper::remember('byindex_posts', now()->addMinutes(2), function () {
            return Post::where('status', 'public')
                ->orderBy('created_at', 'desc')
                ->paginate(17);
        });

        $postTerkini = CacheHelper::remember('byindex_terkini', now()->addMinutes(2), function () {
            return Post::with('kategori', 'user')
                ->where('status', 'public')
                ->latest()
                ->take(5)
                ->get();
        });

        $postTerpopuler = CacheHelper::remember('byindex_terpopuler', now()->addMinutes(2), function () {
            return Post::with('kategori', 'user')
                ->where('status', 'public')
                ->orderBy('view', 'desc')
                ->take(5)
                ->get();
        });

        $allPosts = collect([$post->items(), $postTerpopuler, $postTerkini])->flatten();

        foreach ($allPosts as $singlePost) {
            if ($singlePost && $singlePost->gambar) {
                $singlePost->gambar = explode('|', $singlePost->gambar);
            }
        }

        if ($this->agent->isMobile()) {
            return view('frontend.mobile.pages.byIndex', compact('post','postTerkini','postTerpopuler'));
        } else {
            return view('frontend.dekstop.pages.byIndex', compact('post','postTerkini','postTerpopuler'));
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
    
        public function jaringan(){
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
            return view('frontend.mobile.pages.jaringan', compact('postTerkini', 'postTerkiniBottom', 'postTerpopuler'));
        } else {
            return view('frontend.dekstop.pages.jaringan', compact('postTerkini', 'postTerkiniBottom', 'postTerpopuler'));
        }
    }
    
    
    public function formatPostContent($content, $injectAt3 = '', $injectAt6 = '', $par1 = '', $par3 = '', $ads1 = '', $ads2 = '', $par5 = '',$par7 = '', $par8 = '', $par9 = '',$par10 = '',)
    {
        $content = preg_replace('/\[caption[^\]]*\]/i', '', $content);
        $content = preg_replace('/\[\/caption\]/i', '', $content);
        $content = preg_replace('/<caption[^>]*>/i', '', $content);
        $content = preg_replace('/<\/caption>/i', '', $content);

        $content = preg_replace('/<br\s*\/?>/i', '', $content);
        $content = str_replace('&nbsp;', ' ', $content);

        $content = preg_replace('/<p>\s*<\/p>/i', '', $content);
        $content = str_replace(['<em>', '</em>'], ['<i>', '</i>'], $content);

        if (preg_match_all('/<img[^>]+alt="([^"]+)"[^>]*>/i', $content, $matches, PREG_OFFSET_CAPTURE)) {
            for ($i = count($matches[0]) - 1; $i >= 0; $i--) {
                $fullImgTag = $matches[0][$i][0];
                $pos = $matches[0][$i][1];
                $altText = trim($matches[1][$i][0]);

                if ($altText !== '') {
                    $insert = $fullImgTag . '<i>' . htmlspecialchars($altText) . '</i>';
                    $content = substr_replace($content, $insert, $pos, strlen($fullImgTag));
                }
            }
        }

        if (!preg_match('/<p\b[^>]*>.*?<\/p>/is', $content)) {
            $lines = preg_split('/\r\n|\n|\r|\n\n+/', trim($content));
            $content = '';
            foreach ($lines as $line) {
                if (trim($line)) {
                    $content .= '<p>' . trim($line) . '</p>';
                }
            }
        }

        $paragraphIndex = 0;
        $content = preg_replace_callback(
            '/(<p\b[^>]*>.*?<\/p>)/is',
            function ($matches) use (&$paragraphIndex, $injectAt3, $injectAt6,$par1,$par3,$ads1, $ads2, $par5, $par7, $par8, $par9, $par10) {
                $paragraphIndex++;
                $result = $matches[1];
                $injections = '';
                
                if ($paragraphIndex === 3 && $injectAt3) $injections .= $injectAt3;
                if ($paragraphIndex === 6 && $injectAt6) $injections .= $injectAt6;
                
                if ($paragraphIndex === 1 && $par1) $injections .= $par1;
                if ($paragraphIndex === 3 && $par3) $injections .= $par3;
                
                if ($paragraphIndex === 4 && $ads1) $injections .= $ads1;
                if ($paragraphIndex === 5 && $ads2) $injections .= $ads2;
                
                if ($paragraphIndex === 6 && $par5) $injections .= $par5;
                if ($paragraphIndex === 7 && $par7) $injections .= $par7;
                if ($paragraphIndex === 8 && $par8) $injections .= $par8;
                if ($paragraphIndex === 9 && $par9) $injections .= $par9;
                if ($paragraphIndex === 10 && $par10) $injections .= $par10;

                return $result . $injections;
            },
            $content
        );

        return $content;
    }



}
