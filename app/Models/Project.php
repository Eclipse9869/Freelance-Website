<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'project';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'desc', 'req_edu', 'amount_min', 'amount_max', 'deadline', 'users_id'];
    public function job()
    {
        return $this->belongsToMany(Job::class, 'job_has_project', 'project_id', 'job_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
