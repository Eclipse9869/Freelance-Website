<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidDetail extends Model
{
    use HasFactory;
    protected $table = 'bid_details';
    protected $fillable = [
        'bid_id',
        'project_id',
    ];

    public function bid()
    {
        return $this->belongsTo(Bid::class, 'bid_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
