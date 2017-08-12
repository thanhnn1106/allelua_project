<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $fullName;
    public $roleId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fullName, $roleId)
    {
        //
        $this->fullName = $fullName;
        $this->roleId = $roleId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->roleId == config('allelua.roles.seller')) {
            return $this->view('email_template.welcome_email_seller')
                        ->subject('Allelua.com seller register success');
        }
        return $this->view('email_template.welcome_email_customer')
                        ->subject('Allelua.com customer register success');
    }
}
