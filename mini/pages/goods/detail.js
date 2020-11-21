import {getGoodsDetail} from '../../api/goods';

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
    getGoodsDetail(options.id).then(res=>{
      console.log(res)
      let data = res.data;
      let imgs = data.imgs;
      data.imgs = imgs.split(',');
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