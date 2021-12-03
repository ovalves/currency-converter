<?php
/**
 * @copyright   2019 - Selene
 * @author      Vinicius Oliveira <vinicius_o.a@live.com>
 * @category    Micro Framework
 * @since       2019-10-12
 */

use Selene\Request\Request;
use Selene\Response\Response;
use App\Traits\ConvertRequestTrait;
use Selene\Controllers\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Exceptions\CurrencyConverterGeneralException;

class CurrencyConverterController extends BaseController
{
    use ConvertRequestTrait;

    private $gateway;

    public function convert(Request $request, Response $response): JsonResponse
    {
        try {
            $params = $request->getQueryParams();

            if (empty($params)) {
                throw new CurrencyConverterGeneralException();
            }

            $value = (float) $params['value'] ?? 0;
            $payment = (int) $params['payment'] ?? null;
            $code = $params['code'] ?? '';

            $this->throwErrorForRequestedValue($value);
            $this->throwErrorForRequestedCode($code);
            $this->throwErrorForRequestedPayment($payment);

            /**
             * Os services irão implementar a mesma interface
             * ServiceInterface
             */

            /**
             * @todo chamar a api de conversão
             * (new CurrencyConvertService())
             *      ->to($code)
             *      ->withValue($value)
             *      ->apply();
             */

            /**
             * @todo aplicar as taxas de pagamento na conversão
             * (new TaxPaymentService())
             *      ->to($payment)
             *      ->withValue($value)
             *      ->apply($value);
             */
            echo '<pre>';
            var_dump($code);
            var_dump($value);
            var_dump($payment);
            die();

            return $response->json(
                [
                    'from' => (int) $from,
                    'size' => (int) $size,
                    'data' => $users,
                ],
                $response::HTTP_OK
            );
        } catch (\Throwable $th) {
            echo '<pre>';
            var_dump($th->getMessage());
            die();
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
