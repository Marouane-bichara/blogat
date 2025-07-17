<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function build()
    {
        return $this
            ->subject('📣 Nouvelle annonce de Blogat')
            ->markdown('emails.newsletter');
    }
}
