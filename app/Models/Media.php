<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    public $fillable = ['facebook','instagram','tiktok','twitter','youtube'];
    public $timestamps = true;
}
