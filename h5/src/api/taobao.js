import request from "@/utils/request";

export function getGoodsList(data) {
    const { cache } = data;
    return request.get('/goods/list', data, { cache });
}

// 排行榜列表
export function getRankList(data) {
    return request.get('/goods/rankList', data);
}