import request from "../utils/request.js";
/**
 * 获取商品列表
 */
export function getPddRecommend(data = {}, cache = 300) {
  return request.get("/pdd/recommend", data, {
    cache
  });
}

/**
 * 获取商品详情
 * id/goods_sign
 * search_id
 */
export function getPddDetail(data) {
  return request.get("/pdd/detail", data);
}

/**
 * 获取推广跳转链接
 * id/goods_sign
 * search_id
 */
export function getPddPromotion(data) {
  return request.get("/pdd/promotion", data);
}