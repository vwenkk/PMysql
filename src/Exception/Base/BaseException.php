<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/15
 * Time: 23:16
 */
namespace PMysql\Exception\Base;

use PMysql\Exception\Mapping\BizErrCodeMsgMapping;

/**
 * Class BaseException
 * @package PMysql\Exception\Base
 */
abstract class BaseException extends \RuntimeException
{
    /**
     * @var BizErrCodeMsgMapping
     */
    protected $errMapInstance = null;


    /**
     * BaseException constructor.
     * @param int $errno
     * @param string $context
     * @param \Exception|null $previous
     * @throws \Exception
     */
    public function __construct(int $errno, $context = '', \Exception $previous = null)
    {
        if ($this->validateErrorCode($errno)) {
            $formatMessage = $this->getErrorMsg($errno, $context);
            if (empty($formatMessage)) {
                $formatMessage = $context;
            }
            parent::__construct($formatMessage, $errno, $previous);
        } else {
            throw new \Exception('构造Exception失败，因为传入的Code不正确:', var_export($errno, false), $this->getPrevious());
        }
    }

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
