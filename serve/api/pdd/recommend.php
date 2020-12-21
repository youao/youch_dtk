<?php
// 商品推荐API：pdd.ddk.goods.recommend.get
// 本接口用于查询进宝频道推广商品
// 入参channel_type：0-1.9包邮, 1-今日爆款, 2-品牌好货,3-相似商品推荐,4-猜你喜欢,5-实时热销,6-实时收益,7-今日畅销,8-高佣榜单，默认5

$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$pageSize = !empty($_GET['pageSize']) ? $_GET['pageSize'] : 20;
$offset = $page * $pageSize;
$cat_id = !empty($_GET['cat_id']) ? $_GET['cat_id'] : '';
$channel_type = !empty($_GET['channel_type']) ? $_GET['channel_type'] : '';
$goods_ids = !empty($_GET['goods_ids']) ? $_GET['goods_ids'] : '';
$goods_sign_list = !empty($_GET['goods_sign_list']) ? $_GET['goods_sign_list'] : '';

include "assets/pddSdk/ApiSdk.php";

$c = new pddRequest();
$c->type = 'pdd.ddk.goods.recommend.get';

$params = array(
    'cat_id' => $cat_id,
    'channel_type' => $channel_type,
    'goods_ids' => $goods_ids,
    'goods_sign_list' => $goods_sign_list,
    'limit' => $pageSize,
    'list_id' => $page,
    'offset' => $offset
);

$resq = $c->request($params);
$resq = json_decode($resq);
$data = $resq->goods_basic_detail_response;
$data = $data->list;

$res['status'] = 1;
$res['data'] = $data;

exit(requestResult($res));
