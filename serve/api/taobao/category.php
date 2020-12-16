<?php
include "assets/dtkSdk/ApiSdk.php";

$c = new CheckSign;
$c->host = '/category/get-super-category';
$c->version = 'v1.1.0';

$params = array();

$request = $c->request($params);
$data = json_decode($request, true);
$data = $data['data'];

$res['status'] = 1;
$res['data'] = $data;

exit(requestResult($res));
