<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/11/19
 * Time: 11:12
 */
namespace Src;

/**
 * Class MysqlConnect
 * @package Src
 */
class MysqlConnect
{

    /**
     * @var
     */
    protected $host;

    /**
     * @var
     */
    protected $port;

    /**
     * @var
     */
    protected $user;

    /**
     * @var
     */
    protected $password;

    /**
     * @var
     */
    protected $dataBase;

    /**
     * MysqlConnect constructor.
     * @param $host
     * @param $port
     * @param $user
     * @param $password
     * @param $dataBase
     */
    public function __construct($host, $port, $user, $password, $dataBase)
    {
        $this->setConnectionConfig($host, $port, $user, $password, $dataBase);
    }

    /**
     * @param $host
     * @param $port
     * @param $user
     * @param $password
     * @param $dataBase
     */
    protected function setConnectionConfig($host, $port, $user, $password, $dataBase)
    {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;
        $this->dataBase = $dataBase;
    }
}
