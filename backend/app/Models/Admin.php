<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admins';
    protected $primaryKey = 'admin_id';

    protected $fillable = [
        'admin_email',
        'admin_pw',
    ];

    protected $hidden = [
        'admin_pw',
        'remember_token',
    ];

    // Override the auth system to use custom password field
    public function getAuthPassword()
    {
        return $this->admin_pw;
    }

    // Override identifier used for login
    public function getAuthIdentifierName()
    {
        return 'admin_email';
    }
}
