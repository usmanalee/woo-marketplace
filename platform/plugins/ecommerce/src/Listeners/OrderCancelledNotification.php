<?php

namespace Woo\Ecommerce\Listeners;

use Woo\Base\Events\AdminNotificationEvent;
use Woo\Base\Supports\AdminNotificationItem;
use Woo\Ecommerce\Events\OrderCancelledEvent;

class OrderCancelledNotification
{
    public function handle(OrderCancelledEvent $event): void
    {
        event(new AdminNotificationEvent(
            AdminNotificationItem::make()
                ->title(trans('plugins/ecommerce::order.cancel_order_notifications.cancel_order'))
                ->description(trans('plugins/ecommerce::order.cancel_order_notifications.description', [
                    'customer' => $event->order->user->name,
                    'order' => $event->order->code,
                ]))
                ->action(trans('plugins/ecommerce::order.new_order_notifications.view'), route('orders.edit', $event->order->id))
        ));
    }
}
