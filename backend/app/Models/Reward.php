<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Reward extends Model
{
    use HasFactory;
    protected $table = 'rewards';
    protected $primaryKey = 'reward_id';
    protected $fillable = [
        'reward_name',
        'reward_desc',
        'reward_stock',
        'reward_image',
        'point_required',
        'company_id',
    ];
     public function company()
    {
    return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }
}
