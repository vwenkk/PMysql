<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/12/4
 * Time: 11:40
 */

namespace PMysql;

use PMysql\Constracts\Client\AbstractClient;
use PMysql\Constracts\Parameters\ParametersInterface;
use PMysql\Exception\Biz\ClientException;
use PMysql\Exception\Mapping\BizErrCodeMsgMapping;

class StreamClient extends AbstractClient
{
    /**
     * @param ParametersInterface $parameters
     * @return ParametersInterface
     * @throws \Exception
     */
    protected function assertParameters(ParametersInterface $parameters)
    {
        switch ($parameters->scheme) {
            case 'tcp':
            case 'mysql':
                break;
            default:
                throw new ClientException(BizErrCodeMsgMapping::CLIENT_INVALID_SCHEME_ERROR, $parameters->toArray());
        }
        return $parameters;
    }

    protected function createResource()
    {
        switch ($this->parameters->scheme) {
            case 'tcp':
            case 'mysql':
                return $this->tcpStreamInitializer($this->parameters);
                break;
            default:
                throw new ClientException(
                    BizErrCodeMsgMapping::CLIENT_INVALID_SCHEME_ERROR,
                    $this->parameters->toArray()
                );
        }
    }

    protected function tcpStreamInitializer(ParametersInterface $parameters)
    {
        $address = "tcp://$parameters->host:$parameters->port";
        /**
         * 支持ipv6
         */
        if (filter_var($parameters->host, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $address = "tcp://[$parameters->host]:$parameters->port";
        }
        $flags = STREAM_CLIENT_CONNECT;
        $resource = $this->createStreamSocket($address, $flags);
        return $resource;
    }

    protected function createStreamSocket($address, $flags)
    {
        if (!$resource = @stream_socket_client($address, $errno, $errStr, 5, $flags)) {
            $this->onConnectionError($errStr, $errno);
        }
        return $resource;
    }
}
