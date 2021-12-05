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
    public function convert(Request $request, Response $response): JsonResponse
    {
        try {
            $data = (new CurrencyConvertertAction)->run($request);
            return $response->success($data);
        } catch (\Throwable $th) {
            return $response->error($th);
        }
    }
}
