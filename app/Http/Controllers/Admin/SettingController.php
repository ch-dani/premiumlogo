<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.index', [
            'Languages' => $Languages = Language::all(),
            'social_twitter' => Setting::findByName('social_twitter')->data ?? '',
            'social_facebook' => Setting::findByName('social_facebook')->data ?? '',
            'social_instagram' => Setting::findByName('social_instagram')->data ?? '',
            'social_youtube' => Setting::findByName('social_youtube')->data ?? '',
            'footer_text' => Setting::findByName('footer_text')->data ?? '',
            'footer_copyright' => Setting::findByName('footer_copyright')->data ?? '',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach ($request->settings as $name => $value) {
            $setting = Setting::findByName($name);
            if (!is_null($setting)) {
                $setting->update(['data' => is_array($value) ? $value : ['value' => strlen($value) ? $value : null]]);
            } else {
                Setting::create([
                    'name' => $name,
                    'data' => is_array($value) ? $value : ['value' => strlen($value) ? $value : null]
                ]);
            }
        }

        foreach ($request->payments as $name => $value) {
            Setting::updateOrCreate(
                [
                    'name' => $name
                ],
                [
                    'name' => $name,
                    'data' => $value
                ]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Settings successfully updated.',
//			'redirect' => route('admin.icons.index'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
