<?php
header("Content-Type:application/json; charset=utf-8");
include "assets/hdkSdk/ApiSdk.php";

$c = new HdkRequest;
$c->method = 'sales_list';

$params = array();
$params['sale_type'] = 1;
$params['min_id'] = empty($_GET['page']) ? 1 : $_GET['page'];
$params['back'] = empty($_GET['pageSize']) ? 10 : $_GET['pageSize'];


$request = $c->request($params);
$data = json_decode($request, true);
$data = $data['data'];

$res['status'] = 1;
$res['data'] = $data;

exit(requestResult($res));
