<?php

namespace App\Notifications;

use App\KpaApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SentForAnalysisNotification extends Notification
{
    use Queueable;

    /**
     * @var KpaApplication
     */
    private $kpaApplication;

    public function __construct(KpaApplication $loanApplication)
    {
        $this->loanApplication = $loanApplication;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('A request for loan application analysis has been sent to you.')
                    ->action('See Application', route('admin.loan-applications.show', $this->loanApplication))
                    ->line('Thank you for using our application!');
    }
}
