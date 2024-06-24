<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_name',
        'topic',
        'body',
        'category',
        'image',
        'is_active'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->hasMany(Image::class);
    }

}
