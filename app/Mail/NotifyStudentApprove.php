<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifyStudentApprove extends Mailable
{
    use Queueable, SerializesModels;

    public $student, $code;

    /**
     * Create a new message instance.
     */
    public function __construct($student, $code)
    {
        //
        $this->student  = $student;
        $this->code     = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.NotifyStudentApprove')
                    ->subject('Subject Accreditation')
                    ->with([
                        'student'   => $this->student,
                        'code'      => $this->code
                    ]);
    }
}
