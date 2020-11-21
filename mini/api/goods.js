import request from "./../utils/request.js";
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
  return request.get("/goods/detail", {id});
}