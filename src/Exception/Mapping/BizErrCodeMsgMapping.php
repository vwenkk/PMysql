<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/15
 * Time: 23:21
 */
namespace PMysql\Exception\Mapping;

use PMysql\Exception\Base\ErrorMapBase;

/**
 * Class BizErrCodeMsgMapping
 * @package PMysql\Exception\Mapping
 */
class BizErrCodeMsgMapping extends ErrorMapBase
{
    # client 相关 1000 ~ 1100
    const CLIENT_INVALID_SCHEME_ERROR = 1000;
    const CLIENT_CONNECTION_ERROR = 1001;
    # end

    protected function getErrMsgMapping()
    {
        return array(
            self::CLIENT_INVALID_SCHEME_ERROR => 'client 连接协议错误',
            self::CLIENT_CONNECTION_ERROR => 'client 连接错误'
        );
    }
}