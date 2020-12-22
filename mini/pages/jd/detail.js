import {
  getJdPromotion
} from '../../api/jd';

Page({

  data: {
    id: '',
    goods: {},
    coupon: {
      tpwd: ''
    }
  },

  onLoad: function (options) {
    const goods = wx.getStorageSync('tmp_jdItem')
    this.setData({
      id: options.id,
      goods
    })
    // console.log(goods)
    wx.nextTick(()=>{
      this.getCoupon();
    })
  },

  getCoupon() {
    // let gid = this.data.goods.goodsId;
    // let tpwd = this.data.coupon.tpwd;
    // if (tpwd) {
    //   return this.copyKongling(tpwd)
    // }
    getJdPromotion(this.data.id).then(res => {
      // this.setData({
      //   coupon: res.data
      // })
      // this.copyKongling(res.data.tpwd)
      // console.log(res)
      let url = res.data.clickUrl;
      let path = 'pages/proxy/union/union?spreadUrl=' + url + '&customerinfo=duoduokeji';
      this.setData({
        path
      })
    })
  },

  copyKongling(kl) {
    wx.setClipboardData({
      data: kl,
      success(res) {
        console.log(res)
      }
    })
  },

  onPullDownRefresh: function () {

  },

  onReachBottom: function () {

  },

  onPageScroll(e) {
    this.selectComponent("#fixbtn").listenScroll(e)
  },

  onShareAppMessage: function () {

  }
})