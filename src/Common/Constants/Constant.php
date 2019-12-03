<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/11/19
 * Time: 10:44
 */

namespace PMysql\Common\Constants;

/**
 * Class Constant
 * @package PMysql\Common\Constants
 */
abstract class Constant
{
    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function getClassConstants()
    {
        $reflect = new \ReflectionClass(get_called_class());
        return $reflect->getConstants();
    }
}
