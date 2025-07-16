<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redemption extends Model
{
    protected $primaryKey = 'red_id'; // since you're using custom PK

    protected $fillable = [
        'user_id',
        'staff_id',
        'reward_id',
        'point_spent',
        'status',
        'created_at',
    ];

    public $timestamps = false; // because you only use created_at, no updated_at
   public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reward()
    {
        return $this->belongsTo(Reward::class, 'reward_id');
    }
    public function staff()
    {
        return $this->belongsTo(\App\Models\Staff::class, 'staff_id', 'staff_id');
    }
    
}
