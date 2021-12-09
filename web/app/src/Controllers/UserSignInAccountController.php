<?php
/**
 * @copyright   2019 - Selene
 * @author      Vinicius Oliveira <vinicius_o.a@live.com>
 * @category    Micro Framework
 * @since       2019-10-12
 */

use Selene\Request\Request;
use App\Actions\UserSignInAction;
use Selene\Controllers\BaseController;

class UserSignInAccountController extends BaseController
{
    /**
     * @todo enviar mensagens flash para a view
     */
    public function signin(Request $request): mixed
    {
        try {
            $signedIn = (new UserSignInAction)->run($request);

            if ($signedIn) {
                redirect()
                    ->to(env('APP_URL'))
                    ->message('success', 'Logado com sucesso!')
                    ->go();
            }
        } catch (\Throwable $th) {
            error_log($th->getMessage());
        } finally {
            redirect()
                ->message('failed', 'Erro ao fazer login. Usuário ou senha incorreta!')
                ->back();
        }
    }

    public function logout(): mixed
    {
        (new UserSignInAction)->logout();

        redirect()
            ->to(env('APP_URL') . '/client/signin')
            ->message('success', 'Logado com sucesso!')
            ->go();
    }
}
