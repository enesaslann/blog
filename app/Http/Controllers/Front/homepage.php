<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\category;
use App\Models\content;
use App\Models\page;
use App\Models\contact;
use App\Models\config;
use Illuminate\Support\Facades\Mail;
use stdClass;

class homepage extends Controller
{

    public function __construct()
    {
        if (config::find(1)->active == 0) {
            return abort(403, 'SAYFA GEÇİCİ BİR SÜRE KULLANIMA KAPANMIŞTIR. TEKRAR GÖRÜŞMEK ÜZERE, KENDİNİZE İYİ BAKIN...');
        }
        view()->share('pages', page::where('status', 1)->orderBy('order', 'ASC')->get());
        view()->share('categories', category::where('status', 1)->get());
    }
    public function getContentforList()
    {
        return content::join("categories", "content.category_id", "=", "categories.id")->select("content.*", "categories.name", "categories.slug as cat")->with('getCategory')->where('content.status', 1)->whereHas('getCategory', function ($query) {
            $query->where('status', 1);
        })->paginate(5);
    }
    public function index()
    {
        $this->data['content'] = $this->getContentforList();
        $this->data['content']->withPath(url('page'));
        return view('front\homepage', $this->data);
    }

    public function test()
    {
        return view('front\homepage', $this->data);
    }
    public function post($category, $slug)
    {
        $category = category::whereSlug($category)->first() ?? abort(404);
        $content = content::whereSlug($slug)->wherecategoryId($category->id)->first() ?? abort(404);
        $content->increment('hit');
        $this->data['content'] =  $content;
        return view('front\posts', $this->data);
    }
    public function category($slug)
    {
        $this->data['category'] = category::all()->where("slug", $slug)->first() ?? abort(404);
        $this->data['content'] = content::join("categories", "content.category_id", "=", "categories.id")->select("content.*", "categories.name", "categories.slug as cat")->where("categories.slug", $slug)->orderBy('created_at', 'DESC')->paginate(3);
         return view('front\category', $this->data);
    }

    public function page($slug)
    {
        $this->data['page'] = page::where("slug", $slug)->first() ?? abort(404);
        return view('front\page', $this->data);
    }
    public function contact()
    {
        return view('front\contact');
    }
    public function contact_post(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'topic' => 'required',
            'message' => 'required|min:10'
        ];

        $vali = Validator::make($request->post(), $rules);

        if ($vali->fails()) {
            return redirect()->route('contact')->withErrors($vali)->withInput();
        }

        //NEDEN ÇALIŞMIYOR ARAŞTIR

        Mail::send([], [], function ($message) use ($request) {
            $message->from('iletişim@blogsitesi.com', 'Blog Sitesi');
            $message->to('menesasln@gmail.com');
            $message->setBody('Mesajı Gönderen : ' . $request->name . '<br/>
            Mesajı Gönderen Mail : ' . $request->email . '<br/>
            Mesaj Konusu : ' . $request->topic . '<br/>
            Mesaj : ' . $request->message . '<br/>
            Mesaj Gönderilme Tarihi : ' . now() . '', 'text/html');
            $message->subject($request->name . ' iletişimden mesaj gönderdi.');
        });




        $contact = new contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->topic = $request->topic;
        $contact->message = $request->message;
        $contact->save();
        return redirect()->route('contact')->with('success', 'Mesajınız iletildi. Teşekkür ederiz.');
    }
}
