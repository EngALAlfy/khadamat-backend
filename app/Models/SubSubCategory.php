<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'image',
        'category_id',
        'subcategory_id',
        'created_by',
    ];

    public function createdUser(){
        return $this->belongsTo(User::class , "created_by");
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }

    public function items(){
        return $this->hasMany(Item::class , "subsubcategory_id");
    }
}
