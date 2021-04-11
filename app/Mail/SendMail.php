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
    public $Template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$Template)
    {
        $this->data=$data;
        $this->Template=$Template;
        //dynamicTemplate
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('cpafreemaketing@gmail.com')->subject('Important Subject')->view($this->Template)->with('data',$this->data);
    }
}
