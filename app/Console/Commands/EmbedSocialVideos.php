<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class EmbedSocialVideos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'embed:social';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Embed TikTok, YouTube, Instagram, and Facebook videos in post content';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $posts = Post::all();

        foreach ($posts as $post) {
            $originalContent = $post->content;
            $processedContent = $this->processContent($post->content);

            // Debugging output
            if ($processedContent !== $originalContent) {
                $this->info("Updated post ID {$post->id}");
                $this->info("Original Content: " . $originalContent);
                $this->info("Processed Content: " . $processedContent);
            }

            $post->content = $processedContent;
            $post->save();
        }

        $this->info('Social videos embedded and [embed] tags removed successfully.');
        return 0;
    }

    /**
     * Process the content to embed social videos and remove [embed] tags.
     *
     * @param string $content
     * @return string
     */
    protected function processContent($content)
    {
        // Replace [embed] tags with appropriate embed codes
        $content = preg_replace_callback('/\[embed\](.*?)\[\/embed\]/s', function ($matches) {
            $url = trim($matches[1]);
    
            // TikTok
            if (preg_match('/https:\/\/www\.tiktok\.com\/@([a-zA-Z0-9_.]+)\/video\/([0-9]+)/', $url, $urlMatches)) {
                return '<blockquote class="tiktok-embed" cite="' . $url . '" data-video-id="' . $urlMatches[2] . '" style="max-width: 605px;min-width: 325px;">
                    <section>
                        <a target="_blank" title="@' . $urlMatches[1] . '" href="' . $url . '">@' . $urlMatches[1] . '</a>
                        <p></p>
                        <a target="_blank" title="♬ original sound" href="https://www.tiktok.com/music/original-sound-' . $urlMatches[2] . '?refer=embed"></a>
                    </section>
                </blockquote>
                <script async src="https://www.tiktok.com/embed.js"></script>';
    
            // YouTube
            } elseif (preg_match('/https:\/\/www\.youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $urlMatches)) {
                return '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $urlMatches[1] . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    
            // Instagram
            } elseif (preg_match('/https:\/\/www\.instagram\.com\/p\/([a-zA-Z0-9_-]+)/', $url, $urlMatches)) {
                return '<blockquote class="instagram-media" data-instgrm-permalink="' . $url . '" style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px rgba(0,0,0,0.3); margin:1px; max-width:540px; width:calc(100% - 2px); padding:0; position:relative; min-width: 326px;">
                    <div style="padding:16px;">
                        <a href="' . $url . '" style="background:#FFF; line-height:0; padding:0; text-align:center; text-decoration:none; display:block; position:relative; color:#000;">
                            <div style="display:block; overflow:hidden; position:relative;">
                                <div style="padding:0; margin:0; line-height:0;">
                                    <img alt="Instagram post" style="display:block; height:auto; max-width:100%; width:100%; margin:0; padding:0; border:0; border-radius:3px;" src="https://instagram.fdel10-1.fna.fbcdn.net/v/t51.2885-15/145743095_506597712080590_2940911065299170811_n.jpg?tp=1&_nc_ht=instagram.fdel10-1.fna.fbcdn.net&_nc_cat=107&_nc_ohc=jbN5x0Xj8h0AX88Ofbs&edm=AO4xN3wEAAAA&ccb=7-5&oh=6d63ff13d754c5da3b5f3e6b6d1a3a95&oe=614A7F5F" />
                                </div>
                            </div>
                        </a>
                    </div>
                </blockquote>
                <script async defer src="https://www.instagram.com/embed.js"></script>';
    
            // Facebook
            } elseif (preg_match('/https:\/\/www\.facebook\.com\/([a-zA-Z0-9.]+)\/videos\/([0-9]+)/', $url, $urlMatches)) {
                return '<iframe src="https://www.facebook.com/plugins/video.php?href=' . $url . '" width="560" height="315" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen></iframe>';
            }
    
            // Return the original content if no match
            return $matches[0];
        }, $content);
    
        // Remove any remaining unwanted text or attributes
        $content = preg_replace('/" data-video-id=".*?" style="max-width: 605px;min-width: 325px;">@.*?<\/blockquote>/', '', $content);
    
        return $content;
    }
    
}
