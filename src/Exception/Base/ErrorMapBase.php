<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/15
 * Time: 23:23
 */

namespace Src\Exception\Base;

use Monolog\Logger;

/**
 * Class ErrorMapBase
 * @package Src\Exception\Base
 */
abstract class ErrorMapBase
{
    /**
     *
     */
    protected function __clone()
    {
        // TODO: Implement __clone() method.
    }

    /**
     * @param $errno
     * @param $params
     * @return mixed|string
     */
    public function getDisplayErrMsg($errno, $params)
    {
        if (is_array($params)) {
        } elseif (!is_array($params) && is_string($params) && strlen($params) > 0) {
            $params = [$params];
        } else {
            $params = [];
        }

        $errMap = $this->getErrMsgMapping();
        if (isset($errMap[$errno])) {
            $tmp_error_content = $errMap[$errno];
            /**
             * fixbug: 支持中文展示
             */
            $strParams = empty($params) ? '' : json_encode($params, JSON_UNESCAPED_UNICODE);
            $tmp_error_content = strlen($strParams) > 0 ? $tmp_error_content.':'.$strParams : $tmp_error_content;
            return $tmp_error_content;
        } else {
            Logger::warning('Not Found Errno Map Msg...');
            return '';
        }
    }

    /**
     * @return array
     */
    abstract protected function getErrMsgMapping();
}
