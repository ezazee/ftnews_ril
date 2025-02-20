<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use GuzzleHttp\Client;

class MediaController extends Controller
{
    public function create()
    {
        $media = Media::all();
        return view('setting.media',compact('media'));
    }

    public function store(Request $request)
    {
        $media = Media::first(); 

        if ($media) {
            $media->update([
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'tiktok' => $request->tiktok,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
            ]);
        } else {
            Media::create([
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'tiktok' => $request->tiktok,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
            ]);
        }
        return redirect()->route('media.create')->with('success', 'Media settings saved successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
