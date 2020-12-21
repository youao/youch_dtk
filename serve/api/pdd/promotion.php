<?php
if (empty($_GET['goods_sign']) && empty($_GET['id'])) {
    $msg = '缺少参数goods_sign/id';
    exit(requestResult($msg));
}

$goods_sign = !empty($_GET['goods_sign']) ? $_GET['goods_sign'] : '';
$goods_id_list = !empty($_GET['id']) ? array((string)$_GET['id']) : '';
$search_id = !empty($_GET['search_id']) ? $_GET['search_id'] : '';

$pid = '10529200_182605056';
$zs_duo_id = '10529200';

include "assets/pddSdk/ApiSdk.php";

$c = new pddRequest();
$c->type = 'pdd.ddk.goods.promotion.url.generate';

$params = array(
    'goods_sign' => $goods_sign,
    'goods_id_list' => json_encode($goods_id_list),
    'search_id' => $search_id,
    'p_id' => $pid,
    'generate_we_app' => true,
    'zs_duo_id' => $zs_duo_id
);

$resq = $c->request($params);
$resq = json_decode($resq);
$data = $resq->goods_promotion_url_generate_response;
$data = $data->goods_promotion_url_list;

$res['status'] = 1;
$res['data'] = $data[0];

exit(requestResult($res));
