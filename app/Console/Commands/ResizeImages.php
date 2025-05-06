<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Helpers\ImageResizeHelper;

class ResizeImages extends Command
{
    protected $signature = 'images:resize';
    protected $description = 'Resize images and move them to the destination folder';

    // public function handle()
    // {
    //     ini_set('memory_limit', '-1');

    //     $sourceDir = public_path('storage/gambar/*');
    //     $destinationDir = public_path('storage/photos/shares');

    //     if (!File::exists($sourceDir)) {
    //         $this->error("❌ Folder sumber tidak ditemukan di: $sourceDir");
    //         return;
    //     }

    //     $this->info("📂 Memeriksa folder sumber: $sourceDir");

    //     if (!File::exists($destinationDir)) {
    //         $this->info("📂 Folder tujuan tidak ada, membuat folder baru: $destinationDir");
    //         File::makeDirectory($destinationDir, 0777, true);
    //     }

    //     $allFiles = array_diff(scandir($sourceDir), array('.', '..'));
    //     $imagePaths = [];

    //     foreach ($allFiles as $file) {
    //         if (preg_match('/\.(jpg|jpeg|png)$/i', $file)) {
    //             $imagePaths[] = $file;
    //         }
    //     }

    //     $this->info("🔍 Jumlah file ditemukan: " . count($imagePaths));

    //     if (empty($imagePaths)) {
    //         $this->info("❌ Tidak ada file gambar di folder sumber.");
    //         return;
    //     }

    //     $batchSize = 500;
    //     $chunks = array_chunk($imagePaths, $batchSize);

    //     foreach ($chunks as $batch) {
    //         foreach ($batch as $file) {
    //             $imagePath = $sourceDir . '/' . $file;
    //             $filename = basename($file);

    //             if (preg_match('/-\d+x\d+\.(jpg|jpeg|png)$/i', $filename)) {
    //                 $this->line("<fg=yellow>⏩ Melewati file duplikat: $filename</>");
    //                 continue;
    //             }

    //             if (File::exists($destinationDir . '/' . $filename)) {
    //                 $this->line("<fg=yellow>File sudah ada: $filename, melewati file ini.</>");
    //                 continue;
    //             }

    //             $this->info("🔄 Memulai proses resize untuk: $filename");

    //             $resizeResult = ImageResizeHelper::MigrasiResize($imagePath, $filename, $filename);

    //             if (!isset($resizeResult['resized_path']) || isset($resizeResult['error'])) {
    //                 $this->error("❌ Error resizing image: $filename");
    //                 continue;
    //             }

    //             $destinationPath = $destinationDir . '/' . $filename;

    //             if (File::move($resizeResult['resized_path'], $destinationPath)) {
    //                 $this->info("✅ Berhasil memindahkan gambar ke folder tujuan: $destinationPath");
    //             } else {
    //                 $this->error("❌ Gagal memindahkan gambar ke folder tujuan: $destinationPath");
    //             }

    //             gc_collect_cycles();
    //             sleep(1);
    //         }
    //     }

    //     $this->info('📦 Proses resize gambar selesai.');
    // }

    // public function handle()
    // {
    //     ini_set('memory_limit', '-1');

    //     $sourceDir = public_path('storage/gambar');
    //     $destinationDir = public_path('storage/photos/shares');

    //     if (!File::exists($sourceDir)) {
    //         $this->error("❌ Folder sumber tidak ditemukan di: $sourceDir");
    //         return;
    //     }

    //     $this->info("📂 Memeriksa folder sumber: $sourceDir");

    //     if (!File::exists($destinationDir)) {
    //         $this->info("📂 Folder tujuan tidak ada, membuat folder baru: $destinationDir");
    //         File::makeDirectory($destinationDir, 0777, true);
    //     }

    //     $allFiles = File::allFiles($sourceDir);
    //     $imagePaths = [];

    //     foreach ($allFiles as $file) {
    //         $filename = $file->getFilename();
    //         if (preg_match('/\.(jpg|jpeg|png)$/i', $filename)) {
    //             $imagePaths[] = $file;
    //         }
    //     }

    //     $this->info("🔍 Jumlah file ditemukan: " . count($imagePaths));

    //     if (empty($imagePaths)) {
    //         $this->info("❌ Tidak ada file gambar di folder sumber.");
    //         return;
    //     }

    //     $batchSize = 500;
    //     $chunks = array_chunk($imagePaths, $batchSize);

    //     foreach ($chunks as $batch) {
    //         foreach ($batch as $file) {
    //             $imagePath = $file->getRealPath();
    //             $filename = $file->getFilename();

    //             if (preg_match('/-\d+x\d+\.(jpg|jpeg|png)$/i', $filename)) {
    //                 $this->line("<fg=yellow>⏩ Melewati file duplikat: $filename</>");
    //                 continue;
    //             }

    //             if (File::exists($destinationDir . '/' . $filename)) {
    //                 $this->line("<fg=yellow>File sudah ada: $filename, melewati file ini.</>");
    //                 continue;
    //             }

    //             $this->info("🔄 Memulai proses resize untuk: $filename");

    //             $resizeResult = ImageResizeHelper::MigrasiResize($imagePath, $filename, $filename);

    //             if (!isset($resizeResult['resized_path']) || isset($resizeResult['error'])) {
    //                 $this->error("❌ Error resizing image: $filename");
    //                 continue;
    //             }

    //             $destinationPath = $destinationDir . '/' . $filename;

    //             if (File::move($resizeResult['resized_path'], $destinationPath)) {
    //                 $this->info("✅ Berhasil memindahkan gambar ke folder tujuan: $destinationPath");
    //             } else {
    //                 $this->error("❌ Gagal memindahkan gambar ke folder tujuan: $destinationPath");
    //             }

    //             gc_collect_cycles();
    //             sleep(1);
    //         }
    //     }

    //     $this->info('📦 Proses resize gambar selesai.');
    // }
    


    public function handle()
    {
        ini_set('memory_limit', '-1');
    
        $sourceDir = public_path('storage/gambar');
        $destinationDir = public_path('storage/comp');
        $thumbDir = public_path('storage/photos/shares');
    
        if (!File::exists($sourceDir)) {
            $this->error("❌ Folder sumber tidak ditemukan di: $sourceDir");
            return;
        }
    
        $this->info("📂 Memeriksa folder sumber: $sourceDir");
    
        if (!File::exists($destinationDir)) {
            $this->info("📂 Membuat folder tujuan gambar: $destinationDir");
            File::makeDirectory($destinationDir, 0777, true);
        }
    
        if (!File::exists($thumbDir)) {
            $this->info("📂 Membuat folder tujuan thumbnail: $thumbDir");
            File::makeDirectory($thumbDir, 0777, true);
        }
    
        $allFiles = File::allFiles($sourceDir);
        $imagePaths = [];
    
        foreach ($allFiles as $file) {
            if (preg_match('/\.(jpg|jpeg|png)$/i', $file->getFilename())) {
                $imagePaths[] = $file->getRealPath();
            }
        }
    
        $this->info("🔍 Jumlah file ditemukan: " . count($imagePaths));
    
        if (empty($imagePaths)) {
            $this->info("❌ Tidak ada file gambar di folder sumber.");
            return;
        }
    
        foreach ($imagePaths as $imagePath) {
            $filename = basename($imagePath);
    
            $destImagePath = $destinationDir . '/' . $filename;
            $destThumbPath = $thumbDir . '/' . $filename;
    
            $this->info("🔄 Resize ke 651x360 → $destImagePath");
            $resizeMain = $this->resizeImage($imagePath, $destImagePath, 651, 360);
    
            if ($resizeMain) {
                $this->info("✅ Berhasil simpan gambar di: $destImagePath");
            } else {
                $this->error("❌ Gagal resize ke gambar: $filename");
            }
    
            $this->info("🔄 Resize thumbnail 123x123 → $destThumbPath");
            $resizeThumb = $this->resizeImage($imagePath, $destThumbPath, 123, 123);
    
            if ($resizeThumb) {
                $this->info("✅ Berhasil simpan thumbnail di: $destThumbPath");
            } else {
                $this->error("❌ Gagal resize thumbnail: $filename");
            }
        }
    
        $this->info('📦 Semua proses resize selesai.');
    }
    
    private function resizeImage($srcPath, $destPath, $newWidth, $newHeight)
    {
        $info = getimagesize($srcPath);
        if (!$info) return false;
    
        [$width, $height] = $info;
        $mime = $info['mime'];
    
        $aspectRatio = $width / $height;
    
        if ($width > $height) {
            $newWidth = $newWidth;
            $newHeight = round($newWidth / $aspectRatio);
        } else {
            $newHeight = $newHeight;
            $newWidth = round($newHeight * $aspectRatio);
        }
    
        switch ($mime) {
            case 'image/jpeg':
                $srcImage = imagecreatefromjpeg($srcPath);
                break;
            case 'image/png':
                $srcImage = imagecreatefrompng($srcPath);
                break;
            case 'image/webp':
                $srcImage = imagecreatefromwebp($srcPath);
                break;
            default:
                return false;
        }
    
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
    
        if ($mime === 'image/png' || $mime === 'image/webp') {
            imagealphablending($resizedImage, false);
            imagesavealpha($resizedImage, true);
        }
    
        imagecopyresampled(
            $resizedImage, $srcImage,
            0, 0, 0, 0,
            $newWidth, $newHeight,
            $width, $height
        );
    
        $success = false;
        switch ($mime) {
            case 'image/jpeg':
                $success = imagejpeg($resizedImage, $destPath, 90);
                break;
            case 'image/png':
                $success = imagepng($resizedImage, $destPath, 9);
                break;
            case 'image/webp':
                $success = imagewebp($resizedImage, $destPath, 80);
                break;
        }
    
        imagedestroy($srcImage);
        imagedestroy($resizedImage);
    
        return $success;
    }
    
}
