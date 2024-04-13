<?php

namespace App\Notifications\Platform;

use App\Models\Vendor\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;

class OrderStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Order $order)
    {
        //
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Your order status has been updated to: ' . $this->order->status_text)
            ->action('View Order', url('/orders/' . $this->order->id))
            ->line('Thank you for using our service!');
    }

    public function toOneSignal(object $notifiable)
    {
        $orderID = $this->order->order_id; // Assuming you have order_id accessible in your Order model
        $status = $this->order->status_text;

        return OneSignalMessage::create()
            ->setSubject("🚀 Order Status Updated 🚀")
            ->setBody("The status of your order #$orderID has been updated to $status.")
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
