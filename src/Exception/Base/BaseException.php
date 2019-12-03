<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/15
 * Time: 23:16
 */
namespace PMysql\Exception\Base;

use PHPUnit\Framework\MockObject\RuntimeException;
use PMysql\Exception\Mapping\BizErrCodeMsgMapping;

/**
 * Class BaseException
 * @package PMysql\Exception\Base
 */
abstract class BaseException extends RuntimeException
{
    /**
     * @var BizErrCodeMsgMapping
     */
    protected $errMapInstance = null;

    /**
     * @return int
     */
    abstract protected function getCodeMin(): int;

    /**
     * @return int
     */
    abstract protected function getCodeMax(): int;

    /**
     * @return ErrorMapBase
     */
    abstract protected function setErrCodeMsgMapping();

    /**
     * @return BizErrCodeMsgMapping
     */
    protected function getErrMapInstance()
    {
        if (is_null($this->errMapInstance)) {
            $this->setErrCodeMsgMapping();
        }
        return $this->errMapInstance;
    }

    /**
     * 获取通过验证的错误码，在子类中编写验证逻辑
     * @param int $errno
     * @return bool
     */
    protected function validateErrorCode(int $errno): bool
    {
        return $this->between($errno, $this->getCodeMin(), $this->getCodeMax());
    }

    /**
     * @param int $errno
     * @param int $min
     * @param int $max
     * @return bool
     */
    protected function between(int $errno, int $min, int $max)
    {
        return $errno <= $max && $errno >= $min;
    }

    /**
     * @param int $code
     * @param null $context
     * @return mixed|string
     */
    protected function getErrorMsg(int $code, $context = null)
    {
        return $this->getErrMapInstance()->getDisplayErrMsg($code, $context);
    }
}
