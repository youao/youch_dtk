<?php
$allow_origin = array( 
    'http://localhost:8080', 
    'http://www.youch.club'
);
$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : ''; 
if (in_array($origin, $allow_origin)) {
    header('Access-Control-Allow-Origin:' . $origin);
} else {
    // return;
    header('Access-Control-Allow-Origin:*');
}
header('Access-Control-Allow-Credentials:true');

include 'utils/request.php';

$path = $_SERVER['PATH_INFO'];
$path = explode("/", $path);
if (empty($path[1]) || empty($path[2])) {
    exit(requestResult('缺少环境参数'));
}

include 'api/' . $path[1] . '/' . $path[2] . '.php';
