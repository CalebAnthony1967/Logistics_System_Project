```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_name',
        'description',
        'weight',
        'value',
        'source',
        'destination',
        'sender_name',
        'sender_email',
        'sender_phone',
        'sender_address',
        'receiver_name',
        'receiver_email',
        'receiver_phone',
        'receiver_address',
        'urgent',
        'special_instructions',
        'preferred_delivery_time',
        'cost',
        'status',
        'payment_status',
        'dispatcher_id',
        'rating',
        'rating_comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dispatcher()
    {
        return $this->belongsTo(User::class, 'dispatcher_id');
    }
}
```