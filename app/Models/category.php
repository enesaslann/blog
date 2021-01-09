<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    public function contentCount()
    {
        return $this->hasMany('App\Models\content','category_id','id')->count();
    }
}
