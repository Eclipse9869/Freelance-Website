<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;
    protected $table = 'bid';
    protected $fillable = ['status', 'cv', 'job_app_letter', 'amount', 'users_id'];
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function bidDetails()
    {
        return $this->hasMany(BidDetail::class, 'bid_id');
    }
}
