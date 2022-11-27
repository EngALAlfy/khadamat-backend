<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesEpisode extends Model
{
    use HasFactory;

    protected $fillable = [
        'order',
        'name',
        'desc',
        'image',
        'series_id',
        'url',
        'file',
        'created_by',
        'views',
    ];

    public function createdUser()
    {
        return $this->belongsTo(User::class, "created_by");
    }

    public function series()
    {
        return $this->belongsTo(Series::class);
    }
}
