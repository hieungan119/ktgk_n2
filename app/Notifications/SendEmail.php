<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEmail extends Notification
{
    use Queueable;

    private $data;
    private $quantity;

    public function __construct($data, $quantity) // Nhận thêm quantity
    {
        $this->data = $data;
        $this->quantity = $quantity;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Xác nhận đặt hàng thành công - Shop Cây Cảnh')
            ->view('email_template.don_hang_thanh_cong', [
                'data' => $this->data,
                'quantity' => $this->quantity
            ]);
    }
}
?>