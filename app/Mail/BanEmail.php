<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BanEmail extends Mailable
{
    public $masalah;
    public $pelapor;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($masalah, $pelapor)
    {
        $this->masalah = $masalah;
        $this->pelapor = $pelapor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('kotabatudlh@gmail.com')
                    ->subject('Informasi Pengaduan Dinas Lingkungan Hidup Kota Batu')
                    ->view('ban');
    }
}
