const winH = wx.getSystemInfoSync().windowHeight

Component({
  options: {
    addGlobalClass: true // 使用全局样式 app.wxss
  },

  properties: {

  },

  data: {
    show: false,
  },

  methods: {
    toTop() {
      wx.pageScrollTo({
        scrollTop: 0
      })
    },
    listenScroll(e) {
      const {
        show
      } = this.data;
      if (e.scrollTop >= winH && !show) {
        this.setData({
          show: true
        })
      } else if (e.scrollTop < winH && show) {
        this.setData({
          show: false
        })
      }
    }
  },

})