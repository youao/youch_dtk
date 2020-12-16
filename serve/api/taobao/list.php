<?php
include "assets/dtkSdk/ApiSdk.php";

$c = new CheckSign;
$c->host = '/goods/get-goods-list';
$c->version = 'v1.2.4';

$params = array();
$params['pageId'] = empty($_GET['page']) ? 1 : $_GET['page'];

/**
 * pageSize
 * 若小于10，则按10条处理
 * 每页条数仅支持输入10,50,100,200
 */
$params['pageSize'] = empty($_GET['pageSize']) ? 10 : $_GET['pageSize'];

/**
 * sort
 * 默认为0，0-综合排序
 * 1-商品上架时间从高到低
 * 2-销量从高到低
 * 3-领券量从高到低
 * 4-佣金比例从高到低
 * 5-价格（券后价）从高到低
 * 6-价格（券后价）从低到高
 */
$params['sort'] = empty($_GET['sort']) ? 0 : $_GET['sort']; 

$params['cids'] = empty($_GET['cids']) ? '' : $_GET['cids']; 

/**
 * specialId 商品卖点
 * 1.拍多件活动
 * 2.多买多送
 * 3.限量抢购
 * 4.额外满减
 * 6.买商品礼赠
 */
$params['specialId'] = empty($_GET['specialId']) ? '' : $_GET['specialId']; 

/**
 * juHuaSuan
 * 1-聚划算商品
 * 0-所有商品，不填默认为0
 */
$params['juHuaSuan'] = empty($_GET['juHuaSuan']) ? 0 : $_GET['juHuaSuan']; 

/**
 * taoQiangGou
 * 1-淘抢购商品
 * 0-所有商品，不填默认为0
 */
$params['taoQiangGou'] = empty($_GET['taoQiangGou']) ? 0 : $_GET['taoQiangGou']; 

/**
 * tmall
 * 1-天猫商品
 * 0-所有商品，不填默认为0
 */
$params['tmall'] = empty($_GET['tmall']) ? 0 : $_GET['tmall']; 

/**
 * tchaoshi
 * 1-天猫超市商品
 * 0-所有商品，不填默认为0
 */
$params['tchaoshi'] = empty($_GET['tchaoshi']) ? 0 : $_GET['tchaoshi']; 

/**
 * goldSeller
 * 1-金牌卖家商品
 * 0-所有商品，不填默认为0
 */
$params['goldSeller'] = empty($_GET['goldSeller']) ? 0 : $_GET['goldSeller']; 

/**
 * haitao
 * 1-海淘商品
 * 0-所有商品，不填默认为0
 */
$params['haitao'] = empty($_GET['haitao']) ? 0 : $_GET['haitao']; 

/**
 * pre
 * 1-预告商品
 * 0-所有商品，不填默认为0
 */
$params['pre'] = empty($_GET['pre']) ? 0 : $_GET['pre']; 

/**
 * preSale
 * 1-活动预售商品
 * 0-所有商品，不填默认为0
 */
$params['preSale'] = empty($_GET['preSale']) ? 0 : $_GET['preSale']; 

/**
 * brand
 * 1-品牌商品
 * 0-所有商品，不填默认为0
 */
$params['brand'] = empty($_GET['brand']) ? 0 : $_GET['brand']; 

/**
 * brandIds
 * 当brand传入0时，再传入brandIds可能无法获取结果
 * 品牌id可以传多个，以英文逗号隔开，如：”345,321,323”
 */
$params['brandIds'] = empty($_GET['brandIds']) ? 0 : $_GET['brandIds']; 

/**
 * freeshipRemoteDistrict
 * 1-是，偏远地区包邮
 * 0-所有商品，不填默认为0
 */
$params['freeshipRemoteDistrict'] = empty($_GET['freeshipRemoteDistrict']) ? 0 : $_GET['freeshipRemoteDistrict']; 

$request = $c->request($params);
$data = json_decode($request, true);
$data = $data['data']['list'];

$res['status'] = 1;
$res['data'] = $data;

exit(requestResult($res));
