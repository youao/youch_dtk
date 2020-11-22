import {
  getGoodsDetail
} from '../../api/goods';

Page({

  data: {
    id: '',
    goods: {
      title: '',
      desc: '',
      imgs: [],
    }
  },

  onLoad: function (options) {
    this.setData({
      id: options.id
    })
    getGoodsDetail(options.id).then(res => {
      console.log(res);
      let data = res.data;
      data.imgs = data.imgs ? data.imgs.split(',') : [data.mainPic];
      // detailPics
      data.detailPics = JSON.parse(data.detailPics);
      console.log(data)
      this.setData({
        goods: data
      })
    })
  },

  onReady: function () {

  },

  onPullDownRefresh: function () {

  },

  onReachBottom: function () {

  },

  onShareAppMessage: function () {

  }
})