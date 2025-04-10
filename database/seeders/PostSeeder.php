<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\Categori;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run()
    {
        $jsonPath = database_path('/seeders/indopop.json');   
    
        if (File::exists($jsonPath)) {
            $jsonData = File::get($jsonPath);
            $posts = json_decode($jsonData, true);

            if (!is_array($posts)) {
                throw new \Exception("Data JSON tidak valid: " . json_last_error_msg());
            }
    
            $categories = [];
    
            foreach ($posts as $post) {
                $categoryList = explode('|', $post['Categories']);
    
                foreach ($categoryList as $category) {
                    $categories[] = trim($category);
                }
            }
    
            $categories = array_unique($categories);
    
            foreach ($categories as $categoryName) {
                if (strtolower($categoryName) === 'uncategorized') {
                    continue;
                }
    
                $slug = Str::slug($categoryName);
    
                if (!DB::table('categories')->where('slug', $slug)->exists()) {
                    DB::table('categories')->insert([
                        'nama_kategori' => $categoryName,
                        'slug' => $slug
                    ]);
                }
            }
    
            foreach ($posts as $postData) {
                $category = DB::table('categories')->where('nama_kategori', $postData['Categories'])->first();
    
                $headlineStatus = 'no';
    
                if (!empty($postData['Tags'])) {
                    $tags = explode('|', $postData['Tags']);
            
                    foreach ($tags as $tagName) {
                        $tagName = trim($tagName);
    
                        if (strtolower($tagName) === 'headline 1') {
                            $headlineStatus = 'yes';
                            break;
                        }
                    }
                }

                $user = DB::table('users')->where('email', $postData['Author Email'])->first();
                $userId = $user ? $user->id : 1;

                $gambarUrls = explode('|', $postData['Image URL']);
                $gambarUrls = array_map(function ($url) {
                    return preg_replace('/https:\/\/indopop\.id\/wp-content\/uploads\/\d{4}\/\d{2}\//','https://indopop.id/storage/photos/shares/', $url);
                }, $gambarUrls);
                $gambar = implode('|', $gambarUrls);

            // **Skip jika "content" null atau kosong**
                if (empty($postData['Content'])) {
                    echo "Skipping post with empty content: " . ($postData['Title'] ?? 'No Title') . "\n";
                    continue;
                }

                $content = $postData['Content'] ?? null;

                if (!empty($content)) {
                    $content = preg_replace('/https:\/\/indopop\.id\/wp-content\/uploads\/\d{4}\/\d{2}\//', 'https://indopop.id/storage/photos/shares/', $content);
                }
                
                $postDataArray = [
                    'title' => $postData['Title'] ?? null,
                    'content' => $content,
                    'gambar' => $gambar ?? null,
                    'image_caption' => $postData['Image Caption'] ?? null,
                    'slug' => $postData['Slug'] ?? null,
                    'status' => $postData['Status'] ?? 'draft',
                    'kategori_id' => $category ? $category->id : 1,
                    'headline' => $headlineStatus,
                    'user_id' => $userId,
                    'created_at' => !empty($postData['Date'])
                        ? Carbon::createFromFormat('Y-m-d', $postData['Date'])->format('Y-m-d H:i:s')
                        : now()->format('Y-m-d H:i:s'),
                ];
                
                $postDataArray = array_filter($postDataArray, function ($value) {
                    return $value !== null;
                });
                
                $post = Post::create($postDataArray);
            
                if (!empty($postData['Tags'])) {
                    echo 'Raw Tags: ' . $postData['Tags'] . "\n";
                    
                    $tags = explode('|', $postData['Tags']);
                    echo 'Exploded Tags: ' . implode(', ', $tags) . "\n";
            
                    foreach ($tags as $tagName) {
                        $tagName = trim($tagName);
                        echo 'Processing Tag: ' . $tagName . "\n";
                        
                        $tag = Tag::firstOrCreate([
                            'nama_tags' => $tagName,
                            'slug' => Str::slug($tagName),
                        ]);
                        
                        echo 'Tag Created: ' . $tag->nama_tags . "\n";
                        
                        $post->tags()->attach($tag->id);
                    }
                }
            }
                
            $this->command->info('PostSeeder: Data posts berhasil dimasukkan dari file JSON.');
        } else {
            $this->command->error("File JSON tidak ditemukan di path: {$jsonPath}");
        }
    }
    
}
