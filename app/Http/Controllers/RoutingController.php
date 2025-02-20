<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tags;
use App\Models\Post;
use App\Models\Media;
use Carbon\Carbon;

class RoutingController extends Controller
{

    public function __construct()
    {
        // $this->
        // middleware('auth')->
        // except('dashboard');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()) {
            return view('dashboard');
        } else {
            return redirect('login');
        }
    }

    public function landingPage()
    {
        $categories = Category::with('subCateg')->get();
        $usedPostIds = [];
    
        // Ambil post headline (utama)
        $postheadline = Post::with('kategori', 'user')
            ->where('headline', 'yes')
            ->where('status', 'public')
            ->whereNotIn('id', $usedPostIds)
            ->latest()
            ->take(5)
            ->get();
        $usedPostIds = array_merge($usedPostIds, $postheadline->pluck('id')->toArray());
    
        // Ambil post terkini tanpa whereNotIn (tidak mengecualikan usedPostIds)
        $postTerkini = Post::with('kategori', 'user')
            ->where('status', 'public')
            ->latest()
            ->take(5)
            ->get();
    
        // Ambil post terpopuler tanpa whereNotIn (tidak mengecualikan usedPostIds)
        // $postTerpopuler = Post::with('kategori', 'user')
        //     ->where('status', 'public')
        //     ->orderBy('view', 'desc')
        //     ->take(4)
        //     ->get();
            
        $postTerpopuler = Post::with('kategori', 'user')
        ->where('status', 'public')
        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->orderBy('view', 'desc')
        ->take(4)
        ->get();
    
        if ($postTerpopuler->isEmpty()) {
            $weekCounter = 1;
            while ($postTerpopuler->isEmpty() && $weekCounter <= 4) {
                $postTerpopuler = Post::with('kategori', 'user')
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
    
        // Helper function untuk ambil post by category dan headline
        $getPostByCategory = function($categoryName, $limit = 6) use (&$usedPostIds) {
            $posts = Post::with('kategori', 'user')
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
    
        // Ambil post untuk setiap kategori
        $postnasional = $getPostByCategory('Nasional', 5);
        $postlifestyle = $getPostByCategory('Lifestyle', 5);
        $postteknologi = $getPostByCategory('Teknologi', 5);
        $postolahraga = $getPostByCategory('Olahraga', 5);
        $postotomotif = $getPostByCategory('Otomotif', 5);
        $postdaerah = $getPostByCategory('Daerah', 5);
    
        // Ambil media
        $media = Media::all();
        
        $threeDaysAgo = Carbon::now()->subDays(1)->startOfDay();
        $endOfDay = Carbon::now()->subDays(1)->endOfDay();
        
        $postTerbaruByTag = Post::with('kategori', 'user', 'tags')
            ->where('status', 'public')
        ->whereBetween('created_at', [$threeDaysAgo, $endOfDay]) // Filter for posts created 3 days ago
        ->latest()
        ->take(4)
        ->get();
    
        // Proses gambar di semua koleksi post
        $collections = [$postheadline, $postTerkini, $postTerpopuler, $postnasional, $postlifestyle, $postteknologi, $postolahraga, $postotomotif, $postdaerah,$postTerbaruByTag];
        foreach ($collections as $collection) {
            foreach ($collection as $post) {
                if ($post->gambar) {
                    $post->gambar = explode('|', $post->gambar);
                }
            }
        }
    
        // Kirim data ke view
        return view('blog.landing', compact(
            'categories', 'postheadline', 'postTerkini', 'postTerpopuler', 'postnasional', 
            'postlifestyle', 'postteknologi', 'postolahraga', 'postotomotif', 'postdaerah', 'media','postTerbaruByTag'
        ));
    }
    



    /**
     * Display a view based on first route param
     *
     * @return \Illuminate\Http\Response
     */
    public function root(Request $request, $first)
    {

        $mode = $request->query('mode');
        $demo = $request->query('demo');

        if ($first == "assets")
            return redirect('home');

        return view($first, ['mode' => $mode, 'demo' => $demo]);
    }

    /**
     * second level route
     */

    public function secondLevel(Request $request, $first, $second)
    {

        $mode = $request->query('mode');
        $demo = $request->query('demo');

        if ($first == "assets")
            return redirect('home');



        return view($first . '.' . $second, ['mode' => $mode, 'demo' => $demo]);
    }

    /**
     * third level route
     */

    public function thirdLevel(Request $request, $first, $second, $third)
    {
        $mode = $request->query('mode');
        $demo = $request->query('demo');

        if ($first == "assets")
            return redirect('home');

        dd($first, $second, $third);

        return view($first . '.' . $second . '.' . $third, ['mode' => $mode, 'demo' => $demo]);
    }
}
