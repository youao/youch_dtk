const u = navigator.userAgent;

export function isAndroid() {
    return u.indexOf('Android') > -1 || u.indexOf('Adr') > -1;
}

export function isiOS() {
    return !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/);
}

export function getDeviceOs() {
    if (isAndroid()) {
        return 'android';
    }
    if (isiOS()) {
        return 'ios';
    }
    return '';
}

export function trim(str) {
    return String.prototype.trim.call(str);
}

export function isType(arg, type) {
    return Object.prototype.toString.call(arg) === "[object " + type + "]";
}

export function jsonToStr(ops) {
    let data = ops.data || {};
    let connector = ops.connector || '='; // 联接符
    let separator = ops.separator || '&'; // 分隔符
    let str = ops.base || '';
    for (const key in data) {
        str += key + connector + data[key] + separator;
    }
    str = str.substring(0, str.length - separator.length);
    let suffix = ops.suffix || '';
    return str + suffix;
}