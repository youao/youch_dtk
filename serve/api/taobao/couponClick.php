<?php
include "assets/dtkSdk/ApiSdk.php";

$c = new CheckSign;
$c->host = '/tb-service/get-privilege-link';
$c->version = 'v1.3.0';

$params = array();
if (empty($_GET['goodsId'])) {
    exit(requestResult('缺少商品id'));
}
$params['goodsId'] = $_GET['goodsId'];

$request = $c->request($params);
$data = json_decode($request, true);
$data = $data['data'];

$res['status'] = 1;
$res['data'] = $data;

exit(requestResult($res));
