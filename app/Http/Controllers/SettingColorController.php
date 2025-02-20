<?php

namespace App\Http\Controllers;

use App\Models\SettingColor;
use GuzzleHttp\Cookie\SetCookie;
use Illuminate\Http\Request;


class SettingColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(SettingColor $settingColor)
    {
        return view('settingColor.edit', compact('settingColor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SettingColor $settingColor)
    { {
            $input = $request->all();

            $input = SettingColor::findOrFail($settingColor);
            $settingColor->update($input);

            return redirect()->route('settingColor.edit', $settingColor->id)->with(['success' => 'Data Berhasil Diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
