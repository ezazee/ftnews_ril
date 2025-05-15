<?php

namespace UniSharp\LaravelFilemanager\Controllers;

use Illuminate\Support\Facades\Storage;
use UniSharp\LaravelFilemanager\Events\FileIsMoving;
use UniSharp\LaravelFilemanager\Events\FileWasMoving;
use UniSharp\LaravelFilemanager\Events\FolderIsMoving;
use UniSharp\LaravelFilemanager\Events\FolderWasMoving;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use FilesystemIterator;
use Illuminate\Support\Collection;


class ItemsController extends LfmController
{
    /**
     * Get the images to load for a selected folder.
     *
     * @return mixed
     */

     public function getItems(Request $request)
    {
         $currentPage = self::getCurrentPageFromRequest();
         $perPage = $this->helper->getPaginationPerPage();
         $search = $request->input('search_query');
 
         $workingDir = $this->lfm->path('public');
        
         if (!file_exists($workingDir)) {
             return response()->json([
                 'items' => [],
                 'paginator' => [
                     'current_page' => $currentPage,
                     'total' => 0,
                     'per_page' => $perPage,
                     'last_page' => 0,
                 ],
                 'display' => $this->helper->getDisplayMode(),
                 'working_dir' => $workingDir,
             ]);
         }
 
         $iterator = new FilesystemIterator($workingDir);
         $matchingFiles = [];
 
         foreach ($iterator as $fileInfo) {
             $name = $fileInfo->getFilename();
 
            if (!empty($search)) {
                $searchLower = mb_strtolower(trim($search));
                $nameLower = mb_strtolower($name);
                if (mb_stripos($nameLower, $searchLower) === false) {
                    continue;
                }
            }
 
             $extension = strtolower($fileInfo->getExtension());
             $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
 
             $isImage = in_array($extension, $imageExtensions);
             $icon = $isImage ? 'fa-image' : 'fa-file';
 
             $matchingFiles[] = (object)[
                 'name' => $name,
                 'path' => $fileInfo->getPathname(),
                 'url' => str_replace('/storage/photos/shares/', '/storage/comp/', $this->lfm->url($name)."/".$name),
                 'time' => $fileInfo->getMTime(),
                 'icon' => $icon,
                 'is_file' => $fileInfo->isFile(),
                 'is_image' => $isImage,
                 'thumb_url' => $isImage ? asset($this->lfm->url($name)."/".$name) : null,
             ];
         }
 
         usort($matchingFiles, fn($a, $b) => $b->time <=> $a->time);
 
         $totalFound = count($matchingFiles);
         $sliced = array_slice($matchingFiles, ($currentPage - 1) * $perPage, $perPage);
         $items = collect($sliced)->values();
 
         return response()->json([
             'items' => $items,
             'paginator' => [
                 'current_page' => $currentPage,
                 'total' => $totalFound,
                 'per_page' => $perPage,
                 'last_page' => ceil($totalFound / $perPage),
             ],
             'display' => $this->helper->getDisplayMode(),
             'working_dir' => '/shares',
         ]);
    }
     
    public function move()
    {
        $items = request('items');
        $folder_types = array_filter(['user', 'share'], function ($type) {
            return $this->helper->allowFolderType($type);
        });
        return view('laravel-filemanager::move')
            ->with([
                'root_folders' => array_map(function ($type) use ($folder_types) {
                    $path = $this->lfm->dir($this->helper->getRootFolder($type));

                    return (object) [
                        'name' => trans('laravel-filemanager::lfm.title-' . $type),
                        'url' => $path->path('working_dir'),
                        'children' => $path->folders(),
                        'has_next' => ! ($type == end($folder_types)),
                    ];
                }, $folder_types),
            ])
            ->with('items', $items);
    }

    public function doMove()
    {
        $target = $this->helper->input('goToFolder');
        $items = $this->helper->input('items');

        foreach ($items as $item) {
            $old_file = $this->lfm->pretty($item);
            $is_directory = $old_file->isDirectory();

            $file = $this->lfm->setName($item);

            if (!Storage::disk($this->helper->config('disk'))->exists($file->path('storage'))) {
                abort(404);
            }

            $old_path = $old_file->path();

            if ($old_file->hasThumb()) {
                $new_file = $this->lfm->setName($item)->thumb()->dir($target);
                if ($is_directory) {
                    event(new FolderIsMoving($old_file->path(), $new_file->path()));
                } else {
                    event(new FileIsMoving($old_file->path(), $new_file->path()));
                }
                $this->lfm->setName($item)->thumb()->move($new_file);
            }
            $new_file = $this->lfm->setName($item)->dir($target);
            $this->lfm->setName($item)->move($new_file);
            if ($is_directory) {
                event(new FolderWasMoving($old_path, $new_file->path()));
            } else {
                event(new FileWasMoving($old_path, $new_file->path()));
            }
        };

        return parent::$success_response;
    }

    private static function getCurrentPageFromRequest()
    {
        $currentPage = (int) request()->get('page', 1);
        $currentPage = $currentPage < 1 ? 1 : $currentPage;

        return $currentPage;
    }
}
