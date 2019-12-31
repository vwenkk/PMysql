<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/12/3
 * Time: 18:13
 */
namespace PMysql\Protocol\Packets;

/**
 * Class Packets
 * @package PMysql\Protocol\Packets
 */
abstract class Packet
{
    /**
     * @var int
     */
    protected $packetLength;

    /**
     * @var int
     */
    protected $packetId;

    /**
     * @param $data
     * @return mixed
     */
    abstract public function readPacket($data);

    /**
     * @return mixed
     */
    abstract public function writePacket();

    /**
     * @return int
     */
    abstract public function calcPacketSize(): int;

    /**
     * @return string
     */
    abstract public function getPacketInfo(): string;
}