<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Factura extends Mailable
{
    use Queueable, SerializesModels;


    protected $pdf;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf)
    {
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.factura')
            ->attachData($this->pdf, 'factura.pdf', [
            'mime' => 'application/pdf',
        ]);
    }
}
