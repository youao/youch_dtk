<?php
// jd.union.open.goods.promotiongoodsinfo.query 根据skuid查询商品信息接口
header("Content-type: text/html; charset=utf-8");

if (empty($_GET['id'])) {
    exit(requestResult('缺少参数id'));
}

$skuIds = $_GET['id'];

include "assets/josSdk/JdSdk.php";

$c = new JdClient();
$c->version = "1.0";

$req = new UnionOpenGoodsPromotiongoodsinfoQueryRequest();
$req->setSkuIds($skuIds);

$resq = $c->execute($req);
$resq = $resq->jd_union_open_goods_promotiongoodsinfo_query_responce;
$resq = $resq->queryResult;
$resq = json_decode($resq);

$code = $resq->code;
if ($code != 200) {
    $res = array(
        'status' => 0,
        'code' => $code,
        'msg' => $resq->message
    );
} else {
    $data = $resq->data;
    if(!empty($data)) {
        $res = array(
            'status' => 1,
            'data' => $resq->data
        );
    } else {
        $msg = '找不到相关宝贝或该宝贝未参加推广活动';
        exit(requestResult($msg));
    }   
}
exit(requestResult($res));