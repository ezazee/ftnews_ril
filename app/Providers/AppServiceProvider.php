<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Categori;
use App\Models\Post;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('posts') && Schema::hasTable('categories')) {
            View::composer('*', function ($view) {
                $postTerpopuler = Post::with('kategori', 'user')
                    ->where('status', 'publish')
                    ->orderBy('view', 'desc')
                    ->take(5)
                    ->get();
                
                $categories = Categori::all();
                $view->with(compact('postTerpopuler', 'categories'));
            });
        }
    }
}
