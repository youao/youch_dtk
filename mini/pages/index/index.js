import {
  getGoodsList
} from '../../api/goods.js';

import {
  getWanNum
} from '../../utils/util.js';

Page({

  data: {
    list: [],
    page: 1,
    loading: false,
    loaded: false,
    arr: [0, 0]
  },

  resetData: function () {
    this.setData({
      list: [],
      page: 1,
      loading: false,
      loaded: false
    });
  },

  getData: function (reload = 0) {
    if (this.data.loading || this.data.loaded) return;
    if (reload == 1) {
      this.resetData();
    }
    this.setData({
      loading: true
    });
    wx.nextTick(() => {
      let page = this.data.page;
      getGoodsList({
        page
      }).then(res => {
        let data = res.data || [];
        data = data.map((item) => {
          item.sales = getWanNum(item.monthSales);
          return item;
        });
        let list = this.data.list;
        list.push.apply(list, data);
        this.setData({
          list,
          loading: false,
          loaded: data.length === 0,
          page: page + 1
        });
      }).catch((err) => {
        this.setData({
          loading: false,
          loaded: true
        });
      })
    })
  },

  onLoad: function (options) {
    this.getData();
  },

  onPullDownRefresh: function () {
    this.getData(1);
  },

  onReachBottom: function () {
    this.getData();
  },

})