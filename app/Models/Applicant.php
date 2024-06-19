<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'job_title',
        'salary',
        'resume',
        'cover_letter'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }


}
