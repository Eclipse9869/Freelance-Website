<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $table = 'applicant_experience';
    protected $fillable = ['company_name', 'type', 'job_name', 'industry', 'desc', 'start', 'end', 'users_id'];
    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
