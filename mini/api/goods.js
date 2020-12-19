import request from "../utils/request.js";
/**
 * 获取商品列表
 */
export function getGoodsList(data = {}) {
  return request.get("/goods/list", data, {
    cache: data.cache || false
  });
}

/**
 * 获取商品详情
 */
export function getGoodsDetail(id) {
  return request.get("/goods/detail", {
    id
  });
}

/**
 * 获取商品优惠券跳转链接/口令
 */
export function getCouponClickUrl(goodsId) {
  return request.get("/goods/couponClick", {
    goodsId
  });
}

/**
 * 获取排行榜列表
 */
export function getRankList(data) {
  return request.get("/goods/rankList", data);
}

/**
 * 获取商品分类
 */
export function getCategory() {
  return request.get("/goods/category");
}