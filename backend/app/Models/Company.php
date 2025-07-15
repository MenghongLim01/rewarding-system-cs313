<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $primaryKey = 'company_id';
    protected $fillable = [
        'company_name',
        'company_type',
        'company_desc',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function rewards()
    {
        return $this->hasMany(Reward::class);
    }
}
