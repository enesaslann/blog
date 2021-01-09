<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use stdClass;
use App\Models\category;
use App\Models\page;
use App\Models\content;

class Dashboard extends Controller
{
    public function index()
    {
        $this->data['content'] = content::all()->count();
        $this->data['hit'] = content::sum('hit');
        $this->data['category'] = category::all()->count();
        $this->data['page'] = page::all()->count();

        return view('back/dashboard', $this->data);
    }
}
