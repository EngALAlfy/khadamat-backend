<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'content',
        'created_by',
    ];

    public function createdUser(){
        return $this->belongsTo(User::class , "created_by");
    }

}
