<?php
header("Content-Type:application/json; charset=utf-8");
include "assets/hdkSdk/ApiSdk.php";

$c = new HdkRequest;
$c->method = 'item_detail';

if (empty($_GET['id'])){
    exit(requestResult('缺少参数id'));
}

$params = array();
$params['itemid'] = $_GET['id'];

$request = $c->request($params);
$data = json_decode($request, true);
if ($data['code'] != 1) {
    exit(requestResult($data['msg']));
}
$data = $data['data'];

$res['status'] = 1;
$res['data'] = $data;

exit(requestResult($res));
