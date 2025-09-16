<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'created_datetime','title_article','id_article','activity',
        'user_name','user_id','roles','status','scheduled_time',
        'article_created_at','article_published_at','message'
    ];
}
