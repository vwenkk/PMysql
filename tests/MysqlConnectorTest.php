<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/12/4
 * Time: 17:01
 */

namespace Tests;

use PHPUnit\Framework\TestCase;
use PMysql\MysqlConnector;
use PMysql\Parameters;

class MysqlConnectorTest extends TestCase
{
    public function testConnect()
    {
        $parameters = new Parameters([
            'host' => '192.168.1.90',
        ]);
        $mysqlConnector = new MysqlConnector($parameters);
        $mysqlConnector->connect();
    }
}
