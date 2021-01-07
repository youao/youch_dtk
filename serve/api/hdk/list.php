<?php
header("Content-Type:application/json; charset=utf-8");
include "assets/hdkSdk/ApiSdk.php";

/**
 * 好单库列表合集
 * @method => 方法名，必须
 * 
 * @type => 方法细分板块
 * 
 * @cid => 细分类目
 * @cid -> 0-17 => 0全部，1女装，2男装，3内衣，4美妆，5配饰，6鞋品，7箱包，8儿童，9母婴，10居家，11美食，12数码，13家电，14其他，15车品，16文体，17宠物
 * @cid -> 0-12 => 0全部，1是母婴童品，2百变女装，3是食品酒水，4是居家日用，5是美妆洗护，6是品质男装，7是舒适内衣，8是箱包配饰，9是男女鞋靴，10是宠物用品，11是数码家电，12是车品文体
 * 
 * @order => 排序
 * **/

if (empty($_GET['method'])) {
    exit(requestResult('缺少参数method'));
}
$method = $_GET['method'];

$params = array();

switch ($method) {
        // 各大榜单API   
    case 'sales_list':
        // 是否只获取营销返利商品，1是，0否
        $params['item_type'] = empty($_GET['item_type']) ? 1 : $_GET['item_type'];
        /**
         * type
         * 1 => 实时销量榜（近2小时销量）
         * 2 => 今日爆单榜
         * 3 => 昨日爆单榜
         * 4 => 出单指数版
         * **/
        $params['sale_type'] = empty($_GET['type']) ? 1 : $_GET['type'];
        // 17 = 商品类目
        $params['cid'] = empty($_GET['cid']) ? 0 : $_GET['cid'];
        break;


        // 超值买返商品API
    case 'get_buyreturn_items':
        /**
         * order
         * 1 => 返现比例（从高到低）
         * 2 => 预估支出（从少到多）
         * 3 => 热销（月销量从高到低）
         * **/
        $params['order'] = empty($_GET['order']) ? 1 : $_GET['order'];
        break;

    case 'get_current_commission': // 实时佣金榜API 
    case 'get_orienteeringitems': // 定向计划商品API   
    case 'get_highitems': // 高佣专场商品API   
        // 17 = 商品类目
        $params['cat_id'] = empty($_GET['cid']) ? 0 : $_GET['cid'];
        break;


        // 精选低价包邮专区API
    case 'low_price_Pinkage_data':
        /**
         * order
         * 1 => 综合
         * 2 => 券后价从高到低
         * 3 => 券后价从低到高
         * 4 => 销量从高到低
         * 5 => 销量价从低到高
         * **/
        $params['order'] = empty($_GET['order']) ? 1 : $_GET['order'];
        /**
         * type
         * 1 => 精选专区
         * 2 => 9.9专区
         * 3 => 6.9专区
         * 4 => 3.9专区
         * **/
        $params['type'] = empty($_GET['type']) ? 1 : $_GET['type'];
        // 筛选，1.天猫商品；2.淘宝商品（C店）
        $params['screen_type'] = empty($_GET['screen_type']) ? 1 : $_GET['screen_type'];
        break;


        // 偏远地区包邮商品API
    case 'get_free_shipping_data':
        // 17 = 商品类目
        $params['cat_id'] = empty($_GET['cid']) ? 0 : $_GET['cid'];
        /**
         * order
         * 1 => 综合
         * 2 => 券后价从高到低
         * 3 => 券后价从低到高
         * 4 => 销量从高到低
         * 5 => 销量价从低到高
         * **/
        $params['order'] = empty($_GET['order']) ? 1 : $_GET['order'];
        // 偏远地区包邮商品关键词搜索
        $params['keyword'] = empty($_GET['keyword']) ? 1 : $_GET['keyword'];
        break;

        // 抖货商品API
    case 'get_trill_data':
        // 17 = 商品类目
        $params['cat_id'] = empty($_GET['cid']) ? 0 : $_GET['cid'];
        /**
         * order
         * 1 => 好单指数
         * 2 => 今日销量
         * 3 => 两小时销量
         * **/
        $params['order'] = empty($_GET['order']) ? 1 : $_GET['order'];
        break;


        // 品牌列表API
    case 'brand':
        // 12 = 商品类目
        $params['brandcat'] = empty($_GET['cid']) ? 0 : $_GET['cid'];
        break;

        // 今日值得买API
    case 'get_deserve_item':
        break;


        // 快抢商品API
    case 'fastbuy':
        /**
         * hour => 快抢时间点
         * 1.昨天的0点
         * 2.昨天10点
         * 3.昨天12点
         * 4.昨天15点
         * 5.昨天20点
         * 
         * 6.今天的0点
         * 7.今天10点
         * 8.今天12点
         * 9.今天15点
         * 10.今天20点
         * 
         * 11.明天的0点
         * 12.明天10点
         * 13.明天12点
         * 14.明天15点
         * 15.明天20点
         * **/
        if (empty($_GET['hour'])) {
            exit(requestResult('缺少参数hour'));
        }
        $params['hour_type'] = $_GET['hour'];
        break;

        // 商品列表页API
    case 'itemlist':
        /**
         * order
         * 1 => 好单指数
         * 2 => 月销量
         * 3 => 近两小时销量
         * 4 => 当天销量
         * 5 => 在线人数
         * 6 => 活动开始时间
         * **/
        $params['sort'] = empty($_GET['order']) ? 1 : $_GET['order'];
        break;

        // 商品筛选API
    case 'column':
        /**
         * type
         * 1 => 今日上新（当天新券商品）
         * 2 => 9.9包邮
         * 3 => 30元封顶
         * 4 => 聚划算
         * 5 => 淘抢购
         * 6 => 0点过夜单
         * 7 => 预告单
         * 8 => 品牌单
         * 9 => 天猫商品
         * 10 => 视频单
         * 11 => 天猫超市单
         * 12 => 偏远地区包邮单
         * 13 => 淘宝商品
         * **/
        $params['type'] = empty($_GET['type']) ? 1 : $_GET['type'];
        /**
         * order
         * 0 => 综合（最新）
         * 1 => 券后价(低到高)
         * 2 => 券后价（高到低）
         * 3 => 券面额（高到低）
         * 4 => 月销量（高到低）
         * 5 => 佣金比例（高到低）
         * 6 => 券面额（低到高）
         * 7 => 月销量（低到高）
         * 8 => 佣金比例（低到高）
         * 9 => 全天销量（高到低）
         * 10 => 全天销量（低到高）
         * 11 => 近2小时销量（高到低）
         * 12 => 近2小时销量（低到高）
         * 13 => 优惠券领取量（高到低）
         * 14 => 好单库指数（高到低）
         * **/
        $params['sort'] = empty($_GET['order']) ? 0 : $_GET['order'];
        // 17 = 商品类目
        $params['cid'] = empty($_GET['cid']) ? 0 : $_GET['cid'];
        
        // 券后价筛选，筛选大于等于所设置的券后价的商品
        $params['price_min'] = empty($_GET['price_min']) ? 0 : $_GET['price_min'];
        // 券后价筛选，筛选小于等于所设置的券后价的商品
        $params['price_max'] = empty($_GET['price_max']) ? 0 : $_GET['price_max'];

        // 销量筛选，筛选大于等于所设置的销量的商品
        $params['sale_min'] = empty($_GET['sale_min']) ? 1000 : $_GET['sale_min'];
        // 销量筛选，筛选小于等于所设置的销量的商品
        $params['sale_max'] = empty($_GET['sale_max']) ? 0 : $_GET['sale_max'];

        // 券金额筛选，筛选大于等于所设置的券金额的商品
        $params['coupon_min'] = empty($_GET['coupon_min']) ? 1 : $_GET['coupon_min'];
        // 券金额筛选，筛选小于等于所设置的券金额的商品
        $params['coupon_max'] = empty($_GET['coupon_max']) ? 0 : $_GET['coupon_max'];

        // 是否只获取营销返利商品，1是，0否
        $params['item_type'] = empty($_GET['item_type']) ? 1 : $_GET['item_type'];
        break;


        // 营销商品库API
    case 'tb_items_material_data':
        /**
         * type
         * 1 => 精选好货
         * 2 => 大额神券
         * **/
        $params['cat_id'] = empty($_GET['type']) ? 1 : $_GET['type'];
        break;

        // 猜你喜欢API
    case 'get_similar_info':
        // 获取猜你喜欢的类型商品的宝贝ID，可以优先获取相同二级类目下的商品
        if (empty($_GET['id'])) {
            exit(requestResult('缺少参数id'));
        }
        $params['itemid'] = $_GET['id'];
        break;

    default:
        exit(requestResult('method出错'));
        break;
}

$params['min_id'] = empty($_GET['page']) ? 1 : $_GET['page'];
$params['back'] = empty($_GET['pageSize']) ? 10 : $_GET['pageSize'];

$c = new HdkRequest;
$c->method = $method;

$request = $c->request($params);
$data = json_decode($request, true);
$data = $data['data'];

$res['status'] = 1;
$res['data'] = $data;

exit(requestResult($res));
