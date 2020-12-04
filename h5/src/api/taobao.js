import request from "@/utils/request";

export function getGoodsList(data) {
    return request.get('/goods/list', data);
}