<?php
/**
 * Created by PhpStorm.
 * User: WK
 * Date: 2019/11/19
 * Time: 10:43
 */
namespace Src\Common\Constants;

/**
 * server status
 * @see https://dev.mysql.com/doc/internals/en/status-flags.html
 * Class ServerStatus
 * @package Src\Common\Constants
 */
class ServerStatus extends Constant
{
    // a transaction is active
    const SERVER_STATUS_IN_TRANS = 0x0001;
    // auto-commit is enabled
    const SERVER_STATUS_AUTOCOMMIT = 0x0002;
    const SERVER_MORE_RESULTS_EXISTS = 0x0008;
    const SERVER_STATUS_NO_GOOD_INDEX_USED = 0x0010;
    const SERVER_STATUS_NO_INDEX_USED = 0x0020;
    // Used by Binary Protocol Resultset to signal that COM_STMT_FETCH must be used to fetch the row-data.
    const SERVER_STATUS_CURSOR_EXISTS = 0x0040;
    const SERVER_STATUS_LAST_ROW_SENT = 0x0080;
    const SERVER_STATUS_DB_DROPPED = 0x0100;
    const SERVER_STATUS_NO_BACKSLASH_ESCAPES = 0x0200;
    const SERVER_STATUS_METADATA_CHANGED = 0x0400;
    const SERVER_QUERY_WAS_SLOW = 0x0800;
    const SERVER_PS_OUT_PARAMS = 0x1000;
    // in a read-only transaction
    const SERVER_STATUS_IN_TRANS_READONLY = 0x2000;
    // connection state information has changed
    const SERVER_SESSION_STATE_CHANGED = 0x2000;
}
