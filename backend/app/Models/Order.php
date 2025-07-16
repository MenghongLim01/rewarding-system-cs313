<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'user_id', 
        'company_id', 
        'total', 
        'points_awarded', 
        'order_items',
        'staff_id'
    ];
    protected $casts = [
        'order_items' => 'array', // Store order items as an array
        'total' => 'decimal:2',
        'points_awarded' => 'integer',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function company()
    {
    return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'staff_id'); // Assuming staff is a user in the system
    }
}
