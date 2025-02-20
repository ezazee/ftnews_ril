<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;
    public $fillable = ['nama_tags','slug'];
    public $timestamps = true;

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
