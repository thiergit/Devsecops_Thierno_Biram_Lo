<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messages;
    public $subject;
    public $titre;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject,$titre,$messages)
    {
        $this->messages = $messages;
        $this->subject = $subject;
        $this->titre = $titre;
        $this->from(config('mail.from.address'), config('mail.from.name')); // Utilisation de la configuration par défaut

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('user.viewEmail')
                    ->subject($this->subject) // Set the subject of the email
                    ->with([
                        'titre' => $this->titre,
                        'messages' => $this->messages
                    ]);
    }
}
