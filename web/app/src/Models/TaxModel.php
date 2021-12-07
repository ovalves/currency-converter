<?php
/**
 * @copyright   2019 - Selene
 * @author      Vinicius Oliveira <vinicius_o.a@live.com>
 * @category    Micro Framework
 * @since       2019-10-12
 */

use Selene\Model\ModelAbstract;
use Selene\Drivers\MongoDB\MongoDriver;

class TaxModel extends ModelAbstract
{
    /**
     * Constante que indica o nome da tabela
     */
    const TABLENAME = 'tax';

    /**
     * Retorna as taxas de cobraça para a conversão do valor
     */
    public function getConvertTaxes(): array
    {
        return (new MongoDriver)->query(self::TABLENAME)->toArray();
    }
}
