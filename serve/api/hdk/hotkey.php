<?php
header("Content-Type:application/json; charset=utf-8");
include "assets/hdkSdk/ApiSdk.php";

$c = new HdkRequest;
$c->method = 'hot_key';

$params = array();

$request = $c->request($params, 'post');
$data = json_decode($request, true);
$data = $data['data'];

$res['status'] = 1;
$res['data'] = $data;

exit(requestResult($res));
