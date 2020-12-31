<?php
header("Content-Type:application/json; charset=utf-8");
include "assets/hdkSdk/ApiSdk.php";

$c = new HdkRequest;
$c->method = 'supersearch';

$params = array();
if (empty($_GET['keyword'])) {
    exit(requestResult('缺少关键词'));
}

$params['keyword'] = $_GET['keyword'];
/**
 * order
 * 0 => 综合（最新）
 * 1 => 最新
 * 2 => 销量（高到低）
 * 3 => 销量（低到高）
 * 4 => 价格(低到高)
 * 5 => 价格（高到低）
 * 6 => 佣金比例（高到低）
 * **/
$params['sort'] = empty($_GET['order']) ? 0 : $_GET['order'];
// 是否只取天猫商品：0否；1是，默认是0
$params['is_tmall'] = empty($_GET['is_tmall']) ? 1 : $_GET['is_tmall'];
// 是否只取有券商品：0否；1是，默认是0
$params['is_coupon'] = empty($_GET['is_coupon']) ? 1 : $_GET['is_coupon'];
// 是否只取偏远地区包邮商品：0否；1是，默认是0
$params['is_shopping'] = empty($_GET['is_shopping']) ? 0 : $_GET['is_shopping'];
// 佣金比例过滤0~100
$params['limitrate'] = empty($_GET['limitrate']) ? 10 : $_GET['limitrate'];
// 最低原价（默认为0），例如传10则只取大于等于10元的原价商品数据
$params['startprice'] = empty($_GET['startprice']) ? 0 : $_GET['startprice'];
// 渠道关系ID，仅适用于渠道推广场景
$params['relation_id'] = empty($_GET['relation_id']) ? '' : $_GET['relation_id'];
// 会员运营ID
$params['special_id'] = empty($_GET['special_id']) ? '' : $_GET['special_id'];

$params['min_id'] = empty($_GET['page']) ? 1 : $_GET['page'];
// 淘宝分页
$params['tb_p'] = empty($_GET['page']) ? 1 : $_GET['page'];
$params['back'] = empty($_GET['pageSize']) ? 10 : $_GET['pageSize'];

$request = $c->request($params);
$data = json_decode($request, true);
$data = $data['data'];

$res['status'] = 1;
$res['data'] = $data;

exit(requestResult($res));
