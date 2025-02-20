<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Tags;
use App\Models\User;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $totalPosts = Post::count();
        $totalTags = Tags::count();
        $totalCategory = Category::count();
        $totalauthor = User::where('role', 'author')->count();

        // Get the filter value from the request, default to 'all'
        $filter = $request->input('filter', 'all');

        // Base query for mostPosting
        $mostPostingQuery = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('users.name', DB::raw('count(posts.id) as total_posts'))
            ->groupBy('users.name')
            ->orderByDesc('total_posts');

        // Apply filtering based on the selected filter
        if ($filter === '1day') {
            $mostPostingQuery->where('posts.created_at', '>=', now()->subDay());
        } elseif ($filter === '1week') {
            $mostPostingQuery->where('posts.created_at', '>=', now()->subWeek());
        } elseif ($filter === '1month') {
            $mostPostingQuery->where('posts.created_at', '>=', now()->subMonth());
        }

        // If the filter is 'all', limit the results to 10
        if ($filter === 'all') {
            $mostPosting = $mostPostingQuery->take(11)->get();
        } else {
            // Otherwise, get all matching results without limiting
            $mostPosting = $mostPostingQuery->get();
        }

        // Fetch recent activity posts
        $activityPost = Post::select('title', 'updated_at as last_activity', 'gambar')
            ->orderByDesc('id')
            ->take(5)
            ->get();

        // Return the view with the data
        return view('home', compact('totalPosts', 'totalTags', 'totalauthor', 'totalCategory', 'mostPosting', 'activityPost'));
    }



    public function getMonthlyTarget(){

        $currentMonth = Carbon::now()->month;

        $scheduledCount = Post::where('status', 'schedule')
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $publishedCount = Post::where('status', 'public')
            ->whereMonth('created_at', $currentMonth)
            ->count();

        // dd($scheduledCount,$publishedCount);
        return response()->json([
            'scheduled' => $scheduledCount,
            'published' => $publishedCount,
        ]);
    }


    public function getProjectStatistics(){

        $sixMonthsAgo = now()->subMonths(6);
        $oneYearAgo = now()->subYear();

        $allPosts = Post::count();
        $lastSixMonthsPosts = Post::where('created_at', '>=', $sixMonthsAgo)->count();
        $lastYearPosts = Post::where('created_at', '>=', $oneYearAgo)->count();

        return response()->json([
            'all' => $allPosts,
            'lastSixMonths' => $lastSixMonthsPosts,
            'lastYear' => $lastYearPosts,
        ]);
    }


    public function docs(){
        return view('docs.documentations');
    }
}
