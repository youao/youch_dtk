<?php
include "assets/sdk/ApiSdk.php";

$c = new CheckSign;
$c->host = Url . '/goods/explosive-goods-list';
$c->appKey = AppKey;
$c->appSecret = AppSecret;
$c->version = 'v1.0.0';

$params = array();
$params['PriceCid'] = empty($_GET['PriceCid']) ? 1 : $_GET['PriceCid'];
$params['cids'] = $_GET['cids'];
$params['pageId'] = empty($_GET['page']) ? 1 : $_GET['page'];
$params['pageSize'] = empty($_GET['pageSize']) ? 10 : $_GET['pageSize'];

$request = $c->request($params);
$data = json_decode($request, true);

if ($data['code'] != 0) {
    $res = array(
        'status' => 0,
        'code' => $data['code'],
        'msg' => $data['msg']
    );
    exit(requestResult($res));
}

$data = $data['data'];
$res['status'] = 1;
$res['data'] = $data;

exit(requestResult($res));
