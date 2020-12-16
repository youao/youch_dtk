<template>
  <div class="container" :class="is_pc ? 'pc' : ''">
    <van-swipe :autoplay="3000" indicator-color="white">
      <van-swipe-item v-for="(item, index) in goods.imgs" :key="index">
        <img :src="item" />
      </van-swipe-item>
    </van-swipe>

    <div class="row top">
      <div class="cell">
        <span class="font-red"
          >￥<span class="strong">{{ goods.actualPrice }}</span></span
        >
        <span>券后</span>
        <span class="font-gray-tint" style="margin-left: 10px"
          >原价￥{{ goods.originalPrice }}</span
        >
      </div>

      <div class="coupon font-red fmix-align" @click="getCoupon">
        <div class="coupon-val">
          ￥<span class="val">{{ goods.couponPrice }}</span>
        </div>
        <div class="coupon-info">
          <div>优惠券使用期限</div>
          <div class="font-mini">截止{{ goods.couponEndTime }}</div>
        </div>
        <div class="coupon-btn">立即领券</div>
      </div>

      <div class="cell title">{{ goods.title }}</div>
      <div class="cell font-gray-tint" v-html="goods.desc"></div>

      <div v-if="goods.brandId" class="cell">
        <span class="cell-key">品牌</span>
        <span>{{ goods.brandName }}</span>
      </div>
      <div class="cell">
        <span class="cell-key">销量</span>
        <span>月销{{ goods.monthSales }}件</span>
      </div>
    </div>

    <div v-if="goods.shopName" class="row shop fmix-align">
      <div class="shop-img fmix-center">
        <img :src="goods.shopLogo" />
      </div>
      <div class="shop-info flex-con">
        <div class="shop-name">{{ goods.shopName }}</div>
        <div class="fmix-align-sb font-gray">
          <div>描述相符{{ goods.dsrScore }}</div>
          <div>物流服务{{ goods.shipScore }}</div>
          <div>服务态度{{ goods.serviceScore }}</div>
        </div>
      </div>
    </div>

    <div v-if="goods.detailPics" class="row">
      <div class="cell des-title">
        <span class="cell-key">宝贝详情</span>
      </div>
      <img
        v-for="(item, index) in goods.detailPics"
        :key="index"
        :src="item.img"
      />
    </div>

    <div
      class="row fixed-foot fmix-center"
      :class="is_pc ? 'pc' : ''"
      @click="getCoupon"
    >
      立即领券购买
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import { Swipe, SwipeItem } from "vant";
import { getGoodsDetail, getCouponClickUrl } from "@/api/taobao";
import { isPc } from "@/utils";

Vue.use(Swipe);
Vue.use(SwipeItem);

export default {
  name: "TaobaoDetail",
  data() {
    return {
      id: "",
      goods: {
        title: "",
        desc: "",
        imgs: [],
        goodsId: "",
      },
      couponUrl: "",
      is_pc: isPc(),
    };
  },
  mounted: function () {
    let id = this.$route.params.id;
    this.getDetail(id);
  },
  methods: {
    getDetail(id) {
      getGoodsDetail(id).then((res) => {
        let data = res.data;
        data.imgs = data.imgs ? data.imgs.split(",") : [data.mainPic];
        data.detailPics && (data.detailPics = JSON.parse(data.detailPics));
        this.goods = data;
      });
    },

    getCoupon() {
      let gid = this.goods.goodsId;
      if (this.couponUrl) {
        return window.open(this.couponUrl);
      }
      getCouponClickUrl(gid).then((res) => {
        this.couponUrl = res.data.couponClickUrl;
        window.open(this.couponUrl);
      });
    },
  },
};
</script>

<style scoped>
.container {
  padding-bottom: 6rem;
  background: #f5f5f5;
}
.pc {
  max-width: 750px;
  margin: auto;
}
.row {
  background-color: #fff;
  border-radius: 1rem;
  box-shadow: 0 0 0.2rem rgba(0, 0, 0, 0.1);
  margin-bottom: 1rem;
  padding: 1rem 1.5rem;
}

.row.top {
  border-radius: 0 0 1rem 1rem;
}

.cell {
  padding: 0.5rem;
  font-size: 1.2rem;
}

.strong {
  font-size: 2rem;
  font-weight: bold;
  letter-spacing: 0.1rem;
  margin-right: 0.4rem;
}

.title {
  font-size: 1.5rem;
  font-weight: bold;
}

.coupon {
  background-color: #fde9ea;
  margin: 1.5rem 0 1rem;
  padding: 1.2rem 0;
  border-radius: 0.8rem;
  overflow: hidden;
}

.coupon-info {
  flex: 1;
  line-height: 1.6;
}

.coupon-val {
  font-size: 1.6rem;
  font-weight: bold;
  padding: 0 1.5rem;
}

.coupon-val .val {
  font-size: 2.5rem;
}

.coupon-btn {
  position: relative;
  padding: 0 2rem;
}

.coupon-btn::after {
  content: "";
  display: block;
  width: 15rem;
  height: 15rem;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  margin: auto;
  border-radius: 50%;
  border: 1px solid #f5d1d8;
  box-sizing: -0.1rem 0 0.3rem rgba(245, 209, 216, 0.3);
}

.cell-key {
  display: inline-block;
  min-width: 5rem;
  font-weight: bold;
  margin-right: 0.5rem;
}

.des-title {
  font-size: 1.5rem;
  text-align: center;
}

.des-title .cell-key {
  position: relative;
  padding-bottom: 1.5rem;
}

.des-title .cell-key::after {
  content: "";
  height: 0.2rem;
  position: absolute;
  right: 0.6rem;
  bottom: 0.8rem;
  left: 0.6rem;
  background: -webkit-linear-gradient(left, #e83b47, #e8666f 10%, #fdd9db);
}

.shop-img {
  width: 6rem;
  height: 6rem;
  border-radius: 0.4rem;
  margin-right: 1rem;
  overflow: hidden;
}

.shop-img image {
  width: auto;
  height: 100%;
}

.shop-name {
  font-size: 1.5rem;
  font-weight: bold;
  margin-bottom: 1rem;
}

.fixed-foot {
  height: 4.4rem;
  font-size: 1.8rem;
  color: #fff;
  background: #212121;
  position: fixed;
  right: 1.5rem;
  bottom: 0.5rem;
  left: 1.5rem;
  margin: auto;
  box-sizing: border-box;
  z-index: 99;
  border-radius: 2.2rem;
  box-shadow: 0 0.2rem 0.2rem rgba(0, 0, 0, 0.3);
  transition: background 0.5s;
}

.fixed-foot.success {
  background: #00b26a;
}
</style>