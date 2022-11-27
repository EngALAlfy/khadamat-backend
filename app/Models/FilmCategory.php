<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmCategory extends Model
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

    public function films(){
        return $this->hasMany(Film::class);
    }

}
