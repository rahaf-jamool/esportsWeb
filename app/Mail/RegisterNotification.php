<?php

namespace App\Mail;


use Illuminate\Mail\Mailable;


class RegisterNotification extends Mailable
{

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config("mail.webmaster")["address"],config('app.name') )
            ->subject(config("app.name"). ' - ' .trans('auth.Membership-registration'). date('d M,Y'))
            ->view('emails.register-notification')->with(['user' => $this->data]);
    }
}
