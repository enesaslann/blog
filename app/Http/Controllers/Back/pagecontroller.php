<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\page;

use Illuminate\Http\Response;

use App\Models\category;

use App\Models\content;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\RequestStack;

class pagecontroller extends Controller
{
    public function index()
    {
        $this->data['pages'] = page::all();
        return view('back/page/index', $this->data);
    }
    public function orders(Request $request)
    {
        foreach ($request->get('page') as $key => $order) {
            page::where('id',$order)->update(['order'=>$key]);
        }
    }
    public function switch(Request $request)
    {
        $page = page::findOrFail($request->id);
        $page->status = $request->statu == 'true' ? 1 : 0;
        $page->save();
    }
    public function edit($id)
    {
        $this->data['pages'] = page::findOrFail($id);
        return view("back\page\update", $this->data);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'min:5',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $page = page::findOrFail($id);
        $page->title = $request->title;
        $page->content = $request->content;
        $page->slug = Str::slug($request->title);
        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->title) . '.' . $request->image->getClientOriginalextension();
            $request->image->move(public_path('uploads'), $imageName);
            $page->image = '/uploads/' . $imageName;
        }
        $page->save();
        toastr()->success('Başarılı !', 'Sayfa, Başarılı Bir Şekilde Güncelleştirildi');
        return redirect()->route('page_index');
    }
    public function delete($id)
    {
        page::find($id)->delete();
        toastr()->success('Sayfa, Silinen Sayfalar Arasına Taşındı ', 'Başarılı !');
        return redirect()->route('page_index');
    }
    public function trashed()
    {
        $this->data['pages'] = page::onlyTrashed()->orderBy('created_at', 'ASC')->get();
        return view('back\page\trashed', $this->data);
    }
    public function recover($id)
    {
        page::onlyTrashed()->find($id)->restore();
        toastr()->success('Sayfa, Başarılı Bir Şekilde Kurtarıldı', 'Başarılı !');
        return redirect()->back();
    }

    public function hardDelete($id)
    {
        $content = page::onlyTrashed()->find($id);
        if (File::exists(public_path($content->image))) {
            File::delete(public_path($content->image));
        }
        $content->forceDelete();
        toastr()->success('Sayfa, Başarılı Bir Şekilde Silindi', 'Başarılı !');
        return redirect()->back();
    }
    public function create()
    {
        return view("back\page\create");
    }
    public function save(Request $request)
    {

        $request->validate([
            'title' => 'min:5',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $last = page::orderBy('order', 'desc')->first();
        $page = new page();
        $page->title = $request->title;
        $page->content = $request->content;
        $page->order = $last->order + 1;
        $page->slug = Str::slug($request->title);
        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->title) . '.' . $request->image->getClientOriginalextension();
            $request->image->move(public_path('uploads'), $imageName);
            $page->image = '/uploads/' . $imageName;
        }
        $page->save();
        toastr()->success('Başarılı!', 'Sayfa, Başarılı Bir Şekilde Oluşturuldu');
        return redirect()->route('page_index');
    }
}
