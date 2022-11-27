<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'image',
        'film_category_id',
        'url',
        'file',
        'created_by',
        'views',
    ];

    public function createdUser()
    {
        return $this->belongsTo(User::class, "created_by");
    }

    public function category()
    {
        return $this->belongsTo(FilmCategory::class , 'film_category_id');
    }

}
