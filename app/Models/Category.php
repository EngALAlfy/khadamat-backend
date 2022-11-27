<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'created_by',
    ];

    public function createdUser(){
        return $this->belongsTo(User::class , "created_by");
    }

    public function subcategories(){
        return $this->hasMany(SubCategory::class);
    }

    public function subsubcategories(){
        return $this->hasMany(SubSubCategory::class);
    }

    public function items(){
        return $this->hasMany(Item::class);
    }
}
