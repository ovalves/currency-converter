<?php
/**
 * @copyright   2019 - Selene
 * @author      Vinicius Oliveira <vinicius_o.a@live.com>
 * @category    Micro Framework
 * @since       2019-10-12
 */

use Selene\Model\ModelAbstract;

class PaymentModel extends ModelAbstract
{
    /**
     * Constante que indica o nome da tabela
     */
    const TABLENAME = 'books';

    const BOLETO_LABEL = 'Boleto';
    const CREDIT_CARD_LABEL = 'Cartão de Crédito';

    /**
     * Define os Tipos de Pagamentos
     */
    const TYPE_BOLETO = 1;
    const TYPE_CREDIT_CARD = 2;

    /**
     * Define as taxas dos tipos de pagamentos
     * Formas de pagamento (taxas aplicadas no valor da compra e aceitar apenas as opções abaixo)
     *
     * @todo colocar esses valores na base de dados MONGO DB
     */
    const TAX_BOLETO = 1.45;
    const TAX_CREDIT_CARD = 7.63;

    /**
     * Retorna os tipos de pagamentos e sua taxa de custo
     *
     * @return void
     */
    public function getMethods()
    {
        return [
            self::TYPE_BOLETO => [
                'label' => self::BOLETO_LABEL,
                'value' => self::TAX_BOLETO,
            ],
            self::TYPE_CREDIT_CARD => [
                'label' => self::CREDIT_CARD_LABEL,
                'value' => self::TAX_CREDIT_CARD,
            ]
        ];
    }

    /**
     * Retorna se o tipo de pagamento requerido é valido
     */
    public function isValidPayment(int $payment) : bool
    {
        return match ($payment) {
            self::TYPE_BOLETO => true,
            self::TYPE_CREDIT_CARD => true,
            default => false
        };
    }
}
