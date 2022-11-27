<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoinPack extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'price',
        'count',
        'created_by',
    ];

    public function createdUser(){
        return $this->belongsTo(User::class , 'created_by');
    }

}

