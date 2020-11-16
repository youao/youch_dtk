import request from "./../utils/request.js";
/**
 * 获取商品列表
 */
export function getGoodsList(data = {}) {
  return request.get("/goods/list", data, {
    cache: data.cache || false
  });
}