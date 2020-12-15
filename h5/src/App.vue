<template>
  <div id="app" class="fmix-v">
    <div id="main" class="flex-con">
      <router-view />
    </div>
    <FooterNav v-show="footerShow" />
  </div>
</template>

<script>
import FooterNav from "@/components/FooterNav";
export default {
  name: "App",
  components: {
    FooterNav,
  },
  data() {
    return {
      footerShow: false,
    };
  },
  watch: {
    $route(to) {
      const { footer } = to.meta;
      this.footerShow = footer;
    },
  },
};
</script>

<style>
  #app {
    height: 100vh;
    position: relative;
  }
  #main {
    overflow-y: scroll;
  }
</style>
