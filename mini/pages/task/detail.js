Page({

  data: {
    id: '',
    xin: false,
    title: '',
    html: ''
  },

  setXin() {
    this.setData({
      xin: !this.data.xin
    })
  },

  finished() {
    const {
      title
    } = this.data;
    if (!title) return wx.showToast({
      title: '请先输入标题',
      icon: 'none',
      duration: 1500
    })
    this.save();
    wx.navigateBack();
  },

  save() {
    let that = this;
    this.editorCtx.getContents({
      success(res) {
        that.setData({
          html: res.html
        })
        wx.nextTick(() => {
          let {
            xin,
            title,
            html,
            id
          } = that.data;
          let update_time = new Date().getTime();
          if (!id) {
            id = 'youch_task_' + update_time;
          }
          let list = wx.getStorageSync('TaskList') || {};
          let item = list[id];
          let add_time = item ? item.add_time : update_time;
          list[id] = {
            xin,
            title,
            html,
            update_time,
            add_time
          };
          wx.setStorageSync('TaskList', list);
        })
      }
    })
  },

  formatStyle(e) {
    const {
      name,
      value
    } = e.currentTarget.dataset
    this.editorCtx.format(name, value)
  },

  onEditorReady() {
    wx.createSelectorQuery().select('.editor').context((res) => {
      this.editorCtx = res.context
      if (this.data.html) {
        this.editorCtx.setContents({
          html: this.data.html
        })
      }
    }).exec()
  },

  fn() {},

  onLoad: function (options) {
    if (options.id) {
      let tlist = wx.getStorageSync('TaskList');
      let data = tlist[options.id];
      this.setData({
        id: options.id,
        title: data.title,
        xin: data.xin,
        html: data.html
      })
    }
  },

  onReady: function () {

  },

  onShow: function () {

  },

  onHide: function () {

  },

  onUnload: function () {

  }

})