<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminHireMessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    private $data;
    
    /**
     * AdminHireMessageNotification constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mails.admin-hire-designer-notification')->with(['message_data' => $this->data]);
    }
}
