<?php
$c = new CheckSign;
$c->host = Url . '/goods/get-ranking-list';
$c->appKey = AppKey;
$c->appSecret = AppSecret;
$c->version = 'v1.3.0';

$params = array();
$params['rankType'] = $_GET['rankType'] || 1;
$params['cid'] = $_GET['cid'];
$params['pageId'] = empty($_GET['page']) ? 1 : $_GET['page'];
$params['pageSize'] = empty($_GET['pageSize']) ? 10 : $_GET['pageSize'];

$request = $c->request($params);
$data = json_decode($request, true);
$data = $data['data'];

$res['status'] = 1;
$res['data'] = $data;

exit(requestResult($res));
