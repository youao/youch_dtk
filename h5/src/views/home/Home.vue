<template>
  <div>
    <van-button>按钮</van-button>
    <div class="waterfall" :style="{ height: wfHeight + 'px' }">
      <goods-con
        v-for="(item, index) in list"
        :key="index"
        :item="item"
        :class="item.top ? 'show' : 'hide'"
        :style="{
          width: colW + 'px',
          top: item.top ? item.top + 'px' : '100%',
          left: item.left ? item.left + 'px' : '0',
        }"
      ></goods-con>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import { Button } from "vant";
Vue.use(Button);

import { getGoodsList } from "@/api/taobao";
import GoodsCon from "@/components/GoodsCon";

export default {
  name: "Home",
  components: {
    GoodsCon,
  },
  data() {
    return {
      list: [],
      wflist: [],
      col: 2,
      space: 10,
      spaceBetween: 10,
      colW: 0,
    };
  },
  computed: {
    wfHeight() {
      console.log(this.wflist);
      return Math.max.apply(null, this.wflist) + this.space;
    },
  },
  created: function () {
    let container = document.getElementsByClassName("waterfall")[0];
    let conW = (container || document.body).offsetWidth;
    const { col, space, spaceBetween } = this;
    this.colW = (conW - spaceBetween * col - (col - 1) * space) / col;
  },
  watch: {
    "list.length": function (ln, oln) {
      this.$nextTick(() => {
        this.computeItemPosition(ln, oln);
      });
    },
  },
  mounted: function () {
    getGoodsList({ page: 1 }).then((res) => {
      console.log(res);
      this.list = res.data;
    });
  },
  methods: {
    computeItemPosition: function (ln, oln) {
      let { col, space, spaceBetween, colW, list, wflist } = this;
      let els = document.getElementsByClassName("goods");

      for (let i = oln; i < ln; i++) {
        let o = els[i].offsetHeight;
        let h = o + space;
        list[i].left = this.getWaterFallItemLeft(i);

        if (i < col) {
          list[i].top = space;
          wflist[i] = h;
          this.$set(this.wflist, i, h);
        } else {
          var index = this.getArrayMinIndex(wflist);
          list[i].top = wflist[index] + space;
          wflist[index] += h;
          this.$set(this.wflist, index, wflist[index]);
        }
        this.$set(this.list, i, list[i]);
      }
    },

    getWaterFallItemLeft: function (index) {
      const { col, colW, space, spaceBetween } = this;
      return (index % col) * (space + colW) + spaceBetween;
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
  },
};
</script>

<style lang="scss" scoped>
.waterfall {
  position: relative;
}
.show {
  position: absolute;
  opacity: 1;
}
.hide {
  position: absolute;
  top: 100%;
  opacity: 0;
}
</style>
