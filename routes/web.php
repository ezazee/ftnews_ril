<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingColorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PostSheduleController;
// sitemap
use Illuminate\Support\Facades\Cache;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Post;
use App\Models\Category;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__ . '/auth.php';

    // Routes without middleware
    Route::get('/', [RoutingController::class, 'landingpage'])->name('root');

    // Blog routes without middleware
    Route::get('/category/{categorySlug}/{subCategorySlug?}', [BlogController::class, 'category'])->name('bycategory');
    Route::get('/{slug}', [BlogController::class, 'bytitle'])->name('bytitle');
    Route::get('/author/{slug}', [BlogController::class, 'byauthor'])->name('byauthor');
    Route::get('/tags/{slug}', [BlogController::class, 'bytags'])->name('bytags');
    Route::get('/home/search', [BlogController::class, 'search'])->name('search');
    Route::get('/home/index', [BlogController::class, 'byindex'])->name('byindex');
    Route::get('/404/not-found', [BlogController::class, 'by404'])->name('by404');


    // About routes
    Route::get('/home/redaksi', [AboutController::class, 'index'])->name('about.redaksi');
    Route::get('/home/pedoman-media-siber', [AboutController::class, 'pedomansiber'])->name('about.pedoman-siber');
    Route::get('/home/standar-perlindungan-profesi-wartawan', [AboutController::class, 'standar_perlindungan'])->name('about.standar_perlindungan');
    Route::get('/home/kode-etik-jurnalistik', [AboutController::class, 'etik_jurnalistik'])->name('about.etik_jurnalistik');

    Route::get('/slim/online', [BlogController::class, 'slim'])->name('slim');

        // Sitemap route
        Route::get('/home/sitemap.xml', function () {
            $sitemap = Sitemap::create()
                ->add(Url::create(route('root'))->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY))
                ->add(Url::create(route('byindex'))->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY))
                ->add(Url::create(route('about.redaksi'))->setPriority(0.7)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
                ->add(Url::create(route('about.pedoman-siber'))->setPriority(0.7)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
                ->add(Url::create(route('about.standar_perlindungan'))->setPriority(0.7)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));
                // ->add(Url::create(route('about.etik_jurnalistik'))->setPriority(0.7)->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY))
                // ->add(Url::create(route('about.etik_jurnalistik2'))->setPriority(0.7)->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY))
                // ->add(Url::create(route('about.etik_jurnalistik3'))->setPriority(0.7)->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY));
        
            // Dynamic routes: Posts
            $posts = Post::orderBy('updated_at', 'desc')->take(500)->get();

            foreach ($posts as $post) {
                $sitemap->add(Url::create(route('bytitle', $post->slug))
                    ->setPriority(0.9)
                    ->setLastModificationDate($post->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
            }

            
            // Dynamic routes: Categories
            Category::chunk(100, function ($categories) use ($sitemap) {
                foreach ($categories as $category) {
                    $sitemap->add(Url::create(route('bycategory', $category->slug))
                        ->setPriority(0.8)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));
                }
            });
    
            return $sitemap->toResponse(request());
    });


    // Routes with middleware
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/docs', [DashboardController::class, 'docs'])->name('docs');
            // Dashboard routes
        Route::get('/auth/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/auth/get-monthly-target', [DashboardController::class, 'getMonthlyTarget']);
        Route::get('/auth/get-project-statistics', [DashboardController::class, 'getProjectStatistics']);
    
        // Category routes
        Route::get('/apps/categori', [CategoryController::class, 'create'])->name('categori.create');
        Route::post('/apps/categori', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/apps/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/apps/categori/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::get('/get-subcategories/{categoryId}', [CategoryController::class, 'getSubcategories']);
    
        // Tags routes
        Route::get('/apps/tags', [TagsController::class, 'create'])->name('tags.create');
        Route::post('/apps/tags', [TagsController::class, 'store'])->name('tags.store');
        Route::delete('/apps/tags/{id}', [TagsController::class, 'destroy'])->name('tags.destroy');
        Route::put('/apps/tags/{id}', [TagsController::class, 'update'])->name('tags.update');
        Route::post('/apps/addtag', [TagsController::class, 'addtag'])->name('tags.addtag');
    
        // Post create routes
        Route::get('/project/create', [PostController::class, 'create'])->name('post.create');
        Route::post('/project/create', [PostController::class, 'store'])->name('post.store');
    
        Route::get('/publish', [PostController::class, 'publishScheduledPosts'])->name('publish.scheduled.posts');
    
    
        // shedulepost
        Route::get('/shedule/list', [PostSheduleController::class, 'create'])->name('post.shedule');
    
        // Post list routes
        Route::get('/project/list', [ListController::class, 'create'])->name('list.create');
        Route::get('/project/list/{id}', [ListController::class, 'edit'])->name('list.edit');
        Route::put('/project/list/{id}', [ListController::class, 'update'])->name('list.update');
        Route::delete('/project/list/{id}', [ListController::class, 'destroy'])->name('list.destroy');
        Route::get('/privete/list', [ListController::class, 'private'])->name('post.private');
        Route::get('/mypost/list', [ListController::class, 'mypost'])->name('post.mypost');
    
    
        // Post detail routes
        Route::get('/project/detail', [DetailController::class, 'index'])->name('detail.index');
    
        // Subcategory routes
        Route::post('/subcategories/store', [SubCategoryController::class, 'store'])->name('subcategories.store');
        Route::delete('/subcategories/{id}', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');
        Route::get('/member/profile', [UserController::class, 'profile'])->name('profile.index');
        Route::put('/user/update/{id}', [UserController::class, 'updateprofile'])->name('updateprofile');
    
        // Member routes
        Route::group(['middleware' => 'role:admin'], function () {
            Route::get('/member/access', [UserController::class, 'index'])->name('user.index');
            Route::post('/member/access', [UserController::class, 'store'])->name('user.store');
            Route::put('/member/{id}', [UserController::class, 'update'])->name('user.update');
            Route::delete('/member/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    
            // SettingColor routes
            Route::get('/settingColor/edit', [SettingColorController::class, 'edit'])->name('settingColor.edit');
    
            // Media routes
            Route::get('/setting/media', [MediaController::class, 'create'])->name('media.create');
            Route::post('/setting/media', [MediaController::class, 'store'])->name('media.store');
        });
        // RoutingController routes
        Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
        Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
        Route::get('{any}', [RoutingController::class, 'root'])->name('any');
    
    });

