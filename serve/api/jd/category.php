<?php
// jd.union.open.category.goods.get 商品类目查询接口
header("Content-type: text/html; charset=utf-8");

// 父类目id(一级父类目为0)
$parentId = !empty($_GET['parentId']) ? $_GET['parentId'] : 0;

// 类目级别(类目级别 0，1，2 代表一、二、三级类目)
$grade = !empty($_GET['grade']) ? $_GET['grade'] : 0;

$goodsReq = array(
    "parentId" => $parentId,
    "grade" => $grade
);

include "assets/josSdk/JdSdk.php";

$c = new JdClient();
$c->version = "1.0";

$req = new UnionOpenCategoryGoodsGetRequest();
$req->setReq($goodsReq);

$resq = $c->execute($req);
// print_r($resq);

$resq = $resq->jd_union_open_category_goods_get_responce;
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
    $res = array(
        'status' => 1,
        'data' => $resq->data
    );
}
exit(requestResult($res));