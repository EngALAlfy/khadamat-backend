<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'created_by',
    ];

    public function createdUser()
    {
        return $this->belongsTo(User::class, "created_by");
    }

    public function series()
    {
        return $this->hasMany(Series::class);
    }

}
