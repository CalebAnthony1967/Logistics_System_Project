<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispatcher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'password', 'vehicle_type', 'vehicle_capacity', 'is_verified', 'rating'
    ];

    protected $hidden = [
        'password',
    ];

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }
}