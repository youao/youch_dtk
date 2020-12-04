<template>
  <div>
    <van-button>按钮</van-button>
    <i class="iconfont">&#xe637;</i>
  </div>
</template>

<script>
import Vue from "vue";
import { Button } from "vant";
Vue.use(Button);

import { getGoodsList } from "@/api/taobao";

export default {
  name: "Home",
  data() {
    return { name: "sass" };
  },
  mounted: function () {
    getGoodsList({ page: 1 }).then((res) => {
      console.log(res);
    });
  },
};
</script>

<style lang="scss" scoped>
</style>
