<?php
header("Content-type: text/html; charset=utf-8");
include "assets/sdk/taobao/TopSdk.php";

$c = new TopClient;
$c->appkey = "31998249";
$c->secretKey = "5a69fad52f654dba48f6652cedd1c826"; // 可替换为您的沙箱环境应用的AppSecret
$sessionkey= "test";  // 必须替换为沙箱账号授权得到的真实有效SessionKey

$c = new TopClient;
$c->appkey = $appkey;
$c->secretKey = $secret;
$req = new TbkScOptimusMaterialRequest;
$req->setPageSize("20");
$req->setAdzoneId("123");
$req->setPageNo("1");
$req->setMaterialId("123");
$req->setSiteId("111");
$req->setDeviceType("IMEI");
$req->setDeviceEncrypt("MD5");
$req->setDeviceValue("xxx");
$req->setContentId("323");
$req->setContentSource("xxx");
$req->setItemId("33243");
$resp = $c->execute($req, $sessionKey);

// $req = new SellerItemGetRequest;
// $req->setFields("num_iid,title,nick,price,approve_status,sku");
// $req->setNumIid("123456789");
// $rsp = $c->execute($req,$sessionkey);

echo "api result:";
print_r($rsp);
?>