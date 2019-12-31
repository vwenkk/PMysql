<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/12/4
 * Time: 11:07
 */

namespace PMysql\Constracts\Client;

use MongoDB\Driver\Exception\ConnectionException;
use PMysql\Common\Helper;
use PMysql\Constracts\Parameters\ParametersInterface;
use PMysql\Exception\Biz\ClientException;
use PMysql\Exception\Mapping\BizErrCodeMsgMapping;
use PMysql\Protocol\Packets\Packet;

/**
 * Class AbstractConnection
 * @package PMysql\Constracts\Client
 */
abstract class AbstractClient implements ClientInterface
{
    /**
     * @var resource
     */
    private $resource;

    /**
     * @var ParametersInterface
     */
    protected $parameters;

    /**
     * AbstractClient constructor.
     * @param ParametersInterface $parameters
     */
    public function __construct(ParametersInterface $parameters)
    {
        $this->parameters = $this->assertParameters($parameters);
    }

    /**
     *
     */
    public function connect()
    {
        if (!$this->isConnected()) {
            $this->resource = $this->createResource();
        }
        if ($this->resource) {
            return true;
        }
        return false;
    }

    public function disconnect()
    {
        unset($this->resource);
    }

    /**
     * @return bool
     */
    public function isConnected()
    {
        return isset($this->resource);
    }

    /**
     * @param Packet $packet
     * @return mixed|void
     */
    public function request(Packet $packet)
    {
        $buffer = $packet->writePacket();
        $this->write($buffer);
    }

    protected function write($buffer)
    {
        $socket = $this->getResource();

        while (($length = strlen($buffer)) > 0) {
            $written = fwrite($socket, $buffer);
            if ($length === $written) {
                return;
            }
            if ($written === false || $written === 0) {
                $this->onConnectionError('Error while writing bytes to the server.');
            }
            $buffer = substr($buffer, $written);
        }
    }

    /**
     * @throws \Exception
     */
    protected function read()
    {
        $socket = $this->getResource();

        $contents = '';
        while (!feof($socket)) {
            $contents .= fread($socket, 3);
        }

        return $contents;
    }
    /**
     *
     */
    public function response()
    {
        $contents = $this->read();
        /**
         * string to bytes
         */
        return Helper::stringToBytes($contents);
    }

    /**
     *
     */
    public function __destruct()
    {
        $this->disconnect();
    }

    /**
     * @return resource
     */
    public function getResource()
    {
        if (!$this->resource) {
            $this->connect();
        }
        return $this->resource;
    }

    /**
     * @return ParametersInterface
     */
    public function getParameters(): ParametersInterface
    {
        return $this->parameters;
    }

    abstract protected function assertParameters(ParametersInterface $parameters);

    abstract protected function createResource();

    /**
     * @param $message
     * @param null $code
     * @throws \Exception
     */
    protected function onConnectionError($message, $code = null)
    {
        throw new ClientException(BizErrCodeMsgMapping::CLIENT_INVALID_SCHEME_ERROR, [
            'message' => $message,
            'code' => $code
        ]);
    }
}
