<?php
/**
 * @copyright   2019 - Selene
 * @author      Vinicius Oliveira <vinicius_o.a@live.com>
 * @category    Micro Framework
 * @since       2019-10-12
 */

use Selene\Request\Request;
use App\Actions\RegisterUserAction;
use Selene\Controllers\BaseController;

class UserRegisterAccountController extends BaseController
{
    /**
     * @todo enviar mensagens flash para a view
     */
    public function register(Request $request): mixed
    {
        try {
            $created = (new RegisterUserAction)->run($request);

            if ($created) {
                header('Location:' . env('APP_URL'));
                die;
            }
        } catch (\Throwable $th) {
            header('Location:' . env('APP_URL') . '/client/signup');
            die('as');
        }
    }
}
