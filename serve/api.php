<?php
header('Access-Control-Allow-Origin:http://localhost:8080');
header('Access-Control-Allow-Credentials:true');
header("Content-Type: text/html;charset=utf-8");

define('Url', 'https://openapi.dataoke.com/api');
define('AppKey', '5fa60cc5b8c40');
define('AppSecret', 'b75ab507b1571acc14b9cbe50a4a2fe5');

include 'utils/request.php';

$path = $_SERVER['PATH_INFO'];
$path = explode("/", $path);
if (empty($path[1]) || empty($path[2])) {
    exit(requestResult('缺少环境参数'));
}

include 'api/' . $path[1] . '/' . $path[2] . '.php';
