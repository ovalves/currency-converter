<?php

namespace App\Actions;

use App\Mails\UserRegisteredMail;
use App\Tasks\CreateUserByCredentialsTask;
use Selene\Request\Request;

class RegisterUserAction
{
    /**
     * @todo enviar o email de criação de conta
     *
     * @param Request $request
     * @return boolean
     */
    public function run(Request $request): bool
    {
        $data = $request->sanitize([
            'fullname',
            'email',
            'password',
            'repassword',
            'terms',
        ]);

        return (new CreateUserByCredentialsTask)->run($data);

        // Mail::send(new UserRegisteredMail($user));
    }
}
