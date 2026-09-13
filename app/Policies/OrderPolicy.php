<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;

class OrderPolicy
{
    public function view(User $user, Order $order)
    {
        return $user->id === $order->user_id || $user->isAdmin();
    }

    public function update(User $user, Order $order)
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Order $order)
    {
        return $user->isAdmin();
    }
}
