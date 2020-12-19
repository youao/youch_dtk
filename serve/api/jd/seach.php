<?php
// jd.union.open.goods.query 关键词商品查询接口【申请】
// 暂无权限
header("Content-type: text/html; charset=utf-8");

$skuIds = explode(',', (string)$_GET['skuIds']);
// $keyword = !empty($_GET['keyword']) ? $_GET['keyword'] : '';
// $cid1 = !empty($_GET['cid1']) ? $_GET['cid1'] : '';
// $cid2 = !empty($_GET['cid2']) ? $_GET['cid2'] : '';
// $cid3 = !empty($_GET['cid3']) ? $_GET['cid3'] : '';
// $brandCode = !empty($_GET['brandCode']) ? $_GET['brandCode'] : '';
// $shopId = !empty($_GET['shopId']) ? $_GET['shopId'] : '';
$isCoupon = !empty($_GET['isCoupon']) ? $_GET['isCoupon'] : 0;
$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$pageSize = !empty($_GET['pageSize']) ? $_GET['pageSize'] : 10;

$goodsReq = array(
    "skuIds" => $skuIds,
    "keyword" => $_GET['keyword'],
    "cid1" => $_GET['cid1'],
    "cid2" => $_GET['cid2'],
    "cid3" => $_GET['cid3'],
    "brandCode" => $_GET['brandCode'],
    "shopId" => $_GET['shopId'],
    "isCoupon" => $isCoupon,
    "pageIndex" => $page,
    "pageSize" => $pageSize
);

include "assets/josSdk/JdSdk.php";

$c = new JdClient();
$c->version = "1.0";

$req = new UnionOpenGoodsQueryRequest();
$req->setGoodsReqDTO($goodsReq);

$resq = $c->execute($req, $c->accessToken);
$resq = $resq->jd_union_open_goods_query_responce;
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