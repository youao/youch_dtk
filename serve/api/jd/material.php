<?php

/**
 * 猜你喜欢商品推荐
 * https://union.jd.com/openplatform/api/13625
 * **/
header("Content-type: text/html; charset=utf-8");

$eliteId = !empty($_GET['eliteId']) ? $_GET['eliteId'] : 2;
$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$pageSize = !empty($_GET['pageSize']) ? $_GET['pageSize'] : 10;

$goodsReq = array(
    "eliteId" => $eliteId,
    "pageIndex" => $page,
    "pageSize" => $pageSize,
    "pid" => "1003670541_4100250893_3003267495",
    "hasCoupon"=>1,
    "forbidTypes"=>11
);

include "assets/josSdk/JdSdk.php";

$c = new JdClient();
$c->version = "1.0";

$req = new UnionOpenGoodsMaterialQueryRequest();
$req->setGoodsReq($goodsReq);

$resq = $c->execute($req, $c->accessToken);
$resq = $resq->jd_union_open_goods_material_query_responce;
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
    $res = array(
        'status' => 1,
        'data' => $resq->data
    );
}
exit(requestResult($res));
