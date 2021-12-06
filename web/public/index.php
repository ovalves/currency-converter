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
})->run();
