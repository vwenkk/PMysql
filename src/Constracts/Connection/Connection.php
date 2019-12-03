<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/11/19
 * Time: 20:55
 */

namespace PMysql\Constracts\Connect;

use PMysql\Constracts\Transaction\Transaction;

/**
 * Class Connection
 * @package PMysql\Constracts\Connect
 */
abstract class Connection
{
    /**
     * @param string $sql
     * @return mixed
     */
    abstract public function exec(string $sql);

    /**
     * @param string $sql
     * @return mixed
     */
    abstract public function query(string $sql);

    /**
     * 开启事务
     * @return mixed
     */
    abstract public function beginTx(): Transaction;

    /**
     * 关闭连接
     * @return mixed
     */
    abstract public function close();

    /**
     * @return mixed
     */
    abstract public function ping();
}
