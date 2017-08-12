<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SellerActiveNotiEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $fullName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fullName)
    {
        //
        $this->fullName = $fullName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email_template.seller_active_noti')
            ->subject('Allelua.com - Tài khoản của bạn đã được kích hoạt.');
    }
}
