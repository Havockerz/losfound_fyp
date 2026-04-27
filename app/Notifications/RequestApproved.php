<?php 
namespace App\Notifications; 

use Illuminate\Bus\Queueable; 
use Illuminate\Contracts\Queue\ShouldQueue; 
use Illuminate\Notifications\Messages\MailMessage; 
use Illuminate\Notifications\Notification; 

class RequestApproved extends Notification implements ShouldQueue
{
    use Queueable; 

    public function __construct(public $otherPerson, public $itemTitle)  
    {
        // Constructor body (can be empty)
    }

    public function via($notifiable) 
    { 
        return ['mail']; 
    } 

    public function toMail($notifiable) 
    { 
        return (new MailMessage) 
            ->subject('Good News! Your Request was Approved') 
            ->line("Your request for '{$this->itemTitle}' has been verified.") 
            ->line("You can now contact: " . $this->otherPerson->name) 
            ->line("Email: " . $this->otherPerson->email) 
            ->line("Phone: " . ($this->otherPerson->phone ?? 'Not provided')) 
            ->action('View Details', url('/dashboard')) 
            ->line('Thank you for using Losfound!'); 
    } 

    public function toArray($notifiable) 
    { 
        return [ 
            // You can return an array for database notifications if needed
        ]; 
    } 
}