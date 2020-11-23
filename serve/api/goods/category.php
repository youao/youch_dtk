<?php
$c = new CheckSign;
$c->host = Url . '/category/get-super-category';
$c->appKey = AppKey;
$c->appSecret = AppSecret;
$c->version = 'v1.1.0';

$params = array();

$request = $c->request($params);
$data = json_decode($request, true);
$data = $data['data'];

$res['status'] = 1;
$res['data'] = $data;

exit(requestResult($res));
