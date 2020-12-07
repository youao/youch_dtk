<template>
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
</template>

<script>
import GoodsCon from "@/components/GoodsCon";

export default {
  name: "GoodsWaterFallList",
  components: {
    GoodsCon,
  },
  props: {
    list: Array,
  },
  data() {
    return {
      colHs: [],
      col: 2,
      space: 10,
      spaceBetween: 10,
      colW: 0,
    };
  },
  computed: {
    wfHeight() {
      return Math.max.apply(null, this.colHs) + this.space;
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
      // this.$nextTick(() => {
      //   this.computeItemPosition(ln, oln);
      // });
      setTimeout(()=>{
        this.computeItemPosition(ln, oln);
      }, 500)
    },
  },
  mounted: function () {},
  methods: {
    computeItemPosition: function (ln, oln) {
      let { col, space, spaceBetween, colW, list, colHs } = this;
      let els = document.getElementsByClassName("goods");

      for (let i = oln; i < ln; i++) {
        let o = els[i].offsetHeight;
        let h = o + space;

        if (i < col) {
          list[i].top = space;
          list[i].left = this.getWaterFallItemLeft(i);
          colHs[i] = h;
          this.$set(this.colHs, i, h);
        } else {
          var index = this.getArrayMinIndex(colHs);
          list[i].top = colHs[index] + space;
          list[i].left = this.getWaterFallItemLeft(index);
          colHs[index] += h;
          this.$set(this.colHs, index, colHs[index]);
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
