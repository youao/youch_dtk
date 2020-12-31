<?php
header("Content-Type:application/json; charset=utf-8");
include "assets/hdkSdk/ApiSdk.php";

$c = new HdkRequest;
$c->method = 'ratesurl';

if (empty($_GET['id'])){
    exit(requestResult('缺少参数id'));
}

$params = array();
$params['itemid'] = $_GET['id'];
$params['xid'] = '';
$params['pid'] = 'mm_54571722_2016650022_110809250330';
$params['relation_id'] = '';
$params['tb_name'] = '尤小罗2588';
if (!empty($_GET['title'])){
    $params['get_taoword'] = 1; 
    $params['title'] = $_GET['title'];
}

$request = $c->request($params, 'post');
$data = json_decode($request, true);
$data = $data['data'];

$res['status'] = 1;
$res['data'] = $data;

exit(requestResult($res));
