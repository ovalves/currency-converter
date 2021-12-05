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

    // Rota de Conversão de tipo
    $app->route()->post('/currency/convert', 'CurrencyConverterController@convert');

    // Rota de Listagem dos tipos de pagamentos
    $app->route()->get('/payment/types', 'PaymentController@getPaymentMethods');

    $app->route()->get('/', 'HomeController@index');
})->run();
