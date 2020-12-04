const Base = {
  url: 'https://www.xiaoxishengqian.com/ych/api.php',
  wxOpenUrl: 'https://api.weixin.qq.com',
  header: {}
};

export default function request(api, method, data, opt) {
  if (opt.wxOpen) {
    api = Base.wxOpenUrl + api;
  }
  const url = (api || '').indexOf('http') == 0 ? api : (opt.url || Base.url) + api;
  return new Promise((reslove, reject) => {
    wx.request({
      url: url,
      method: method || 'GET',
      header: opt.header || Base.header,
      data: data || {},
      enableCache: opt.cache || false,
      success: (res) => {
        if (res.data.status == 1)
          reslove(res.data, res);
        else
          reject(res.data.msg || '系统错误');
      },
      fail: (msg) => {
        reject(msg || '请求失败');
      }
    })
  });
}

['options', 'get', 'post', 'put', 'head', 'delete', 'trace', 'connect'].forEach((method) => {
  request[method] = (api, data, opt) => request(api, method, data, opt || {})
});