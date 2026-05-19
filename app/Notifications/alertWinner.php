<?php

namespace App\Notifications;

use App\Models\Bond;
use App\Models\Draw;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AlertWinner extends Notification
{
    use Queueable;

    public $bond;
    public $bondNumber;
    public $prizePosition;

    /**
     * Create a new notification instance.
     */
    public function __construct(Bond $bond, $prizePosition)
    {
        $this->bond = $bond;
        $this->bondNumber = $bond->bondNumber;
        $this->prizePosition = $prizePosition;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        // Only send mail if the user has an email address
        $channels = ['database'];
        if ($notifiable->email) {
            $channels[] = 'mail';
        }
        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Bangladesh Bank Prize Bond Winner")
            ->greeting('Dear '. $notifiable->name. ',')
            ->line('Congratulations! Your Bond Number: '. $this->bondNumber .' won the Draw Winner Position '. $this->prizePosition .' in the Bangladesh Bank PrizeBond Draw')
            ->action('Please fill up the Claim Form carefully from this link and Submit to designated bank branches', url('https://www.bb.org.bd/services/forms/pbond_claimform.pdf'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'bond_number' => $this->bond->bondNumber,
            'message' => "Congratulations! Your bond {$this->bond->bondNumber} has won a prize in position {$this->prizePosition}!",

        ];
    }
}
