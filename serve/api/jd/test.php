<?php
header("Content-type: text/html; charset=utf-8");

include "assets/josSdk/JdSdk.php";

// $c = new JdClient();
// $c->version = "1.0";

// $req = new UnionOpenGoodsJingfenQueryRequest();
// $req->putOtherTextParam("pageIndex", "1");
// $req->putOtherTextParam("pageSize", "20");
// $req->putOtherTextParam("eliteId", "1");
// $goodsReq = array("eliteId"=>"1");
// $req->goodsReq=$goodsReq;
// $req->setEliteId(1);

// $resp = $c->execute($req, $c->accessToken);
// echo json_encode($resp);

// $url = 'https://router.jd.com/api?v=1.0&method=jd.union.open.goods.jingfen.query&access_token=&app_key=48cf4368992f5d0bb460aa5dc73a2592&sign_method=md5&format=json&timestamp=2020-12-17 17:13:07&sign=C305F1575709F5CFE408785486311FCC&param_json={"goodsReq":{"eliteId":"1"}}';
// $res = curl_get($url);
// echo json_encode($res);

$access_token = '';
$app_key = '48cf4368992f5d0bb460aa5dc73a2592';
$format = 'json';
$method = 'jd.union.open.goods.jingfen.query';
$param_json = array(
    "goodsReq"=>array(
        "eliteId" => "1"
    )
);
$timestamp = date('Y-m-d H:i:s');
$v = '1.0';

$appSecret = 'aaa503fcaaf14e0ea3ff3b8f44ea16ea';

$sign = $appSecret . 'access_token' . $access_token . 'app_key' . $app_key . 'format' . $format . 'method' . $method .'param_json' . json_encode($param_json) . 'timestamp' . $timestamp . 'v' . $v . $appSecret;
$sign = md5($sign);
$sign = strtoupper($sign);

$sign_method = 'md5';
$api = 'https://router.jd.com/api';
$url='https://router.jd.com/api?v=1.0&method=jd.union.open.goods.jingfen.query&access_token=&app_key=48cf4368992f5d0bb460aa5dc73a2592&sign_method=md5&format=json&timestamp='.$timestamp.'&sign='.$sign.'&param_json={%22goodsReq%22:{%22eliteId%22:%221%22}}';

// $url = $api . '?access_token=&app_key=' . $app_key . '&param_json=' . json_encode($param_json). '&format=' . $format . '&method=' . $method . '&v=' . $v . '&timestamp=' . $timestamp. '&sign=' . $sign.'&sign_method='.$sign_method;
echo $url;
$res = curl_get($url);
echo $res;

function curl_get($url)
{

    if (empty($url)) {

        return false;
    }

    $ch = curl_init(); //初始化curl

    curl_setopt($ch, CURLOPT_URL, $url); //抓取指定网页

    curl_setopt($ch, CURLOPT_HEADER, 0); //设置header

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //要求结果为字符串且输出到屏幕上

    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器

    $data = curl_exec($ch); //运行curl

    curl_close($ch);

    return $data;
}
