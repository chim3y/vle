<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\AssignmentSubmission;

class AssignmentSubmitted extends Notification
{
    use Queueable;
    protected $assignmentsubmission;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(AssignmentSubmission $assignmentsubmission)
    {
       $this->assignmentsubmission= $assignmentsubmission; 
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
                    ->line('New Assignment is Submitted.')
                    ->action('Assignment Submitted', url($this->assignmentsubmission->id))
                    ->line('Grade the Assignment');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
