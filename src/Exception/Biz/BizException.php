<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/12/4
 * Time: 12:00
 */
namespace PMysql\Exception\Biz;

use PMysql\Exception\Base\BaseException;
use PMysql\Exception\Mapping\BizErrCodeMsgMapping;

class BizException extends BaseException
{
    protected $min = 1000;
    protected $max = 10000;

    protected function getCodeMin(): int
    {
        return $this->min;
    }

    protected function getCodeMax(): int
    {
        return $this->max;
    }

    protected function setErrCodeMsgMapping()
    {
        $this->errMapInstance = new BizErrCodeMsgMapping();
    }
}