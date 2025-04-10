<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Helpers\ImageResizeHelper;

class ResizeImages extends Command
{
    protected $signature = 'images:resize';
    protected $description = 'Resize images and move them to the destination folder';

    public function handle()
    {
        ini_set('memory_limit', '-1');

        $sourceDir = public_path('storage/gambar');
        $destinationDir = public_path('storage/photos/shares');

        if (!File::exists($sourceDir)) {
            $this->error("❌ Folder sumber tidak ditemukan di: $sourceDir");
            return;
        }

        $this->info("📂 Memeriksa folder sumber: $sourceDir");

        if (!File::exists($destinationDir)) {
            $this->info("📂 Folder tujuan tidak ada, membuat folder baru: $destinationDir");
            File::makeDirectory($destinationDir, 0777, true);
        }

        $allFiles = array_diff(scandir($sourceDir), array('.', '..'));
        $imagePaths = [];

        foreach ($allFiles as $file) {
            if (preg_match('/\.(jpg|jpeg|png)$/i', $file)) {
                $imagePaths[] = $file;
            }
        }

        $this->info("🔍 Jumlah file ditemukan: " . count($imagePaths));

        if (empty($imagePaths)) {
            $this->info("❌ Tidak ada file gambar di folder sumber.");
            return;
        }

        $batchSize = 500;
        $chunks = array_chunk($imagePaths, $batchSize);

        foreach ($chunks as $batch) {
            foreach ($batch as $file) {
                $imagePath = $sourceDir . '/' . $file;
                $filename = basename($file);

                if (preg_match('/-\d+x\d+\.(jpg|jpeg|png)$/i', $filename)) {
                    $this->line("<fg=yellow>⏩ Melewati file duplikat: $filename</>");
                    continue;
                }

                if (File::exists($destinationDir . '/' . $filename)) {
                    $this->line("<fg=yellow>File sudah ada: $filename, melewati file ini.</>");
                    continue;
                }

                $this->info("🔄 Memulai proses resize untuk: $filename");

                $resizeResult = ImageResizeHelper::MigrasiResize($imagePath, $filename, $filename);

                if (!isset($resizeResult['resized_path']) || isset($resizeResult['error'])) {
                    $this->error("❌ Error resizing image: $filename");
                    continue;
                }

                $destinationPath = $destinationDir . '/' . $filename;

                if (File::move($resizeResult['resized_path'], $destinationPath)) {
                    $this->info("✅ Berhasil memindahkan gambar ke folder tujuan: $destinationPath");
                } else {
                    $this->error("❌ Gagal memindahkan gambar ke folder tujuan: $destinationPath");
                }

                gc_collect_cycles();
                sleep(1);
            }
        }

        $this->info('📦 Proses resize gambar selesai.');
    }
}
