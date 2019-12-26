<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/12/4
 * Time: 11:13
 */
namespace PMysql\Constracts\Parameters;

interface ParametersInterface
{
    /**
     * @param $parameter
     * @return mixed|null
     */
    public function __get($parameter);

    /**
     * @param $parameter
     * @return bool
     */
    public function __isset($parameter);

    /**
     * @return mixed
     */
    public function toArray();
}
