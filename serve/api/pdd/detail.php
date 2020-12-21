<?php
if (empty($_GET['goods_sign']) && empty($_GET['id'])) {
    $msg = '缺少参数goods_sign/id';
    exit(requestResult($msg));
}

$goods_sign = !empty($_GET['goods_sign']) ? $_GET['goods_sign'] : '';
$goods_id_list = !empty($_GET['id']) ? array((string)$_GET['id']) : '';
$search_id = !empty($_GET['search_id']) ? $_GET['search_id'] : '';

include "assets/pddSdk/ApiSdk.php";

$c = new pddRequest();
$c->type = 'pdd.ddk.goods.detail';

$params = array(
    'goods_sign' => $goods_sign,
    'goods_id_list' => json_encode($goods_id_list),
    'search_id' => $search_id
);

$resq = $c->request($params);
$resq = json_decode($resq);
$data = $resq->goods_detail_response;
$data = $data->goods_details;

$res['status'] = 1;
$res['data'] = $data[0];

exit(requestResult($res));
