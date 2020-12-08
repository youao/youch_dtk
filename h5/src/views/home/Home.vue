<template>
  <div>
    <goods-water-fall-list :list="list" />
    <van-loading
      v-show="loading && list.length"
      :class="['fmix-center']"
      :style="{ height: '40px' }"
      size="24"
      color="#42b983"
    />
  </div>
</template>

<script>
import Vue from "vue";
import { Loading } from "vant";
Vue.use(Loading);

import { getGoodsList } from "@/api/taobao";
import GoodsWaterFallList from "@/components/GoodsWaterFallList";
import { evScrollout } from "@/utils";

export default {
  name: "Home",
  components: {
    GoodsWaterFallList,
  },
  data() {
    return {
      list: [],
      params: {
        page: 1,
        pageSize: 10,
        tmall: 1,
        cache: 900
      },
      loading: false,
      finished: false,
    };
  },
  mounted: function () {
    this.getList();
    evScrollout(this.getList);
  },
  methods: {
    getList() {
      if (this.loading || this.finished) return;
      this.loading = true;
      getGoodsList(this.params).then((res) => {
        console.log(res);
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
</style>
