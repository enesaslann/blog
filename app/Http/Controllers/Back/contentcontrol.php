<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use stdClass;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\content;
use App\Models\category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class contentcontrol extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = content::all();
        $this->data['content'] = $content;
        return view('back\content\index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['category'] = category::all();
        return view("back\content\create", $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'min:5',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $content = new content();
        $content->title = $request->title;
        $content->category_id = $request->category;
        $content->content = $request->content;
        $content->slug = Str::slug($request->title);
        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->title) . '.' . $request->image->getClientOriginalextension();
            $request->image->move(public_path('uploads'), $imageName);
            $content->image = '/uploads/' . $imageName;
        }
        $content->save();
        toastr()->success('Başarılı!', 'Makale, Başarılı Bir Şekilde Oluşturuldu');
        return redirect()->route('makale');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function edit($id)
    {
        $this->data['content'] = content::findOrFail($id);
        $this->data['category'] = category::all();
        return view("back\content\update", $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'min:5',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $content = content::findOrFail($id);
        $content->title = $request->title;
        $content->category_id = $request->category;
        $content->content = $request->content;
        $content->slug = Str::slug($request->title);
        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->title) . '.' . $request->image->getClientOriginalextension();
            $request->image->move(public_path('uploads'), $imageName);
            $content->image = '/uploads/' . $imageName;
        }
        $content->save();
        toastr()->success('Başarılı !', 'Makale, Başarılı Bir Şekilde Güncelleştirildi');
        return redirect()->route('makale');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function switch(Request $request)
    {
        $content = content::findOrFail($request->id);
        $content->status = $request->statu == 'true' ? 1 : 0;
        $content->save();
    }
    public function delete($id)
    {
        content::find($id)->delete();
        toastr()->success('Makale, Silinen Makaleler Arasına Taşındı ', 'Başarılı !');
        return redirect()->route('makale');
    }
    public function trashed()
    {
        $this->data['content'] = content::onlyTrashed()->orderBy('created_at', 'ASC')->get();
        return view('back\content\trashed',$this->data);
    }
    public function recover($id)
    {
        content::onlyTrashed()->find($id)->restore();
        toastr()->success('Makale, Başarılı Bir Şekilde Kurtarıldı', 'Başarılı !');
        return redirect()->back();
    }
    public function hardDelete($id)
    {
        $content=content::onlyTrashed()->find($id);
        if(File::exists(public_path($content->image))) {
            File::delete(public_path($content->image));
        }
        $content->forceDelete();
        toastr()->success('Makale, Başarılı Bir Şekilde Silindi', 'Başarılı !');
        return redirect()->route('makale');
    }
}
