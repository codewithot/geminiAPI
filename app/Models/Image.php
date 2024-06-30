<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'user_id',
        'blog_id',
        'name',
        'type',
    ];

    public function blog()
    {
        return $this->hasOne(Blog::class);
    }


}
