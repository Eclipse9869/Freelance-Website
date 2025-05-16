<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $table = 'job';
    protected $fillable = ['name','desc', 'category_job_id'];
    // protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_job_id');
    }
    public function project()
    {
        return $this->belongsToMany(Project::class, 'job_has_project', 'job_id', 'project_id');
    }
}
