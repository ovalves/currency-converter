<?php
/**
 * @copyright   2019 - Selene
 * @author      Vinicius Oliveira <vinicius_o.a@live.com>
 * @category    Micro Framework
 * @since       2019-10-12
 */

use Selene\Controllers\BaseController;
use Selene\Render\View;

class HistoryController extends BaseController
{
    public function index(): View
    {
        return $this->view()->render(
            'pages/history.html',
            [
                'pageTitle' => 'Histórico'
            ]
        );
    }
}
