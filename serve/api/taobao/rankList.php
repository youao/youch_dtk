<?php
header("Content-type: text/html; charset=utf-8");

include "assets/dtkSdk/ApiSdk.php";

$c = new CheckSign;
$c->host = '/goods/get-ranking-list';
$c->version = 'v1.3.0';

$params = array();
$params['rankType'] = empty($_GET['rankType']) ? 1 : $_GET['rankType'];
$params['cid'] = $_GET['cid'];
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
