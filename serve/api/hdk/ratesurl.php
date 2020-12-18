<?php
include "assets/hdkSdk/ApiSdk.php";

$c = new HdkRequest;
$c->method = 'ratesurl';

$params = array();
$params['itemid'] = '617926599675';
$params['xid'] = '';
$params['pid'] = 'mm_54571722_2016650022_110809250330';
$params['relation_id'] = '';
$params['tb_name'] = '尤小罗2588';
$params['get_taoword'] = '1';
$params['title'] = '吃小天柳州螺蛳粉广西螺狮粉330g*1包正宗特产方便速食酸辣螺丝粉';

$request = $c->request($params, 'post');
$data = json_decode($request, true);
$data = $data['data'];

$res['status'] = 1;
$res['data'] = $data;

exit(requestResult($res));
