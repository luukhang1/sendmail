<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
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
        $address = 'phamsyngoc200@gmail.com';
        $subject = $this->data['title'];
        $name = 'Anh Be Yeu Em';
        return $this->markdown('send-mail', ['message' => $this->data['message']])
            ->from($address, $name)
            ->subject($subject)
            ->with(['message' => $this->data['message']]);
    }
}
