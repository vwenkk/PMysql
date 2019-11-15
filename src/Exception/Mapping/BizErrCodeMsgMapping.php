<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/15
 * Time: 23:21
 */
namespace Src\Exception\Mapping;

use Src\Exception\Base\ErrorMapBase;

/**
 * Class BizErrCodeMsgMapping
 * @package Src\Exception\Mapping
 */
abstract class BizErrCodeMsgMapping extends ErrorMapBase
{
    const DEFAULT_BIZ_ERROR = 1000;
}