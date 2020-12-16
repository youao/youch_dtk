<?php
include "assets/dtkSdk/ApiSdk.php";

$c = new CheckSign;
$c->host = '/goods/get-goods-details';
$c->version = 'v1.2.3';

$params = array();
if (empty($_GET['id'])) {
    exit(requestResult('缺少商品id'));
}
$params['id'] = $_GET['id'];

$request = $c->request($params);
$data = json_decode($request, true);
$data = $data['data'];

$res['status'] = 1;
$res['data'] = $data;

exit(requestResult($res));
