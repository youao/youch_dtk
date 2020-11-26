const app = getApp()
const winW = wx.getSystemInfoSync().windowWidth

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
    }],
    showCategory: 1,
    category: [],
    categoryUlW: 2000,
    categoryLeft: 0,
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
    const {
      offsetLeft,
      dataset
    } = e.currentTarget
    const {
      cid
    } = dataset;
    let categoryLeft = offsetLeft - (winW / 2 - 30);
    this.setData({
      cid,
      categoryLeft
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
      loaded
    } = this.data;
    if (loading || loaded) return;
    if (reload == 1) {
      this.resetData();
    }
    this.setData({
      loading: true
    });
    wx.nextTick(() => {
      let {
        page,
        cid,
        rankType,
        showCategory
      } = this.data;
      getRankList({
        page,
        cid: showCategory?cid:'',
        rankType
      }).then(res => {
        let data = res.data || [];
        this.setListData(data)
        wx.stopPullDownRefresh()
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
      const query = wx.createSelectorQuery()
      query.selectAll('.category').boundingClientRect()
      query.exec(res => {
        let w = 0;
        res[0].forEach(item => {
          w += item.width * 750 / winW + 30;
        })
        this.setData({
          categoryUlW: w
        })
      })
    })
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

  onPageScroll(e){
    this.selectComponent("#fixbtn").listenScroll(e)
  }

})