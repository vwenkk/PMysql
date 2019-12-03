<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/12/3
 * Time: 17:58
 */

namespace PMysql\Constracts\Transaction;

use PMysql\Constracts\Connect\Connection;

abstract class Transaction
{
    /**
     * @var Connection
     */
    protected $mysqlConn;

    abstract public function commit();

    abstract public function rollBack();
}
