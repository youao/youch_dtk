import {
  getGoodsDetail,
  getCouponClickUrl
} from '../../api/goods';

Page({

  data: {
    id: '',
    goods: {
      title: '',
      desc: '',
      imgs: [],
      goodsId: '',
    },
    coupon: {
      tpwd: ''
    }
  },

  onLoad: function (options) {
    this.setData({
      id: options.id
    })
    this.getDetail(options.id)
  },

  getDetail(id) {
    getGoodsDetail(id).then(res => {
      console.log(res);
      let data = res.data;
      data.imgs = data.imgs ? data.imgs.split(',') : [data.mainPic];
      data.detailPics && (data.detailPics = JSON.parse(data.detailPics));
      this.setData({
        goods: data
      })
    })
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

  onShareAppMessage: function () {

  }
})