<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = ['nama_sub_kategori', 'category_id','slug'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
