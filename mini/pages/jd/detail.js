import {
  getJdSkuItem
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
    console.log(goods)
  },

  getCoupon() {
    let gid = this.data.goods.goodsId;
    let tpwd = this.data.coupon.tpwd;
    if (tpwd) {
      return this.copyKongling(tpwd)
    }
    getCouponClickUrl(gid).then(res => {
      this.setData({
        coupon: res.data
      })
      this.copyKongling(res.data.tpwd)
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