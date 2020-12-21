<?php
if (empty($_GET['goods_sign']) && empty($_GET['id'])) {
    $msg = '缺少参数goods_sign/id';
    exit(requestResult($msg));
}

$goods_sign = !empty($_GET['goods_sign']) ? $_GET['goods_sign'] : '';
$goods_id_list = !empty($_GET['id']) ? array((string)$_GET['id']) : '';
$search_id = !empty($_GET['search_id']) ? $_GET['search_id'] : '';
$is_we_app = !empty($_GET['is_we_app']) ? $_GET['is_we_app'] : '';

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
    'generate_we_app' => $is_we_app,
    'zs_duo_id' => $zs_duo_id
);

$resq = $c->request($params);
$resq = json_decode($resq);
$data = $resq->goods_promotion_url_generate_response;
$data = $data->goods_promotion_url_list;
$data = $data[0];

if ($is_we_app && empty($data->we_app_info)) {
    $path = explode('?', $data->we_app_web_view_url);
    $path = 'package_a/welfare_coupon/welfare_coupon?' . $path[1];
    $we_app_info = array(
        'app_id' => 'wx32540bd863b27570',
        'page_path' => $path
    );
    $data->we_app_info = $we_app_info;
}

$res['status'] = 1;
$res['data'] = $data;

exit(requestResult($res));
