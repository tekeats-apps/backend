<?php

namespace App\Notifications\Tenant;

use App\Models\Vendor\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;

class OrderPlacedNotification extends Notification implements ShouldQueue
{
    use Queueable;
    /**
     * Create a new notification instance.
     */
    public function __construct(public Order $order)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', OneSignalChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hello!')
            ->line('Your order has been placed. #' . $this->order->order_id)
            ->action('View Order', url('/orders/' . $this->order->order_id))
            ->line('Thank you for your purchase!');
    }

    public function toOneSignal(object $notifiable)
    {
        $orderID = $this->order->order_id; // Assuming you have order_id accessible in your Order model

        return OneSignalMessage::create()
            ->setSubject("🎉 New Order Placed! 🎉")
            ->setBody("Exciting News! Your order #$orderID has been successfully placed. Tap here for details!")
            ->setUrl(url('/orders/' . $orderID));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
