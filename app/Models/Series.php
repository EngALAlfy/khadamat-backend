<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'image',
        'series_category_id',
        'created_by',
        'views',
    ];

    public function createdUser()
    {
        return $this->belongsTo(User::class, "created_by");
    }

    public function category()
    {
        return $this->belongsTo(SeriesCategory::class , 'series_category_id');
    }

    public function episodes()
    {
        return $this->hasMany(SeriesEpisode::class);
    }

}
