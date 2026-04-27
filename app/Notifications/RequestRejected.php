<?php 
namespace App\Notifications; 

use Illuminate\Bus\Queueable; 
use Illuminate\Contracts\Queue\ShouldQueue; 
use Illuminate\Notifications\Messages\MailMessage; 
use Illuminate\Notifications\Notification; 

class RequestRejected extends Notification implements ShouldQueue
{ 
    use Queueable; 

    /**
     * Create a new notification instance.
     */
    public function __construct(public $itemTitle) 
    {
        // Constructor body (empty)
    } 

    public function via($notifiable) 
    { 
        return ['mail']; 
    } 

    public function toMail($notifiable) 
    { 
        return (new MailMessage) 
            ->subject('Update on your Request') 
            ->line("Unfortunately, your request for '{$this->itemTitle}' was not approved.") 
            ->line("If you think this was a mistake, please contact support.") 
            ->action('Go to Dashboard', url('/dashboard'));
    } 

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array 
    { 
        return [
            // Add data for database notifications if needed
        ]; 
    } 
}