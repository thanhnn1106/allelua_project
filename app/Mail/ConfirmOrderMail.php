<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmOrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $emailContentData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailContentData)
    {
        //
        $this->emailContentData = $emailContentData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email_template.user_confirm_order')
            ->subject('Allelua.com - Xác nhận đơn hàng.');
    }
}
