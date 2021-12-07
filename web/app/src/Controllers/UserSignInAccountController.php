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
                header('Location:' . env('APP_URL'));
                die;
            }
        } catch (\Throwable $th) {
            header('Location:' . env('APP_URL') . '/client/signup');
            die('as');
        }
    }

    public function logout(): mixed
    {
        (new UserSignInAction)->logout();
        header('Location:' . env('APP_URL') . '/client/signin');
        die;
    }
}
