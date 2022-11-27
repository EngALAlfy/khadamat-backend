<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'image',
        'category_id',
        'subcategory_id',
        'subsubcategory_id',
        'sponsored',
        'archived',
        'sponsored_index',
        'created_by',
        'views',
    ];

    public function addView(){
        $this->views +=1;
        $this->save();
        return $this->views;
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subcategory(){
            return $this->belongsTo(SubCategory::class , "subcategory_id");
    }

    public function subsubcategory(){
            return $this->belongsTo(SubSubCategory::class , "subsubcategory_id");
    }

    public function createdUser(){
        return $this->belongsTo(User::class , "created_by");
    }

}
