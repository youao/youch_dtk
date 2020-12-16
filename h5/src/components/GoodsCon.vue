<template>
  <router-link :to="'/taobao/detail/'+item.id" class="goods">
    <div class="goods-img">
      <img :src="item.marketingMainPic || item.mainPic" alt="" />
      <i v-if="item.video" class="iconfont v-play">&#xe614;</i>
    </div>
    <div class="goods-info">
      <div class="goods-title ellipsis-2">
        <span v-if="item.shopType == 1" class="iconfont tmall">&#xe799;</span>
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
        <i v-if="item.activityType == 2" class="iconfont tqg">&#xe608;</i>
        <i v-else-if="item.activityType == 3" class="iconfont jhs">&#xe609;</i>
        <span class="goods-tip" v-if="item.freeshipRemoteDistrict"
          >偏远包邮</span
        >
        <span class="sale" style="display: inline-block"
          >{{ item.monthSales }}人已付款</span
        >
      </div>
    </div>
  </router-link>
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
  methods: {

  },
};
</script>

<style lang="scss" scoped>
.goods {
  width: 15rem;
  border-radius: 1rem;
  overflow: hidden;
  background-color: $white;
  box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
}

.goods-img {
  width: 100%;
  overflow: hidden;
  position: relative;
}

.v-play {
  width: 5rem;
  height: 5rem;
  @include posiMagin;
  background-color: rgba(0, 0, 0, 0.5);
  border-radius: 50%;
  color: $white;
  font-size: 2.2rem;
  line-height: 5rem;
  text-align: center;
}

.goods-info {
  padding: 0.6rem 0.3rem 0.3rem 0.6rem;
}

.goods-title {
  margin-bottom: 0.6rem;
}

.goods-tip {
  display: inline-block;
  font-size: 1rem;
  line-height: 1.6rem;
  color: #acacac;
  background-color: #f5f5f5;
  border-radius: 0.4rem;
  border: 1px solid $gray-light;
  padding: 0.5rem;
  margin-right: 0.5rem;
}

.goods-quan-box {
  position: relative;
  overflow: hidden;
  margin-right: 0.5rem;
}

.goods-quan {
  font-size: 1rem;
  line-height: 1.5;
  color: $red;
  background-color: #fde9ea;
  border-radius: 0.3rem;
  box-sizing: border-box;
  padding: 0 0.8rem;
}

.goods-quan-dot {
  color: inherit;
  display: inline-block;
  width: 0.6rem;
  height: 0.6rem;
  border-radius: 50%;
  position: absolute;
  top: 0;
  bottom: 0;
  margin: auto;
  left: -0.3rem;
  background: $white;
}

.goods-quan-dot.right {
  right: -0.3rem;
  left: auto;
}

.goods-row {
  font-size: 1.2rem;
  padding-bottom: 0.6rem;
}

.goods-priceval {
  font-size: 1.8rem;
  margin-right: 0.5rem;
}

.iconfont.tqg,
.iconfont.jhs {
  margin-right: 0.4rem;
  font-size: 1.4em;
}
.iconfont.tqg {
  color: $tqg;
}
.iconfont.jhs {
  color: $jhs;
}
.iconfont.tmall {
  color: $tmall;
}

.sale {
  color: $gray-tint;
}
</style>
