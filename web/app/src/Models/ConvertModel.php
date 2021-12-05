<?php
/**
 * @copyright   2019 - Selene
 * @author      Vinicius Oliveira <vinicius_o.a@live.com>
 * @category    Micro Framework
 * @since       2019-10-12
 */

use Selene\Model\ModelAbstract;
use Selene\Drivers\MongoDB\MongoDriver;

class ConvertModel extends ModelAbstract
{
    /**
     * Constante que indica o nome da tabela
     */
    const TABLENAME = 'books';

    /**
     * (deve ser maior que R$ 1.000,00 e menor que R$ 100.000,00)
     */
    const MIN_VALUE_CONSTRAINT = 1000;
    const MAX_VALUE_CONSTRAINT = 100000;


    /**
     * Retorna os tipos de pagamentos e sua taxa de custo
     */
    public function isValidCode(string $code) : bool
    {
        return (new MongoDriver)
                ->filters(['type' => $code])
                ->options([
                    'projection' => [
                        '_id' => 0
                    ],
                ])
                ->query('currency_codes')
                ->isValid();
    }

    /**
     * Retorna as taxas de cobraça para a conversão do valor
     */
    public function getConvertTaxes(): array
    {
        return (new MongoDriver)->query('tax')->toArray();
    }

    /**
     * Retorna os tipos de pagamentos e sua taxa de custo
     */
    public function getValueConstraints() : array
    {
        return [
            'min' => self::MIN_VALUE_CONSTRAINT,
            'max' => self::MIN_VALUE_CONSTRAINT,
        ];
    }
}
