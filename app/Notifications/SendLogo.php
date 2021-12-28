<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Helpers\Translate;

class SendLogo extends Notification
{
    use Queueable;

    /**
     * @var
     */
    private $image;

    /**
     * @var mixed|null
     */
    private $message_data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($image_path, $message_data = null)
    {
        $this->image = $image_path;
        $this->message_data = $message_data;
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
        $message_data = $this->message_data;

        return (new MailMessage)
                    ->line('Hello')
                    ->line('Thank you order at ' . config('app.url') . '. Your transaction has been confirmed. You may want to print this page for your records.')
                    ->line('This mail will serve as an official receipt for this payment')
                    ->line('Transaction Summary:')
                    ->line('You Have Purchased Package:')
                    ->line('Transaction Date: ' . $message_data['transcation_date'])
                    ->line('Name: ' .  Translate::t($message_data['package_name']))
                    ->line('Price: ' . $message_data['symbol'] . $message_data['price'])
                    ->line('Includes: ' . str_replace(';', '; ', Translate::t($message_data['includes'])))
                    ->line('Total: ' . $message_data['symbol'] . $message_data['amount'])
                    ->line('You can download design from you design(s) section in your profile or use this link:')
                    //->attach($this->image)
                    ->action('Download', url($this->image))
                    ->line('Thank you for using our application!');
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
