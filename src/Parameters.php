<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/12/4
 * Time: 13:39
 */

namespace PMysql;

use PMysql\Constracts\Parameters\ParametersInterface;

class Parameters implements ParametersInterface
{
    private $parameters;

    private static $defaults = array(
        'scheme' => 'tcp',
        'host' => '127.0.0.1',
        'port' => 3306
    );

    /**
     * @param array $parameters Named array of connection parameters.
     */
    public function __construct(array $parameters = array())
    {
        $this->parameters = $parameters + $this->getDefaults();
    }



    public function __get($parameter)
    {
        if (isset($this->parameters[$parameter])) {
            return $this->parameters[$parameter];
        }
    }

    public function __isset($parameter)
    {
        return isset($this->parameters[$parameter]);
    }

    public function toArray()
    {
        return $this->parameters;
    }

    /**
     * @return array
     */
    public static function getDefaults(): array
    {
        return self::$defaults;
    }
}
