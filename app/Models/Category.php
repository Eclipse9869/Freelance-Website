<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category_job';
    protected $fillable = ['name', 'image'];
    public function jobs()
    {
        return $this->hasMany(Job::class, 'category_job_id');
    }

}
