<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/12/3
 * Time: 18:33
 */

namespace PMysql\Protocol\Packets;

use PMysql\Protocol\MySQLMessage;

/**
 *
 * <pre><b>AuthPacket means mysql initial handshake packet.</b></pre>
 * @author
 * <pre><b>email: </b>1150134832@qq.com</pre>
 * @version 1.0
 * @see http://dev.mysql.com/doc/internals/en/connection-phase-packets.html#packet-Protocol::Handshake
 */
class HandshakePacket extends Packet
{
    /**
     * 协议版本
     * @var int
     */
    protected $protocolVersion;

    /**
     * 服务器版本
     * @var int
     */
    protected $serverVersion;

    /**
     * 线程id
     * @var int
     */
    protected $threadId;

    /**
     * salt 第一部分随机数
     * @var string
     */
    protected $seed; // 第一部分随机数

    /**
     * 数据库提供的功能
     *
     * @var int
     */
    protected $serverCapabilities;
    protected $serverCharset;
    protected $serverStatus;
    protected $restOfScrambleBuff; // 第二部分随机数

    public function readPacket($data)
    {
        $mySQLMessage = new MySQLMessage($data);
        $this->packetLength = $mySQLMessage->readUB3();
        $this->packetId = $mySQLMessage->read();
        $this->protocolVersion = $mySQLMessage->read();
        $this->serverVersion = $mySQLMessage->readBytesWithNull();
        $this->threadId = $mySQLMessage->readUB4();
        $this->seed = $mySQLMessage->readBytesWithNull();
        $this->serverCapabilities = $mySQLMessage->readUB2();
        $this->serverCharset = $mySQLMessage->read();
        $this->serverStatus = $mySQLMessage->readUB2();
        $mySQLMessage->move(13);
        $this->restOfScrambleBuff = $mySQLMessage->readBytesWithNull();
    }

    public function writePacket()
    {
        // TODO: Implement writePacket() method.
    }

    public function calcPacketSize(): int
    {
        $size = 1;
        $size += strlen($this->serverVersion);
        $size += 5;
        $size += strlen($this->seed);
        $size += 19;
        $size += strlen($this->restOfScrambleBuff);
        $size += 1;
        return $size;
    }

    public function getPacketInfo(): string
    {
        return 'MySQL Handshake Packet';
    }
}
