import {
  getJdJingfen,
} from '../../api/jd.js';

Page({

  data: {
    navs: [{
        title: "实时热销",
        img: "/assets/image/icon_bd.png",
        url: '/pages/jd/eliteList?title=实时热销&eliteId=22'
      },
      {
        title: "今日必推",
        img: "/assets/image/icon_tj.png",
        url: '/pages/jd/eliteList?title=今日必推&eliteId=31'
      },
      {
        title: "精选好物",
        img: "/assets/image/icon_jx.png",
        url: '/pages/jd/eliteList?title=精选好物&eliteId=32'
      },
      {
        title: "京东爆品",
        img: "/assets/image/icon_bk.png",
        url: '/pages/jd/eliteList?title=实时热销&eliteId=112'
      },
      {
        title: "历史低价",
        img: "/assets/image/icon_dj.png",
        url: '/pages/jd/eliteList?title=历史低价&eliteId=153'
      }
    ],
    list: [],
    eliteId: 23,
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
        eliteId,
        page,
        pageSize
      } = this.data;
      getJdJingfen({
        eliteId,
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