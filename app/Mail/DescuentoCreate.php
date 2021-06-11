<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DescuentoCreate extends Mailable
{
    use Queueable, SerializesModels;

    protected $pdf;
    public $code;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf, $code,User $user)
    {
        $this->pdf = $pdf;
        $this->code = $code;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.ventas.permisos.descuentoCreate')
            ->attachData($this->pdf, 'soporte.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
