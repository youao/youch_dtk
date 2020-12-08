import { isType } from "@/utils";

function get(key) {
    let res = localStorage.getItem(key);
    if (!res) {
        return null;
    }
    let obj = JSON.parse(res);
    if (obj.expirse && new Date().getTime() > obj.expirse) {
        localStorage.removeItem(key);
    } else {
        return obj.value;
    }
    return null;
}

function set(key, value, expirse) {
    let obj = {value};
    if (typeof expirse == 'number') {
        obj.expirse = new Date().getTime() + expirse * 1000;
    } else if (isType(expirse, "Date")) {
        obj.expirse = expirse.getTime();
    }
    localStorage.setItem(key, JSON.stringify(obj));
}

function remove(key) {
    localStorage.removeItem(key);
}

function clearAll() {
    localStorage.clear();
}

export default {
    get,
    set,
    remove,
    clearAll
};