<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'department',
        'employment_type',
        'location',
        'is_active',
        'salary',
        'deadline',
        'experience'
    ];
    

    public function applicant()
    {
        return $this->hasMany(Applicant::class);
    }
}
