<?php
/**
 * @copyright   2019 - Selene
 * @author      Vinicius Oliveira <vinicius_o.a@live.com>
 * @category    Micro Framework
 * @since       2019-01-17
 */
require __DIR__.'/../app/vendor/autoload.php';

$app = Selene\App\Factory::create('/var/www/html/app/');

$app->route()->middleware([
//    new Selene\Middleware\Handler\Auth
])->group(function () use ($app) {

    // Conversão de moedas
    $app->route()->post('/currency/convert', 'CurrencyConverterController@convert');

    // Listagem dos pedidos de conversão dos clientes
    $app->route()->get('/orders', 'OrdersController@orders');

    // Listagem dos tipos de pagamentos
    $app->route()->get('/payment/types', 'PaymentController@getPaymentMethods');


    // Client App Routes
    $app->route()->get('/', 'HomeController@index');
    $app->route()->get('/client/signin', 'SignController@signin');
    $app->route()->get('/client/signup', 'SignController@signup');
    $app->route()->get('/client/forgot/password', 'SignController@forgotPassword');
    $app->route()->get('/client/currency/convert', 'CurrencyController@index');


    // Login do usuário
    $app->route()->post('/client/account/signin', 'UserSignInAccountController@signin');

    // Criar conta de usuário
    $app->route()->post('/client/account/register', 'UserRegisterAccountController@register');
})->run();
