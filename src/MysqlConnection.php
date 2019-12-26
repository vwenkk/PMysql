<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/12/4
 * Time: 13:34
 */

namespace PMysql;

use PMysql\Constracts\Client\ClientInterface;
use PMysql\Constracts\Connection\Connection;
use PMysql\Constracts\Transaction\Transaction;

class MysqlConnection extends Connection
{
    /**
     * @var ClientInterface|StreamClient
     */
    protected $client;

    /**
     * MysqlConnection constructor.
     * @param $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function exec(string $sql)
    {
        // TODO: Implement exec() method.
    }

    public function beginTx(): Transaction
    {
        // TODO: Implement beginTx() method.
    }

    public function close()
    {
        // TODO: Implement close() method.
    }

    public function ping()
    {
    }

    public function send($data)
    {
    }

    public function read()
    {
        // TODO: Implement read() method.
    }
}
