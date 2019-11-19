<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/11/19
 * Time: 10:58
 */
namespace Src\Common\Constants;

/**
 * mysql field type
 * @see https://dev.mysql.com/doc/internals/en/com-query-response.html#column-type
 * Class ColumnType
 * @package Src\Common\Constants
 */
class ColumnType extends Constant
{
    const MYSQL_TYPE_DECIMAL = 0x00;
    const MYSQL_TYPE_TINY = 0x01;
    const MYSQL_TYPE_SHORT = 0x02;
    const MYSQL_TYPE_LONG = 0x03;
    const MYSQL_TYPE_FLOAT = 0x04;
    const MYSQL_TYPE_DOUBLE = 0x05;
    const MYSQL_TYPE_NULL = 0x06;
    const MYSQL_TYPE_TIMESTAMP = 0x07;
    const MYSQL_TYPE_LONGLONG = 0x08;
    const MYSQL_TYPE_INT24 = 0x09;
    const MYSQL_TYPE_DATE = 0x0a;
    const MYSQL_TYPE_TIME = 0x0b;
    const MYSQL_TYPE_DATETIME = 0x0c;
    const MYSQL_TYPE_YEAR = 0x0d;
    const MYSQL_TYPE_NEWDATE = 0x0e;
    const MYSQL_TYPE_VARCHAR = 0x0f;
    const MYSQL_TYPE_BIT = 0x10;
    const MYSQL_TYPE_NEWDECIMAL = 0xf6;
    const MYSQL_TYPE_ENUM = 0xf7;
    const MYSQL_TYPE_SET = 0xf8;
    const MYSQL_TYPE_TINY_BLOB = 0xf9;
    const MYSQL_TYPE_MEDIUM_BLOB = 0xfa;
    const MYSQL_TYPE_LONG_BLOB = 0xfb;
    const MYSQL_TYPE_BLOB = 0xfc;
    const MYSQL_TYPE_VAR_STRING = 0xfd;
    const MYSQL_TYPE_STRING = 0xfe;
    const MYSQL_TYPE_GEOMETRY = 0xff;
}
