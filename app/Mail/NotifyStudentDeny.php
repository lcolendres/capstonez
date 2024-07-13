<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifyStudentDeny extends Mailable
{
    use Queueable, SerializesModels;

    public $student, $code, $remarks;

    /**
     * Create a new message instance.
     */
    public function __construct($student, $code, $remarks)
    {
        //
        $this->student  = $student;
        $this->code     = $code;
        $this->remarks  = $remarks;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.NotifyStudentDeny')
                    ->subject('Subject Accreditation')
                    ->with([
                        'student'   => $this->student,
                        'code'      => $this->code,
                        'remarks'   => $this->remarks
                    ]);
    }
}
