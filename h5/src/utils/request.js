import axios from "axios";
import app from "@/config";
import { jsonToStr } from "@/utils";
import md5 from "js-md5";
import cookie from "@/utils/cookie";

axios.defaults.withCredentials = true;

const instance = axios.create({
    baseURL: app.apiUrl,
    timeout: 20000
});

const defaultOpt = { login: false };

function baseRequest(options) {
    return instance(options).then(res => {
        const data = res.data || {};
        if (res.status !== 200)
            return Promise.reject({ msg: "请求失败", res, data });
        if ([0].indexOf(data.status) !== -1) {
            return Promise.reject({ msg: res.data.msg });
        } else {
            const { cache, method, url, params } = options;
            if (cache && method == 'get') {
                let key = getUrlCacheKey(url, params);
                console.log('2-', key, data);
                let time = new Date().getTime() + cache * 1000;
                cookie.set(key, JSON.stringify(data), time);
            }

            return Promise.resolve(data, res);
        }
    });
}

const request = ["post", "put", "patch"].reduce((request, method) => {
    request[method] = (url, data = {}, options = {}) => {
        return baseRequest(
            Object.assign({ url, data, method }, defaultOpt, options)
        );
    };
    return request;
}, {});

["get", "delete", "head"].forEach(method => {
    request[method] = (url, params = {}, options = {}) => {

        const { cache } = options;
        if (cache && method == 'get') {
            let key = getUrlCacheKey(url, params);
            let res = cookie.get(key);
            console.log('1-', key, res);
            console.log(cookie.all())

            if (res) return JSON.parse(res);
        }

        return baseRequest(
            Object.assign({ url, params, method }, defaultOpt, options)
        );
    };
});

function getUrlCacheKey(url, params) {
    let cacheKey = jsonToStr({
        base: app.apiUrl + url + '?',
        data: params
    });
    return 'api_cache_' + md5(cacheKey);
}

export default request;