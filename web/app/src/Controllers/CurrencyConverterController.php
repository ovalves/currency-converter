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
            die('controller');

            return $response->json(
                [
                    'from' => (int) 0,
                    'size' => (int) 0,
                    'data' => [],
                ],
                $response::HTTP_OK
            );
        } catch (\Throwable $th) {
            echo '<pre>';
            var_dump ($th->getMessage());
            die();
            return $response->json(
                [
                    'from' => (int) 0,
                    'size' => (int) 0,
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
