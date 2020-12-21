import {
  getPddDetail,
  getPddPromotion
} from '../../api/pdd';

import {
  formatTime
} from '../../utils/util';

Page({

  data: {
    id: '',
    goods: {},
    we_app_info: {
      app_id: '',
      page_path: ''
    }
  },

  onLoad: function (options) {
    const {
      goods_sign,
      search_id
    } = options;
    getPddDetail({
      goods_sign,
      search_id
    }).then(res => {
      let goods = res.data;
      if (goods.has_coupon) {
        goods.coupon_end_time_str = formatTime(goods.coupon_end_time*1000);
      }
      this.setData({
        goods_sign,
        search_id,
        goods
      })
      wx.nextTick(() => {
        this.getCoupon();
      })
    })

  },

  getCoupon() {
    const {
      goods_sign,
      search_id
    } = this.data;

    getPddPromotion({
      search_id,
      goods_sign,
      is_we_app: 1
    }).then(res => {
      this.setData({
        we_app_info: res.data.we_app_info
      })
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