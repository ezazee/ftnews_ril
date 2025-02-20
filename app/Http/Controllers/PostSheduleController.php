<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostSheduleController extends Controller
{
    public function create(Request $request)
    {
        $search = $request->input('search');
    
        $userId = auth()->id(); 
        $isAdmin = auth()->user()->role === 'admin';
        
        $query = Post::with(['kategori.subCateg', 'user'])
                     ->where(function($q) use ($userId, $isAdmin) {
                         $q->where('user_id', $userId)
                           ->orWhere(function($q) use ($isAdmin) {
                               if ($isAdmin) {
                                   $q->where('status', 'schedule');
                               }
                           });
                     })
                     ->where('status', 'schedule');
        
        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }
        
        $post = $query->latest()->paginate(15);
    
        return view('project.shedulelist', compact('post'));
    }
}
