<?php

function requestResult($ops)
{
    if (is_string($ops)) {
        $msg = $ops;
    } elseif (is_array($ops)) {
        return json_encode($ops);
    }
    $res['status'] = isset($status) ? $status : 0;
    if (isset($msg)) {
        $res['msg'] = $msg;
    }
    if (isset($data)) {
        $res['data'] = $data;
    }
    return json_encode($res);
}
