<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/12/4
 * Time: 13:32
 */

namespace PMysql;

use PMysql\Constracts\Connector\Connector;
use PMysql\Constracts\Parameters\ParametersInterface;
use PMysql\Protocol\Packets\HandshakePacket;

class MysqlConnector extends Connector
{
    /**
     * @var ParametersInterface
     */
    protected $parameters;

    /**
     * MysqlConnector constructor.
     * @param ParametersInterface $parameters
     */
    public function __construct(ParametersInterface $parameters)
    {
        $this->parameters = $parameters;
    }

    public function connect()
    {
        $parameters = $this->parameters;
        $streamClient = new StreamClient($parameters);
//        $streamClient->request($handshakePacket);
        $data = $streamClient->response();
        $handshakePacket = new HandshakePacket();
        $handshakePacket->readPacket($data);
        $mysqlConnection = new MysqlConnection($streamClient);
    }
}
