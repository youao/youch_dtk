const winW = wx.getSystemInfoSync().windowWidth

Component({

  options: {
    addGlobalClass: true // 使用全局样式 app.wxss
  },

  properties: {
    useWaterFalls: {
      type: Boolean,
      value: true
    },
    waterFallsName: {
      type: String,
      value: ''
    },
    propColumn: {
      type: Number,
      value: 2
    },
    containerWidth: {
      type: Number,
      value: 750
    },
    containerSpace: {
      type: Number,
      value: 20
    },
    columnSpace: {
      type: Number,
      value: 20
    },
    propList: {
      type: Array,
      value: []
    }
  },

  data: {
    columnWidth: 0,
    waterFallsColumnsH: [],
    waterFallsHeight: 0,
    positionList: []
  },

  observers: {
    'propList.length': function (list) {
      this.computeItemPosition();
    }
  },

  created: function () {

  },

  ready: function () {
    this.computeColumnWidth();
  },

  methods: {

    computeColumnWidth: function () {
      const {
        propColumn,
        containerWidth,
        containerSpace,
        columnSpace
      } = this.data;
      let columnWidth = (containerWidth - containerSpace * propColumn - (propColumn - 1) * columnSpace) / propColumn;
      this.setData({
        columnWidth
      });
    },

    computeItemPosition: function () {
      const {
        columnSpace,
        propColumn,
      } = this.data;
      let list = [];
      let waterFallsColumnsH = [];
      wx.createSelectorQuery().in(this).selectAll('.goods').boundingClientRect().exec((res) => {
        res[0].forEach((item, index) => {
          let h = (Math.ceil(item.height)) * (this.data.containerWidth / winW) + columnSpace;
          list[index] = {};
          if (index < propColumn) {
            list[index].top = columnSpace;
            list[index].left = this.getWaterFallItemLeft(index);
            waterFallsColumnsH[index] = h;
          } else {
            var i = this.getArrayMinIndex(waterFallsColumnsH);
            list[index].top = waterFallsColumnsH[i] + columnSpace;
            list[index].left = this.getWaterFallItemLeft(i);
            waterFallsColumnsH[i] += h;
          }
        });

        this.setData({
          positionList: list,
          waterFallsHeight: Math.max.apply(null, waterFallsColumnsH) + columnSpace
        })
      });
    },

    getWaterFallItemLeft: function (index) {
      const {
        propColumn,
        columnSpace,
        columnWidth,
        containerSpace
      } = this.data;
      return (index % propColumn) * (columnSpace + columnWidth) + containerSpace;
    },

    getArrayMinIndex: function (arr) {
      let min = arr[0];
      let index = 0;
      for (let i = 1, ln = arr.length; i < ln; i++) {
        if (arr[i] < min) {
          min = arr[i];
          index = i;
        }
      }
      return index;
    },

    toDetail: function (e) {
      const {
        goods_sign,
        search_id
      } = e.currentTarget.dataset.item;

      wx.navigateTo({
        url: '/pages/pdd/detail?goods_sign=' + goods_sign + '&search_id=' + search_id,
      })

    }

  }
})