<?php
$xiaoxi_img_url = 'http://img01.xiaoxishengqian.com/app/img';

$banner = array();
$banner[] = array(
    'img' => $xiaoxi_img_url . '/banner/elm.jpg',
    'url' => "url=https://s.click.ele.me/6Kd8Wsu"
);
$banner[] = array(
    'img' => $xiaoxi_img_url . '/banner/newyear.jpg',
    'url' => "url=https://s.click.taobao.com/LDPHWsu"
);
$banner[] = array(
    'img' => $xiaoxi_img_url . '/banner/juhuasuan.jpg',
    'url' => "url=https://s.click.taobao.com/jMmPRsu"
);

$nav = array();
$nav[] = array(
    'img' => 'https://funimg.pddpic.com/brand/jinbao/miaosha.png?imageView2/2/w/1300/q/80/format/webp',
    'title' => "限时秒杀",
    'url' => 'page=/hdk/channel/15'
);
$nav[] = array(
    'img' => 'https://funimg.pddpic.com/brand/jinbao/qingcang.png?imageView2/2/w/1300/q/80/format/webp',
    'title' => "品牌特惠",
    'url' => 'page=/hdk/channel/14'
);
$nav[] = array(
    'img' => 'https://funimg.pddpic.com/brand/jinbao/baokuan.png?imageView2/2/w/1300/q/80/format/webp',
    'title' => "爆款好货",
    'url' => 'page=/hdk/channel/12'
);
$nav[] = array(
    'img' => 'https://funimg.pddpic.com/brand/jinbao/temai.png?imageView2/2/w/1300/q/80/format/webp',
    'title' => "9块9特卖",
    'url' => 'page=/hdk/channel/9'
);
$nav[] = array(
    'img' => 'https://funimg.pddpic.com/brand/jinbao/lingquan.png?imageView2/2/w/1300/q/80/format/webp',
    'title' => "大额神券",
    'url' => 'page=/hdk/channel/17'
);

$data = array(
    'banner' => $banner,
    'nav' => $nav
);

$res['status'] = 1;
$res['data'] = $data;

exit(requestResult($res));
