<template>
  <div class="footer font-weak fmix-align-sa">
    <icon-item
      v-for="(item, index) in navs"
      :key="index"
      :icon="item.icon"
      :title="item.title"
      :cls="item.path == active ? 'font-theme' : ''"
      @icon-item-tap="tapIcon(index)"
    />
  </div>
</template>

<script>
import IconItem from "@/components/IconItem";
import app from '../config';

export default {
  name: "FooterNav",
  components: {
    IconItem,
  },
  data() {
    return {
      active: 0,
      navs: app.footer,
    };
  },
  watch: {
    $route(to, from) {
      this.active = to.path;
    }
  },
  methods: {
    tapIcon(e) {
      let url = this.navs[e].path;
      url && this.$router.push(url);
    },
  },
};
</script>

<style scoped>
.footer {
  border-top: 1px solid #eee;
  height: 50px;
}
</style>
