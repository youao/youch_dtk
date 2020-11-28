import {
  formatTime
} from "../../utils/util"

Page({

  data: {
    list: {},
    check: false,
    allChecked: false
  },

  checkAll(){
    let {list, allChecked} = this.data;
    allChecked = !allChecked;
    for (const key in list) {
      if (list.hasOwnProperty(key)) {
        let item = list[key];
        item.forEach((it, i) => {
          it.checked = allChecked;
        })
      }
    }
    this.setData({
      allChecked,
      list
    })
  },

  toadd() {
    wx.navigateTo({
      url: '/pages/task/detail'
    })
  },

  setRowTop() {
    let list = this.data.list;
    let ids = [];
    for (const key in list) {
      if (list.hasOwnProperty(key)) {
        let item = list[key];
        item.forEach((it, i) => {
          if (it.checked) {
            it.is_top = true;
            ids.push(it.id);
          }
        })
      }
    }
    let tlist = wx.getStorageSync('TaskList');
    ids.forEach((item) => {
      tlist[item].is_top = true;
    })
    wx.setStorageSync('TaskList', tlist);
    this.setData({
      check: false
    })
    wx.nextTick(() => {
      this.getList();
    })

  },

  cancelRowTop() {
    let list = this.data.list;
    let ids = [];
    for (const key in list) {
      if (list.hasOwnProperty(key)) {
        let item = list[key];
        item.forEach((it, i) => {
          if (it.checked) {
            it.is_top = true;
            ids.push(it.id);
          }
        })
      }
    }
    let tlist = wx.getStorageSync('TaskList');
    ids.forEach((item) => {
      tlist[item].is_top = false;
    })
    wx.setStorageSync('TaskList', tlist);
    this.setData({
      check: false
    })
    wx.nextTick(() => {
      this.getList();
    })
  },

  delRow() {
    let list = this.data.list;
    let ids = [];
    for (const key in list) {
      if (list.hasOwnProperty(key)) {
        let item = list[key];
        item.forEach((it, i) => {
          if (it.checked) {
            ids.push(it.id);
          }
        })
      }
    }
    let tlist = wx.getStorageSync('TaskList');
    ids.forEach((item) => {
      delete tlist[item]
    })
    wx.setStorageSync('TaskList', tlist);
    this.setData({
      check: false
    })
    wx.nextTick(() => {
      this.getList();
    })

  },

  checkEnd() {
    this.setData({
      check: false
    })
  },

  rowTap(e) {
    const {
      index,
      i,
      id
    } = e.currentTarget.dataset;

    if (this.data.check) {
      let list = this.data.list;
      let check = list[index][i].checked;
      list[index][i].checked = !check;
      this.setData({
        list
      })
    } else {
      wx.navigateTo({
        url: '/pages/task/detail?id=' + id
      })
    }
  },

  rowTouchLong(e) {
    const {
      index,
      i
    } = e.currentTarget.dataset;
    let list = this.data.list;
    list[index][i].checked = true;
    this.setData({
      list,
      check: true
    })
  },

  getList() {
    let tlist = wx.getStorageSync('TaskList');
    let list = {
      'is_top': []
    };
    for (const id in tlist) {
      if (tlist.hasOwnProperty(id)) {
        let item = tlist[id];
        item.id = id;
        item.time = formatTime(item.update_time);
        item.row = formatTime(item.update_time, 'y年m月');
        if (item['is_top']) {
          list['is_top'].push(item)
        } else {
          let key = item.row;
          list[key] = list[key] || [];
          list[key].unshift(item)
        }
      }
    }

    this.setData({
      list
    })
  },

  onShow() {
    let show = this.data.pageShow;
    if (!show) {
      this.setData({
        pageShow: 1
      });
    } else {
      setTimeout(() => {
        this.getList();
      }, 300)
    }
  },

  onLoad: function (options) {

  },

  onReady() {
    this.getList();
  },

  onPullDownRefresh: function () {},

  onReachBottom: function () {},

  onPageScroll(e) {}

})