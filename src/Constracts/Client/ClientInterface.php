<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/12/4
 * Time: 11:05
 */
namespace PMysql\Constracts\Client;

use PMysql\Protocol\Packets\Packet;

/**
 * Interface ClientInterface
 * @package PMysql\Constracts\Client
 */
interface ClientInterface
{
    /**
     * @return bool
     */
    public function connect();

    /**
     * @return void
     */
    public function disconnect();

    /**
     * @return bool
     */
    public function isConnected();

    /**
     * @param Packet $packet
     * @return mixed
     */
    public function request(Packet $packet);

    /**
     * @return mixed
     */
    public function response();
}