<?php

namespace App\Listeners;

use App\Events\OrderPaymentUpdateEvent;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderPaymentUpdateListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPaymentUpdateEvent $event): void
    {
        $orderId = $event->orderId;
        $order = Order::find($orderId);
        $order->payment_method = $event->payment_method;
        $order->payment_status = $event->payment_info['status'];
        $order->payment_approve_date = now();
        $order->transaction_id = $event->payment_info['transaction_id'];
        $order->currency_name = $event->payment_info['currency'];
        $order->save();
    }
}
