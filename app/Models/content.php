<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\category;
use Illuminate\Database\Eloquent\SoftDeletes;

class content extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'content';
    function getCategory()
    {
        return $this->hasOne('App\Models\category', 'id', 'category_id');
    }
}
