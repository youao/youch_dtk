<?php
header("Content-type: text/html; charset=utf-8");

$eliteId = !empty($_GET['eliteId']) ? $_GET['eliteId'] : 2;
$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$pageSize = !empty($_GET['pageSize']) ? $_GET['pageSize'] : 10;

$goodsReq = array(
    "eliteId" => $eliteId,
    "pageIndex" => $page,
    "pageSize" => $pageSize
);

include "assets/josSdk/JdSdk.php";

$c = new JdClient();
$c->version = "1.0";

$req = new UnionOpenGoodsJingfenQueryRequest();
$req->setGoodsReq($goodsReq);

$resq = $c->execute($req, $c->accessToken);
$resq = $resq->jd_union_open_goods_jingfen_query_responce;
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