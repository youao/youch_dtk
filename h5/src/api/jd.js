/**
 * 京粉精选商品查询接口
 * jd.union.open.goods.jingfen.query
 * data->eliteId 频道ID https://union.jd.com/openplatform/api/10417
 */
export function getJdJingfen(data) {
    return request.get("/jd/jingfen", data, { cache: 600 });
}