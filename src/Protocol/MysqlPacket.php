<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/15
 * Time: 23:36
 */

namespace Src\Protocol;

/**
 * Class MysqlPacket
 * @package Src\Protocol
 */
abstract class MysqlPacket
{
    /**
     * @return int
     */
    abstract public function calcPacketSize(): int;

    /**
     * @return string
     */
    abstract public function getPacketInfo(): string;

    /**
     * @param $data
     */
    abstract public function read($data): void;

    /**
     * @param $data
     */
    abstract public function write($data): void;
}
