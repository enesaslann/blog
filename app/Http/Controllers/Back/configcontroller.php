<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\config;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class configcontroller extends Controller
{
    public function index()
    {
        $this->data['config'] = config::find(1);
        return view('back\config\index', $this->data);
    }
    public function update(Request $request)
    {
        $config = config::find(1);
        $config->title = $request->title;
        $config->active = $request->active;
        $config->facebook = $request->facebook;
        $config->twitter = $request->twitter;
        $config->linkedin = $request->linkedin;
        $config->github = $request->github;
        $config->instagram = $request->instagram;
        $config->youtube = $request->youtube;
        if ($request->hasFile('logo')) {
            $logo = Str::slug($request->title) . '-logo'.'.'. $request->logo->getClientOriginalextension();
            $request->logo->move(public_path('uploads'), $logo);
            $config->logo = '/uploads/' . $logo;
        }
        if ($request->hasFile('favicon')) {
            $favicon = Str::slug($request->title) . '-favicon'.'.'. $request->favicon->getClientOriginalextension();
            $request->favicon->move(public_path('uploads'), $favicon);
            $config->favicon = '/uploads/' . $favicon;
        }
        $config->save();
        toastr()->success('Başarılı !', 'Ayarlar, Başarılı Bir Şekilde Güncelleştirildi');
        return redirect()->back();
    }
}
