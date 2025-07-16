<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Staff extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'staff';
    protected $primaryKey = 'staff_id';
    protected $fillable = [
        'staff_name',
        'staff_email',
        'staff_pw',
        'company_id',
        'profile_image', 
    ];
    protected $hidden = [
        'staff_pw', // Hide password when retrieving data
    ];
    public function company()
    {
    return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }
     public function getAuthPassword()
    {
        return $this->staff_pw;  // Use the 'staff_pw' field for authentication
    }
}
