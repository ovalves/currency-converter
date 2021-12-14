<?php

use Selene\Request\Request;
use App\Actions\RegisterUserAction;
use Selene\Controllers\BaseController;

class UserRegisterAccountController extends BaseController
{
    public function register(Request $request): mixed
    {
        try {
            $created = (new RegisterUserAction)->run($request);

            if ($created) {
                redirect()
                    ->to(env('APP_URL'))
                    ->message('success', 'Conta criada com sucesso!')
                    ->go();
            }
        } catch (\Throwable $th) {
            redirect()
                ->message('failed', 'Erro ao registar sua conta.')
                ->back();
        }
    }
}
