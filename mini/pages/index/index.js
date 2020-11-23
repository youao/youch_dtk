const app = getApp()

import {
  getRankList,
  getCategory,
} from '../../api/goods.js';

import {
  getWanNum
} from '../../utils/util.js';

Page({

  data: {
    navs: [{
      type: 1,
      title: '实时榜',
      showCategory: 1
    }, {
      type: 2,
      title: '全天榜',
      showCategory: 1
    }, {
      type: 3,
      title: '热推榜',
      showCategory: 0
    }, {
      type: 4,
      title: '复购榜',
      showCategory: 0
    }, {
      type: 7,
      title: '热搜榜',
      showCategory: 0
    }],
    showCategory: 1,
    category: [],
    cid: '',
    list: [],
    rankType: 1,
    page: 1,
    loading: false,
    loaded: false,
  },

  switchNav(e) {
    let datas = e.currentTarget.dataset;
    let {
      type,
      showCategory
    } = this.data.navs[datas.index];
    this.setData({
      rankType: type,
      showCategory
    })
    this.getData(1)
  },

  switchCategory(e) {
    let datas = e.currentTarget.dataset;
    const {
      cid
    } = datas;
    this.setData({
      cid
    })
    this.getData(1)
  },

  resetData() {
    this.setData({
      list: [],
      page: 1,
      loading: false,
      loaded: false
    });
  },

  getData: function (reload = 0) {
    let {
      loading,
      loaded,
      page,
      cid,
      rankType
    } = this.data;
    if (loading || loaded) return;
    if (reload == 1) {
      this.resetData();
    }
    this.setData({
      loading: true
    });
    wx.nextTick(() => {
      getRankList({
        page,
        cid,
        rankType
      }).then(res => {
        let data = res.data || [];
        this.setListData(data)
      }).catch((err) => {
        this.setData({
          loading: false,
          loaded: true
        })
      })
    })
  },

  setListData(data) {
    data = data.map((item) => {
      item.sales = getWanNum(item.monthSales);
      return item;
    });
    let {
      list,
      page
    } = this.data;
    list.push.apply(list, data);
    this.setData({
      list: list,
      loading: false,
      loaded: data.length === 0,
      page: page + 1
    });
  },

  initList(category) {
    this.setData({
      category,
      cid: category[0].cid
    });
    wx.nextTick(() => {
      this.getData();
    })
  },

  onLoad: function (options) {
    let category = app.globalData.category;
    if (!category) {
      getCategory().then(res => {
        app.globalData.category = res.data;
        this.initList(res.data)
      })
    } else {
      this.initList(category)
    }
  },

  onPullDownRefresh: function () {
    this.getData(1);
  },

  onReachBottom: function () {
    this.getData();
  },

})