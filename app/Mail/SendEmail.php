<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    public $kode;
    public $pelapor;
    public $masalah;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($kode, $pelapor, $masalah)
    {
        $this->kode = $kode;
        $this->pelapor = $pelapor;
        $this->masalah = $masalah;
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
                    ->view('email');
    }
}
