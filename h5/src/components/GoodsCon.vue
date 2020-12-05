

<template>
  <div class="goods">
    <div class="goods-img">
      <img :src="item.marketingMainPic || item.mainPic" alt="" />
      <i v-if="item.video" class="iconfont v-play">&#xe614;</i>
    </div>
    <div class="goods-info">
      <div class="goods-title ellipsis-2">
        <span
          v-if="item.shopType == 1"
          class="iconfont tmall"
        >&#xe799;</span>
        {{ item.dtitle }}
      </div>
      <div v-if="item.brandId" class="goods-row">
        品牌：{{ item.brandName }}
      </div>
      <div class="goods-row font-red fmix-align">
        券后￥<span class="goods-priceval">{{ item.actualPrice }}</span>
        <div class="goods-quan-box" v-if="item.couponPrice">
          <span class="goods-quan-dot"></span>
          <div class="goods-quan">
            <span>{{ item.couponPrice }}元券</span>
          </div>
          <span class="goods-quan-dot right"></span>
        </div>
      </div>
      <div class="goods-row">
        <i
          v-if="item.activityType == 2"
          class="iconfont tqg"
        >&#xe608;</i>
        <i
          v-else-if="item.activityType == 3"
          class="iconfont jhs"
        >&#xe609;</i>
        <span class="goods-tip" v-if="item.freeshipRemoteDistrict"
          >偏远包邮</span
        >
        <span class="sale" style="display: inline-block"
          >{{ item.monthSales }}人已付款</span
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "GoodsCon",
  components: {},
  props: {
    item: Object,
  },
  data() {
    return {};
  },
  methods: {},
};
</script>

<style lang="scss" scoped>
.goods {
  width: 150px;
  border-radius: 10px;
  overflow: hidden;
  background-color: $white;
  /* opacity: 0;
  z-index: -1; */
  transition: top 0.5s, opacity 0.5s, zIndex 0.5s;
  box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
}

.goods-img {
  width: 100%;
  overflow: hidden;
  position: relative;
}

.v-play {
  width: 50px;
  height: 50px;
  @include posiMagin;
  background-color: rgba(0, 0, 0, 0.5);
  border-radius: 50%;
  color: $white;
  font-size: 22px;
  line-height: 50px;
  text-align: center;
}

.goods-info {
  padding: 6px 3px 3px 6px;
}

.goods-title {
  margin-bottom: 6px;
}

.goods-tip {
  display: inline-block;
  font-size: 10px;
  line-height: 16px;
  color: #acacac;
  background-color: #f5f5f5;
  border-radius: 4px;
  border: 1px solid $gray-light;
  padding: 5px;
  margin-right: 5px;
}

.goods-quan-box {
  position: relative;
  overflow: hidden;
  margin-right: 5px;
}

.goods-quan {
  font-size: 10px;
  line-height: 1.5;
  color: $red;
  background-color: #fde9ea;
  border-radius: 3px;
  box-sizing: border-box;
  padding: 0 8px;
}

.goods-quan-dot {
  color: inherit;
  display: inline-block;
  width: 6px;
  height: 6px;
  border-radius: 50%;
  position: absolute;
  top: 0;
  bottom: 0;
  margin: auto;
  left: -3px;
  background: $white;
}

.goods-quan-dot.right {
  right: -3px;
  left: auto;
}

.goods-row {
  font-size: 12px;
  padding-bottom: 6px;
}

.goods-priceval {
  font-size: 18px;
  margin-right: 5px;
}

.iconfont.tqg,
.iconfont.jhs {
  margin-right: 4px;
  font-size: 1.4em;
}

.sale {
    color: $gray-tint;
}
</style>
