<?php
namespace App\Policies;

use App\Models\Delivery;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeliveryPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Delivery $delivery)
    {
        return $user->id === $delivery->user_id;
    }

    public function update(User $user, Delivery $delivery)
    {
        return $user->id === $delivery->user_id;
    }

    public function delete(User $user, Delivery $delivery)
    {
        return $user->id === $delivery->user_id && $delivery->status === 'pending';
    }
}