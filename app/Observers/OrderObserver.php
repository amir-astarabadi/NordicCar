<?php

namespace App\Observers;

use App\Notifications\CustomerOrderStatsuUpdatedNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        Notification::send($order->customer, new CustomerOrderStatsuUpdatedNotification($order));
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        if($order->isDirty('status')){
            Notification::send($order->customer, new CustomerOrderStatsuUpdatedNotification($order));
        }
    }
}
