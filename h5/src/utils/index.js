const u = navigator.userAgent;

export function isAndroid() {
    return u.indexOf('Android') > -1 || u.indexOf('Adr') > -1;
}

export function isiOS() {
    return !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/);
}

export function isPc() {
    const mobiles = ["Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod"];
    for (const m of mobiles) {
        if (u.indexOf(m) > -1) {
            return false;
        }
    }
    return true;
}

export function getDeviceOs() {
    if (isAndroid()) {
        return 'android';
    }
    if (isiOS()) {
        return 'ios';
    }
    return 'pc';
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

/**
 * 监听滚动触底事件
 * @options[element]，监听滚动的元素，默认指向window
 * @options[callback]，触底回调
 * @options[threshold]，到达底部多少距离触发回调
 */
export function evScrollout(options) {
    if (typeof options == 'function') {
        options = { callback: options };
    }
    if (typeof options.callback !== 'function') return;

    let element = options.element;
    var elementMain = document.getElementById("main");
    if (!element && elementMain) {
        element = elementMain
    } else if (typeof element == 'string') {
        element = document.querySelector(element);
    }

    var isWinow = !element || element.nodeType != 1;
    var elListener = isWinow ? window : element;

    var threshold = isNaN(threshold) ? 0 : threshold;

    element = isWinow ? (document.documentElement || document.body) : element;

    elListener.addEventListener('scroll', function() {
        var clientH = isWinow ? element.clientHeight : element.offsetHeight;
        var scrollT = element.scrollTop;
        var scrollH = element.scrollHeight;

        if (!scrollT) return; // 滚动条高度为0时不触发

        if (clientH + scrollT - threshold >= scrollH) {
            options.callback();
        }
    })
}