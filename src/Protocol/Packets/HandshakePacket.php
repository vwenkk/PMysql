<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/12/3
 * Time: 18:33
 */

namespace PMysql\Protocol\Packets;

class HandshakePacket extends Packet
{
    public function readPacket($data)
    {
        // TODO: Implement readPacket() method.
    }

    public function writePacket()
    {
        // TODO: Implement writePacket() method.
    }

    public function calcPacketSize(): int
    {
        // TODO: Implement calcPacketSize() method.
    }

    public function getPacketInfo(): string
    {
        return 'MySQL Handshake Packet';
    }
}
