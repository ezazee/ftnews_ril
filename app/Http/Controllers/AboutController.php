<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Media;
use App\Models\Tags;
use App\Models\Category;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media = Media::all();
        $categories = Category::with('subCategories')->get();

        return view('blog.redaksi',compact('media','categories'));
    }

    public function pedomansiber()
    {
        $media = Media::all();
        $categories = Category::with('subCategories')->get();
        return view('blog.pedoman-media-siber',compact('media','categories'));
    }

    public function standar_perlindungan()
    {
        $media = Media::all();
        $categories = Category::with('subCategories')->get();
        return view('blog.standar-perlindungan-profesi-wartawan',compact('media','categories'));
    }

    

    public function etik_jurnalistik()
    {
        $media = Media::all();
        $categories = Category::with('subCategories')->get();

        return view('blog.kode-etik-jurnalistik',compact('media','categories'));
    }

    public function etik_jurnalistik2()
    {
        $media = Media::all();
        $categories = Category::with('subCategories')->get();

        return view('blog.kode-etik-jurnalistik2',compact('media','categories'));
    }

    public function etik_jurnalistik3()
    {
        $media = Media::all();
        $categories = Category::with('subCategories')->get();

        return view('blog.kode-etik-jurnalistik3',compact('media','categories'));
    }
}
