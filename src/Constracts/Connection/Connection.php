<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/11/19
 * Time: 20:55
 */

namespace PMysql\Constracts\Connection;

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

    /**
     * 发送 packet
     * @return mixed
     */
    abstract public function send($data);


    /**
     * read 发送过来的消息
     * @return mixed
     */
    abstract public function read();
}
