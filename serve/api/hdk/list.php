<?php
include "assets/hdkSdk/ApiSdk.php";

$c = new HdkRequest;
$c->method = 'sales_list';

$params = array();
$params['sale_type'] = 1;
$params['min_id'] = 1;
$params['back'] = 10;


$request = $c->request($params);
$data = json_decode($request, true);
$data = $data['data'];

$res['status'] = 1;
$res['data'] = $data;

exit(requestResult($res));
