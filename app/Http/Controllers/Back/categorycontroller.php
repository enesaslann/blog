<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\category;

use App\Models\content;
use Illuminate\Support\Str;

class categorycontroller extends Controller
{
    public function index()
    {
        $this->data['category'] = category::all();
        return view('back\categories\index', $this->data);
    }
    public function switch(Request $request)
    {
        $category = category::findOrFail($request->id);
        $category->status = $request->statu == 'true' ? 1 : 0;
        $category->save();
    }
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'min:5|required',
        ]);
        $isexist = category::whereSlug(Str::slug($request->name))->first();
        if ($isexist) {
            toastr()->error($request->name . ' adında kategori zaten mevcut!');
            return redirect()->back();
        }
        $category = new category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();
        toastr()->success('Başarılı!', 'Kategori, Başarılı Bir Şekilde Oluşturuldu');
        return redirect()->back();
    }
    public function edit(Request $request)
    {
        $this->data['category'] = category::findOrFail($request->id);;
        return response()->json($this->data);
    }
    public function update(Request $request, Response $res)
    {
        $request->validate([
            'name' => 'min:5|required',
            "id" => "required"
        ]);
        $isexist = category::whereName($request->name)->whereNotIn('id',[$request->id])->first();
        if ($isexist) {
            return response()->json([
                "status" => "error",
                "data" => $request->name . ' adında kategori zaten mevcut!'
            ]);
        }
        $category = category::findOrFail($request->id);
        $category->name = $request->name;
        $category->save();
        return response()->json([
            "status" => "success",
            "data" => "Kategori ismi başarı ile güncellendi.Sayfayı Güncelleyin"
        ]);
        
    }
    public function delete(Request $request)
    {
        $category=category::findOrFail($request->id);
        if ($category->id==1) {
        toastr()->error('Bu kategori silinemez', 'Başarısız !');
        return redirect()->route('category_index');
        }
        $message='';
        $count=$category->contentCount();
        if ($count>0) {
            content::where('category_id',$category->id)->update(['category_id'=>1]);
            $defualcategory=category::find(1);
            $message='Bu kategoriye ait '.$count.' makale '.$defualcategory->name.' kategorisine taşındı.';
        }
        $category->delete();
        toastr()->success('Kategori başarıyla silindi', $message);
        return redirect()->route('category_index');
    }
}
