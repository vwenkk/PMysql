<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/12/26
 * Time: 13:11
 */

namespace PMysql\Protocol;

use PMysql\Common\Helper;

/**
 * Class MySQLMessage
 * @package PMysql\Protocol
 */
class MySQLMessage
{
    /**
     * @var int
     */
    public static $NULL_LENGTH = -1;
    /**
     * @var int
     */
    private static $EMPTY_BYTES = 0;

    /**
     * @var array
     */
    private $data;

    /**
     * @var int
     */
    public $length;

    /**
     * @var int
     */
    private $position;

    /**
     * MySQLMessage constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->length = count($data);
        $this->position = 0;
    }

    /**
     * @return int
     */
    public function length()
    {
        return $this->length;
    }

    /**
     * @param int $i
     * @return int
     */
    public function position(int $i = 0)
    {
        if ($i) {
            $this->position = $i;
        } else {
            return $this->position;
        }
    }

    /**
     * @return array
     */
    public function bytes()
    {
        return $this->data;
    }

    /**
     * @param int $i
     */
    public function move(int $i)
    {
        $this->position += $i;
    }

    /**
     * @return bool
     */
    public function hasRemaining()
    {
        return $this->length > $this->position;
    }

    /**
     * @param int $i
     * @return mixed
     */
    public function read(int $i = 0)
    {
        if ($i) {
            return $this->data[$i];
        }

        return $this->data[$this->position++];
    }

    /**
     * @return int|mixed
     */
    public function readUB2()
    {
        $b = $this->data;
        $i = $b[$this->position++];
        $i |= ($b[$this->position++]) << 8;

        return $i;
    }

    /**
     * @return int|mixed
     */
    public function readUB3()
    {
        $b = $this->data;
        $i = $b[$this->position++];
        $i |= ($b[$this->position++]) << 8;
        $i |= ($b[$this->position++]) << 16;

        return $i;
    }

    /**
     * @return int|mixed
     */
    public function readUB4()
    {
        $b = $this->data;
        $l = $b[$this->position++];
        $l |= $b[$this->position++] << 8;
        $l |= $b[$this->position++] << 16;
        $l |= $b[$this->position++] << 24;

        return $l;
    }

    /**
     * @return int|mixed
     */
    public function readInt()
    {
        $b = $this->data;
        $i = $b[$this->position++];
        $i |= ($b[$this->position++]) << 8;
        $i |= ($b[$this->position++]) << 16;
        $i |= ($b[$this->position++]) << 24;

        return $i;
    }

    /**
     * @return float
     */
    public function readFloat()
    {
        return (float)($this->readInt());
    }

    /**
     * @return int|mixed
     */
    public function readLong()
    {
        $b = $this->data;
        $l = $b[$this->position++];
        $l |= $b[$this->position++] << 8;
        $l |= $b[$this->position++] << 16;
        $l |= $b[$this->position++] << 24;
        $l |= $b[$this->position++] << 32;
        $l |= $b[$this->position++] << 40;
        $l |= $b[$this->position++] << 48;
        $l |= $b[$this->position++] << 56;

        return $l;
    }

    /**
     * @return int|mixed
     */
    public function readDouble()
    {
        return $this->readLong();
    }

    /**
     * @return int|mixed
     */
    public function readLength()
    {
        $length = ($this->data[$this->position++] ?? 0) & 0xff;
        switch ($length) {
            case 251:
                return self::$NULL_LENGTH;
            case 252:
                return $this->readUB2();
            case 253:
                return $this->readUB3();
            case 254:
                return $this->readLong();
            default:
                return $length;
        }
    }

    /**
     * @param int $length
     * @return array|int
     */
    public function readBytes(int $length = 0)
    {
        if ($length) {
            return array_slice($this->data, $this->position, $length);
        } else {
            if ($this->position >= $this->length) {
                return self::$EMPTY_BYTES;
            }

            return array_slice($this->data, $this->position, $this->length - $this->position);
        }
    }

    /**
     * @return array|int
     */
    public function readBytesWithNull()
    {
        $b = $this->data;
        if ($this->position >= $this->length) {
            return self::$EMPTY_BYTES;
        }
        $offset = -1;
        for ($i = $this->position; $i < $this->length; ++$i) {
            if (0 == $b[$i]) {
                $offset = $i;
                break;
            }
        }
        switch ($offset) {
            case -1:
                $ab1 = array_slice($b, $this->position, $this->length - $this->position);
                $this->position = $this->length;

                return $ab1;
            case 0:
                $this->position++;

                return self::$EMPTY_BYTES;
            default:
                $ab2 = array_slice($b, $this->position, $offset - $this->position);
                $this->position = $offset + 1;

                return $ab2;
        }
    }

    /**
     * @return array
     */
    public function readBytesWithLength()
    {
        $length = (int)$this->readLength();
        if ($length <= 0) {
            return [self::$EMPTY_BYTES];
        }
        $ab = array_slice($this->data, $this->position, $length);
        $this->position += $length;

        return $ab;
    }

    /**
     * @param string $charset
     * @return string|null
     */
    public function readStringWithNull(string $charset = '')
    {
        $b = $this->data;
        if ($this->position >= $this->length) {
            return null;
        }
        $offset = -1;
        for ($i = $this->position; $i < $this->length; ++$i) {
            if (0 == $b[$i]) {
                $offset = $i;
                break;
            }
        }
        if ($charset) {
            switch ($offset) {
                case -1:
                    $s1 = Helper::bytesToString(array_slice($b, $this->position, $this->length - $this->position));
                    $this->position = $this->length;

                    return $s1;
                case 0:
                    $this->position++;

                    return null;
                default:
                    $s2 = Helper::bytesToString(array_slice($b, $this->position, $offset - $this->position));
                    $this->position = $offset + 1;

                    return $s2;
            }
        } else {
            if (-1 == $offset) {
                $s = Helper::bytesToString(array_slice($b, $this->position, $this->length - $this->position));
                $this->position = $this->length;

                return $s;
            }
            if ($offset > $this->position) {
                $s = Helper::bytesToString(array_slice($b, $this->position, $offset - $this->position));
                $this->position = $offset + 1;

                return $s;
            } else {
                ++$this->position;

                return null;
            }
        }
    }

    /**
     * @return string|null
     */
    public function readString()
    {
        if ($this->position >= $this->length) {
            return null;
        }
        $string = Helper::bytesToString(
            array_slice(
                $this->data,
                $this->position,
                $this->length - $this->position
            )
        );
        $this->position = $this->length;

        return $string;
    }
}
