<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $table = 'applicant_study';
    protected $fillable = ['school_name', 'major', 'start', 'end', 'desc', 'education_level_id', 'users_id'];
    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function edulevel()
    {
        return $this->belongsTo(EduLevel::class, 'education_level_id');
    }
}
