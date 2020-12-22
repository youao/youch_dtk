import request from "../utils/request.js";
/**
 * 获取商品列表
 */
export function getJdJingfen(data = {}, cache = 300) {
  return request.get("/jd/jingfen", data, {
    cache
  });
}

/**
 * 获取sku商品详情
 */
export function getJdSkuItem(id) {
  return request.get("/jd/skuItem", {
    id
  });
}

/**
 * 获取sku商品跳转
 */
export function getJdPromotion(id) {
  return request.get("/jd/promotion", {
    id
  });
}