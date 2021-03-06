import {
  getPddRecommend,
} from '../../api/pdd.js';

Page({

  data: {
    navs: [{
        title: "实时热销",
        img: "/assets/image/icon_bd.png",
        url: '/pages/pdd/channelList?title=实时热销&channel_type=5'
      },
      {
        title: "今日必推",
        img: "/assets/image/icon_tj.png",
        url: '/pages/pdd/channelList?title=今日必推&channel_type=8'
      },
      {
        title: "精选好物",
        img: "/assets/image/icon_jx.png",
        url: '/pages/pdd/channelList?title=精选好物&channel_type=2'
      },
      {
        title: "今日爆品",
        img: "/assets/image/icon_bk.png",
        url: '/pages/pdd/channelList?title=今日爆品&channel_type=1'
      },
      {
        title: "历史低价",
        img: "/assets/image/icon_dj.png",
        url: '/pages/pdd/channelList?title=历史低价&channel_type=0'
      }
    ],
    list: [],
    channel_type: 7,
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

  adJump(e) {
    const {
      url
    } = e.currentTarget.dataset;
    wx.navigateTo({
      url
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

  onPageScroll(e) {
    this.selectComponent("#fixbtn").listenScroll(e)
  }

})