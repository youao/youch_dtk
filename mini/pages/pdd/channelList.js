import {
  getPddRecommend
} from '../../api/pdd.js';

Page({

  data: {
    list: [],
    channel_type: 0,
    page: 1,
    pageSize: 20,
    loading: false,
    loaded: false,
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
        channel_type,
        page,
        pageSize
      } = this.data;
      getPddRecommend({
        channel_type,
        page,
        pageSize
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

  onLoad: function (options) {
    const {
      title,
      channel_type
    } = options;
    wx.setNavigationBarTitle({
      title,
    })
    this.setData({
      channel_type
    })
    wx.nextTick(() => {
      this.getData();
    })
  },

  onPullDownRefresh: function () {
    this.getData(1);
  },

  onReachBottom: function () {
    this.getData();
  },

  onPageScroll(e) {
    this.selectComponent("#fixbtn").listenScroll(e)
  }

})