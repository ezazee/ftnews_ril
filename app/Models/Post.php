<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes; 
use App\Helpers\CacheHelper;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $dates = ['deleted_at'];
    public $timestamps = true;

    protected $fillable = [
        'title', 'content', 'gambar', 'short_description',
        'image_caption', 'slug', 'status', 'headline',
        'start_date', 'start_time', 'keyword', 'sub_category_id',
        'description', 'kategori_id', 'user_id','created_at',
        'adult','reporter_id','multipages','seo'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')->useDisk('public');
    }

    public function kategori()
    {
        return $this->belongsTo(Categori::class, 'kategori_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tags_id');
    }

    public function reporter()
    {
        return $this->belongsTo(Reporter::class, 'reporter_id');
    }

    protected static function booted()
    {
        $jakartaNow = fn() => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');

        // CREATED EVENT
        static::created(function ($post) use ($jakartaNow) {
            self::clearCache($post);
            $user = Auth::user();

            $roleName = 'unknown';
            if ($user && isset($user->role)) {
                $roleName = is_object($user->role) ? $user->role->name : $user->role;
            }

            $createdAt = $post->created_at?->timezone('Asia/Jakarta')->format('Y-m-d H:i:s');

            Log::create([
                'created_datetime'     => $jakartaNow(),
                'title_article'        => $post->title,
                'id_article'           => $post->id,
                'activity'             => 'create',
                'user_name'            => $user->name ?? 'System',
                'user_id'              => $user->id ?? null,
                'roles'                => $roleName,
                'status'               => $post->status,
                'scheduled_time'       => $post->status === 'schedule'
                                            ? "{$post->start_date} {$post->start_time}" : null,
                'article_created_at'   => $createdAt,
                'article_published_at' => $post->status === 'publish' ? $createdAt : null,
                'message'              => "Post '{$post->title}' berhasil dibuat."
            ]);
        });

        // UPDATED EVENT
        static::updated(function ($post) use ($jakartaNow) {
            if ($post->wasChanged('deleted_at') && $post->deleted_at === null) {
                return;
            }

            self::clearCache($post);
            $user = Auth::user();

            $roleName = 'unknown';
            if ($user && isset($user->role)) {
                $roleName = is_object($user->role) ? $user->role->name : $user->role;
            }

            $originalCreated = $post->getOriginal('created_at')
                ? Carbon::parse($post->getOriginal('created_at'))->format('Y-m-d H:i:s')
                : null;

            Log::create([
                'created_datetime'     => $jakartaNow(),
                'title_article'        => $post->title,
                'id_article'           => $post->id,
                'activity'             => 'update',
                'user_name'            => $user->name ?? 'System',
                'user_id'              => $user->id ?? null,
                'roles'                => $roleName,
                'status'               => $post->status,
                'scheduled_time'       => $post->status === 'schedule'
                                            ? "{$post->start_date} {$post->start_time}" : null,
                'article_created_at'   => $originalCreated,
                'article_published_at' => $post->status === 'publish' ? $originalCreated : null,
                'message'              => "Post '{$post->title}' berhasil diupdate."
            ]);
        });

        // SOFT DELETE EVENT
        static::deleting(function ($post) use ($jakartaNow) {
            // Hindari logging saat force delete
            if (method_exists($post, 'isForceDeleting') && $post->isForceDeleting()) {
                return;
            }

            $user = Auth::user();
            $roleName = 'unknown';
            if ($user && isset($user->role)) {
                $roleName = is_object($user->role) ? $user->role->name : $user->role;
            }

            $createdAtString = $post->getOriginal('created_at')
                ? Carbon::parse($post->getOriginal('created_at'))->format('Y-m-d H:i:s')
                : null;

            Log::create([
                'created_datetime'     => $jakartaNow(),
                'title_article'        => $post->title,
                'id_article'           => $post->id,
                'activity'             => 'soft_delete',
                'user_name'            => $user->name ?? 'System',
                'user_id'              => $user->id ?? null,
                'roles'                => $roleName,
                'status'               => $post->status,
                'scheduled_time'       => $post->status === 'schedule'
                                            ? "{$post->start_date} {$post->start_time}" : null,
                'article_created_at'   => $createdAtString,
                'article_published_at' => $post->status === 'publish' ? $createdAtString : null,
                'message'              => "Post '{$post->title}' telah di-soft delete."
            ]);
        });

        // FORCE DELETE EVENT
        static::forceDeleted(function ($post) use ($jakartaNow) {
            $user = Auth::user();
            $roleName = 'unknown';
            if ($user && isset($user->role)) {
                $roleName = is_object($user->role) ? $user->role->name : $user->role;
            }

            Log::create([
                'created_datetime'     => $jakartaNow(),
                'title_article'        => $post->title,
                'id_article'           => $post->id,
                'activity'             => 'force_delete',
                'user_name'            => $user->name ?? 'System',
                'user_id'              => $user->id ?? null,
                'roles'                => $roleName,
                'status'               => $post->status,
                'scheduled_time'       => $post->status === 'schedule'
                                            ? "{$post->start_date} {$post->start_time}" : null,
                'article_created_at'   => $post->created_at?->format('Y-m-d H:i:s'),
                'article_published_at' => null,
                'message'              => "Post '{$post->title}' dihapus permanen."
            ]);
        });

        static::deleted(function ($post) {
            self::clearCache($post);
        });
    }

    private static function clearCache($post)
    {
        CacheHelper::forget('home_headline');
        CacheHelper::forget('home_terkini');
        CacheHelper::forget('home_terpopuler');

        if ($post->kategori) {
            CacheHelper::forget("kanal_{$post->kategori->slug}_posts");
            CacheHelper::forget("kanal_{$post->kategori->slug}_terkini");
            CacheHelper::forget("kanal_{$post->kategori->slug}_terpopuler");
        }

        CacheHelper::forget("article_{$post->id}");
    }
}
