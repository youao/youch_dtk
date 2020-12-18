<?php
// jd.union.open.promotion.common.get 网站/APP获取推广链接接口
header("Content-type: text/html; charset=utf-8");

if (empty($_GET['id'])) {
    exit(requestResult('缺少参数id'));
}
$skuId = (string)$_GET['id'];
$materialId = "https://item.jd.com/" . $skuId . ".html";

$goodsReq = array(
    "materialId" => $materialId,
    "siteId" => "4100250893"
);

include "assets/josSdk/JdSdk.php";

$c = new JdClient();
$c->version = "1.0";

$req = new UnionOpenPromotionCommonGetRequest();
$req->setPromotionCodeReq($goodsReq);

$resq = $c->execute($req);
$resq = $resq->jd_union_open_promotion_common_get_responce;
$resq = $resq->getResult;
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
    if (!empty($data)) {
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
