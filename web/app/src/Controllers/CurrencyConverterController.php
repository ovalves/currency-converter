<?php
/**
 * @copyright   2019 - Selene
 * @author      Vinicius Oliveira <vinicius_o.a@live.com>
 * @category    Micro Framework
 * @since       2019-10-12
 */

use Selene\Request\Request;
use Selene\Response\Response;
use Selene\Controllers\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Actions\CurrencyConvertertAction;

class CurrencyConverterController extends BaseController
{
    private $gateway;

    public function convert(Request $request, Response $response): JsonResponse
    {
        try {
            $data = (new CurrencyConvertertAction)->run($request);
            echo '<pre>';
            var_dump ($data);
            die();

            /**
             * @todo aplicar as taxas de pagamento na conversão
             * (new TaxPaymentService())
             *      ->using($payment)
             *      ->withValue($value)
             *      ->apply($value);
             */
            return $response->json(
                [
                    'from' => (int) $from,
                    'size' => (int) $size,
                    'data' => $users,
                ],
                $response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return $response->json(
                [
                    'from' => (int) $from,
                    'size' => (int) $size,
                    'data' => [],
                ],
                $response::HTTP_NOT_FOUND ?? 500
            );
        }
    }

    private function getGateway(): UsersGateway
    {
        if (null == $this->gateway) {
            $this->gateway = $this->container()->set(
                UsersGateway::class
            );
        }

        return $this->gateway;
    }
}
