<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $fillable = ['title','content', 'gambar','image_caption', 'slug','status', 'headline','start_date', 'start_time', 'keyword', 'description', 'kategori_id', 'user_id','sub_category_id','view'];
    public $timestamps = true;

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class);
    }

    public function updateStatusToPublic()
    {
        $this->status = 'public';
        $this->save();
    }
}
