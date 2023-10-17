<?php

namespace App\Policies;

use App\Models\CartProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, OrderProduct $orderProduct): bool
    {
        return ($user->id ===  $orderProduct->order->user_id);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, OrderProduct $orderProduct): bool
    {
        return ($user->id ===  $orderProduct->order->user_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Order $order): bool
    {
        return ($user->id ===  $order->user_id);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, OrderProduct $orderProduct): bool
    {
        return ($user->id ===  $orderProduct->order->user_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, OrderProduct $orderProduct): bool
    {
        return ($user->id ===  $orderProduct->order->user_id);
    }


    public function after(User $user): ?bool
    {
        return $user->role->name === 'admin';
    }
}
