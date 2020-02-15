<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifKenaikan extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($inidata)
    {
        $this->data=$inidata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('untuk.aplikasi.kiki@gmail.com')
            ->subject('CEK EWSBI')
            ->view('emails.notif_kenaikan')
            ->with('data',$this->data)
            ;
    }
}

