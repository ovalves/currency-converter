<?php

namespace App\Mails;

use UserModel;
use Selene\Mails\Mail;

class UserRegisteredMail extends Mail
{
    protected UserModel $user;

    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    public function build(): self
    {
        return $this->view('Core@user::user-registered')
            ->to($this->user->email, $this->user->name)
            ->with([
                'name' => $this->user->name,
            ]);
    }
}
