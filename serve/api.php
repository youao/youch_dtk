<?php

define('Url', 'https://openapi.dataoke.com/api');
define('AppKey', '5fa60cc5b8c40');
define('AppSecret', 'ee7f74b01aee352f117fa02d97799135');

include 'utils/request.php';

$path = $_SERVER['PATH_INFO'];
$path = explode("/", $path);
if (empty($path[1]) || empty($path[2])) {
    exit(requestResult('缺少环境参数'));
}

include "assets/sdk/ApiSdk.php";

include 'api/' . $path[1] . '/' . $path[2] . '.php';
