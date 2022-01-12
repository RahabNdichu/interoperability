<?php

namespace App\Notifications;

use App\KpaApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubmittedAnalysisNotification extends Notification
{
    use Queueable;

    /**
     * @var KpaApplication
     */
    private $kpaApplication;

    public function __construct(KpaApplication $kpaApplication)
    {
        $this->kpaApplication = $kpaApplication;
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
                    ->line('The analysis of application has been submitted')
                    ->line('Decision: ' . $this->kpaApplication->status->name)
                    ->line('Comment: ' . $this->kpaApplication->comments()->latest()->first()->comment_text)
                    ->action('See Application', route('admin.kpa-applications.show', $this->kpaApplication))
                    ->line('Thank you for using our application!');
    }
}
