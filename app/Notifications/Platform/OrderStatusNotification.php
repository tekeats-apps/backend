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
        return ['mail', 'database', OneSignalChannel::class];
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
        $orderID = $this->order->order_id;
        $status = $this->order->status_text;

        return OneSignalMessage::create()
            ->setSubject($this->getTitle())
            ->setBody($this->getMessage(['order_id' => $orderID, 'status' => $status]))
            ->setUrl(url('/orders/' . $orderID));
    }


    protected function getTitle(): string
    {
        return "🚀 Order Status Updated 🚀";
    }

    protected function getMessage(array $data): string
    {
        return "The status of your order #" . $data['order_id'] . " has been updated to " . $data['status'] . ". Tap here for more details.";
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->order_id,
            'title' => $this->getTitle(),
            'message' => $this->getMessage(['order_id' => $this->order->order_id, 'status' => $this->order->status_text]),
            'url' => url('/orders/' . $this->order->order_id),
        ];
    }
}
