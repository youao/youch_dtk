<template>
  <div class="container" :class="is_pc ? 'pc' : ''">
    <section class="fmix-center-v" style="padding-top: 10rem">
      <h1>
        <span>Welcome to YouCH!</span>
        <a href="//github.com/youao" target="_blank">
          <svg
            style="width: 3rem; height: 3rem"
            viewBox="0 0 16 16"
            aria-hidden="true"
          >
            <path
              fill-rule="evenodd"
              d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"
            ></path>
          </svg>
        </a>
      </h1>
      <div class="flex-wrap navs">
        <a
          v-for="(item, index) in navs"
          :key="index"
          class="nav-con flex-con fmix-center"
          :href="item.url"
          target="_blank"
        >
          <img class="nav-con-img" :src="item.img" />
          <p>{{ item.name }}</p>
        </a>
      </div>
    </section>
    <goods-water-fall-list :list="list" :col="col" />
    <van-loading
      v-show="loading && list.length"
      :class="['fmix-center']"
      :style="{ height: '4rem' }"
      size="24"
      color="#42b983"
    />
    <footer>
      <a
        class="fmix-justify font-gray"
        href="//beian.miit.gov.cn/#/Integrated/recordQuery"
        target="_blank"
      >
        <img
          class="icon-beian"
          src="//img.alicdn.com/tfs/TB1hIher4z1gK0jSZSgXXavwpXa-20-20.png"
        />
        <span>浙ICP备2020043762号-1</span>
      </a>
    </footer>
  </div>
</template>

<script>
import Vue from "vue";
import { Loading } from "vant";
Vue.use(Loading);

import { getGoodsList } from "@/api/taobao";
import GoodsWaterFallList from "@/components/GoodsWaterFallList";
import { isPc, evScrollout } from "@/utils";

export default {
  name: "Home",
  components: {
    GoodsWaterFallList,
  },
  data() {
    return {
      is_pc: false,
      navs: [
        {
          img:
            "//img.alicdn.com/imgextra/i1/2053469401/O1CN01BH8IMC2JJhw1RclDN-2053469401.png",
          name: "实时榜单",
          url: "//jingpage.com/#/fqb?app_key=mzgxuh",
        },
        {
          img:
            "//img.alicdn.com/imgextra/i3/2053469401/O1CN013rRqRD2JJi1zkDclt_!!2053469401.jpg",
          name: "折上折",
          url: "//jingpage.com/#/double?app_key=bfabpq",
        },
        {
          img:
            "//img.alicdn.com/imgextra/i3/2053469401/O1CN01nFoqGa2JJhzSqgsqm_!!2053469401.png",
          name: "限时抢购",
          url: "//jingpage.com/#/ddq?app_key=tgdlxt",
        },
        {
          img:
            "//img.alicdn.com/imgextra/i3/2053469401/O1CN010j8sQS2JJhxFL2HQD_!!2053469401.png",
          name: "9.9精选",
          url: "//jingpage.com/#/nineMail?app_key=equapp",
        },
      ],
      list: [],
      col: 2,
      params: {
        page: 1,
        pageSize: 10,
        tmall: 1,
        cache: 900,
      },
      loading: false,
      finished: false,
    };
  },
  created: function () {
    this.is_pc = isPc();
    this.col = isPc() ? 5 : 2;
  },
  mounted: function () {
    this.getList();
    evScrollout({
      element: ".container",
      callback: this.getList,
    });
  },
  methods: {
    getList() {
      if (this.loading || this.finished) return;
      this.loading = true;
      getGoodsList(this.params).then((res) => {
        let data = res.data || [];
        this.list.push.apply(this.list, data);
        this.loading = false;
        this.finished = data.length < this.params.pageSize;
        this.params.page++;
      });
    },
  },
};
</script>

<style lang="scss" scoped>
.container {
  height: 100%;
  overflow-y: scroll;
}
.pc {
  width: 1000px;
  margin: 0 auto;
}
h1 {
  font-size: 3rem;
  margin-bottom: 2rem;
}
.icon-beian {
  width: 1.6rem;
  height: 1.6rem;
  margin-top: 0.4rem;
  margin-right: 0.4rem;
}
.navs {
  width: 100%;
  padding: 0 1rem;
  box-sizing: border-box;
}
.nav-con {
  padding: 0.8rem;
  margin-right: 0.8rem;
  border-radius: 1rem;
  background: #fff;
  font-size: 1rem;
  box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
}
.nav-con:last-of-type {
  margin-right: 0;
}
.nav-con-img {
  width: 2rem;
  margin-right: 0.4rem;
}
</style>
