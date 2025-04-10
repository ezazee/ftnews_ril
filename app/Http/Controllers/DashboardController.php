<?php

namespace App\Http\Controllers;

use App\Services\GoogleAnalyticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Settings;
use App\Models\User;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Categori;
use Illuminate\Support\Facades\Auth;
use App\Exports\PostExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    protected $analyticsService;

    public function __construct(GoogleAnalyticsService $analyticsService)
    {
        $this->analyticsService = $analyticsService;
    }

    public function index(Request $request)
    {
        $userCount = User::where('role_id', 1)->count();
        $postCount = Post::where('status', 'publish')->count();
        $tagcount = Tag::count();
        $categoryCount = Categori::count();
        $recentPosts = Post::where('status', 'publish')
        ->orderBy('created_at', 'desc')
        ->take(15)
        ->get();

        return view('backend.index', compact('userCount','postCount','categoryCount','tagcount','recentPosts'));
    }

    public function getTopPages(Request $request)
    {
        $settings = Settings::first();
        $propertyId = $settings->analytics;

        $startDate = $request->query('start_date', now()->subDays(7)->format('Y-m-d'));
        $endDate = $request->query('end_date', now()->format('Y-m-d'));

        try {
            $analyticsData = $this->analyticsService->getReport($propertyId, $startDate, $endDate);

            $topPages = [];
            if (!empty($analyticsData['topPages'])) {
                foreach ($analyticsData['topPages'] as $page) {
                    $topPages[] = [
                        'page' => $page['page'],
                        'sessions' => $page['sessions'],
                    ];
                }
            }
            return response()->json([
                'topPages' => $topPages,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function gettopBrowsers(Request $request){
        $settings = Settings::first();
        $propertyId = $settings->analytics;

        $startDate = $request->query('start_date', now()->subDays(7)->format('Y-m-d'));
        $endDate = $request->query('end_date', now()->format('Y-m-d'));

        try {
            $analyticsData = $this->analyticsService->getReport($propertyId, $startDate, $endDate);

            $topBrowsers = [];
            if (!empty($analyticsData['topBrowsers'])) {
                foreach ($analyticsData['topBrowsers'] as $page) {
                    $topBrowsers[] = [
                        'browser' => $page['browser'],
                        'sessions' => $page['sessions'],
                    ];
                }
            }
            return response()->json([
                'topBrowsers' => $topBrowsers,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function gettopReferrers(Request $request){
        $settings = Settings::first();
        $propertyId = $settings->analytics;

        $startDate = $request->query('start_date', now()->subDays(7)->format('Y-m-d'));
        $endDate = $request->query('end_date', now()->format('Y-m-d'));

        try {
            $analyticsData = $this->analyticsService->getReport($propertyId, $startDate, $endDate);

            $topReferrers = [];
            if (!empty($analyticsData['topReferrers'])) {
                foreach ($analyticsData['topReferrers'] as $page) {
                    $topReferrers[] = [
                        'referrer' => $page['referrer'],
                        'sessions' => $page['sessions'],
                    ];
                }
            }
            return response()->json([
                'topReferrers' => $topReferrers,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function getSiteAnalytics(Request $request)
    {
        $settings = Settings::first();
        $propertyId = $settings->analytics;
    
        $startDate = $request->query('start_date', now()->subDays(7)->format('Y-m-d'));
        $endDate = $request->query('end_date', now()->format('Y-m-d'));
    
        try {
            $analyticsData = $this->analyticsService->getReport($propertyId, $startDate, $endDate);
            $siteAnalytics = [];
            $trafficData = [];
    
            if (!empty($analyticsData['siteAnalytics'])) {
                foreach ($analyticsData['siteAnalytics'] as $page) {
                    $siteAnalytics[] = [
                        'sessions' => $page['sessions'],
                        'bouncerate' => $page['bouncerate'],
                        'pageviews' => $page['pageviews'],
                        'activeusers' => $page['activeusers'],
                    ];
    
                    $trafficData[] = $page['pageviews'];
                }
            }
    
            return response()->json([
                'siteAnalytics' => $siteAnalytics,
                'trafficData' => $trafficData,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
    

    public function exportDataPost()
    {
        $postCount = Post::count();
        return view('backend.pages.export.export-post.index',compact('postCount'));
    }

    public function exportPosts(Request $request)
    { 
        $request->validate([
        'columns' => 'required|array',
        'format' => 'required|in:csv,xlsx,json',
        ]);

        $columns = $request->input('columns');
        $format = $request->input('format');
    
        $posts = Post::with('kategori', 'tags')->get()->map(function ($post) use ($columns) {
            $data = [];
    
            foreach ($columns as $column) {
                if ($column === 'categories') {
                    $data['categories'] = $post->kategori->nama_kategori ?? '';
                } elseif ($column === 'tags') {
                    $data['tags'] = $post->tags->pluck('nama_tags')->join(', ');
                } else {
                    $data[$column] = $post->$column ?? '';
                }
            }
    
            return $data;
        });
    
        if ($format === 'json') {
            $filename = 'posts_' . now()->format('Y-m-d') . '.json';
            $jsonContent = $posts->toJson(JSON_PRETTY_PRINT);
        
            return response()->streamDownload(function () use ($jsonContent) {
                echo $jsonContent;
            }, $filename, [
                'Content-Type' => 'application/json',
                'Content-Disposition' => "attachment; filename={$filename}",
            ]);
        }
        
        return Excel::download(new PostExport($columns), "posts_".now()->format('Y-m-d').".{$format}");
        
    }


    public function exportReport(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $authorIds = $request->author_id;

        $users = User::query()
            ->with('role')
            ->withCount(['posts' => function ($query) use ($startDate, $endDate) {
                if ($startDate && $endDate) {
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                }
            }]);

        if ($authorIds && !in_array('all', $authorIds)) {
            $users->whereIn('id', $authorIds);
        }

        $users = $users->get();
            
        return view('backend.pages.export.export-report.index', [
            'user' => $users,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_json' => json_encode($users),
        ]);
    }


    public function exportPdf(Request $request)
    {
        $users = json_decode($request->user, true);
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $pdf = Pdf::loadView('backend.pages.export.export-report.exportPdf', [
            'users' => $users,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
        return $pdf->download('report.pdf');
    }


    public function loginPage()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('backend.pages.auth.login');
    }


    public function searchLfm(Request $request){
        $query = strtolower($request->input('q'));
        $files = array_filter(Storage::disk('public')->allFiles(), function ($file) use ($query) {
            return stripos(basename($file), $query) !== false;
        });

        return view('vendor.laravel-filemanager.search-results', compact('files'));
    }
}
