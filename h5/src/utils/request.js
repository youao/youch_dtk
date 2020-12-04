import axios from "axios";
import app from "@/config";

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
        return baseRequest(
            Object.assign({ url, params, method }, defaultOpt, options)
        );
    };
});

export default request;