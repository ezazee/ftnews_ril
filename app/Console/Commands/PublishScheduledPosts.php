<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\Log;
use Carbon\Carbon;
use Exception;

class PublishScheduledPosts extends Command
{
    protected $signature = 'posts:update-status';
    protected $description = 'Update the status of posts scheduled to be published';

    public function handle()
    {
        $currentDateTime = Carbon::now('Asia/Jakarta');
        $this->info("Menjalankan scheduler pada: " . $currentDateTime);

        $currentDate = $currentDateTime->format('Y-m-d');
        $currentTime = $currentDateTime->format('H:i:s');

        $posts = Post::where('status', 'schedule')
            ->where(function ($query) use ($currentDate, $currentTime) {
                $query->where(function ($query) use ($currentDate, $currentTime) {
                    $query->where('start_date', '=', $currentDate)
                          ->where('start_time', '<=', $currentTime);
                })
                ->orWhere('start_date', '<', $currentDate);
            })
            ->get();

        if ($posts->isEmpty()) {
            $this->info('Tidak ada post yang siap dipublish.');
            return;
        }

        foreach ($posts as $post) {
            try {
                $scheduledDateTime = Carbon::parse(
                    $post->start_date . ' ' . $post->start_time,
                    'Asia/Jakarta'
                );

                Post::withoutEvents(function () use ($post, $scheduledDateTime) {
                    $post->timestamps = false;
                    $post->status = 'public';
                    $post->created_at = $scheduledDateTime;
                    $post->save();
                    $post->timestamps = true;
                });

                Log::create([
                    'created_datetime'     => $currentDateTime->format('Y-m-d H:i:s'),
                    'title_article'        => $post->title,
                    'id_article'           => $post->id,
                    'activity'             => 'auto_publish schedule',
                    'user_name'            => 'System',
                    'user_id'              => null,
                    'roles'                => 'system',
                    'status'               => 'publish',
                    'scheduled_time'       => "{$post->start_date} {$post->start_time}",
                    'article_created_at'   => $scheduledDateTime->format('Y-m-d H:i:s'),
                    'article_published_at' => $scheduledDateTime->format('Y-m-d H:i:s'),
                    'message'              => "Post '{$post->title}' otomatis dipublish oleh scheduler."
                ]);

                $this->info(
                    "✅ Post ID {$post->id} dipublish. created_at diset ke {$scheduledDateTime}"
                );
            } catch (Exception $e) {
                Log::create([
                    'created_datetime'     => $currentDateTime->format('Y-m-d H:i:s'),
                    'title_article'        => $post->title ?? 'Unknown',
                    'id_article'           => $post->id ?? null,
                    'activity'             => 'auto_publish_error',
                    'user_name'            => 'System',
                    'user_id'              => null,
                    'roles'                => 'system',
                    'status'               => 'error',
                    'scheduled_time'       => "{$post->start_date} {$post->start_time}",
                    'article_created_at'   => $post->created_at?->format('Y-m-d H:i:s'),
                    'article_published_at' => null,
                    'message'              => "Gagal mempublish post: " . $e->getMessage()
                ]);

                $this->error("❌ Gagal mempublish post ID {$post->id}: " . $e->getMessage());
            }
        }

        $this->info('Proses update status selesai.');
    }
}
