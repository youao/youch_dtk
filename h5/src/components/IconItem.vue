<template>
  <div class="icon" :class="cls" @click="$emit('icon-item-tap')">
    <i v-if="icon" class="iconfont" v-html="icon"></i>
    <img v-else :src="img" alt="" />
    <p>{{ title }}</p>
  </div>
</template>

<script>
import logo from '@/assets/logo.png'
export default {
  name: "IconItem",
  props: {
    title: String,
    icon: String,
    img: {
      type: String,
      default: logo,
    },
    cls: String
  },
  data() {
    return {};
  },
};
</script>

<style scoped>
.icon {
  text-align: center;
}
.icon img,
.icon i.iconfont {
  width: 2.4rem;
  height: 2.4rem;
}
.icon img {
  display: block;
  margin: auto;
}
.icon i.iconfont {
  display: inline-block;
  font-size: 2.4rem;
  line-height: 2.4rem;
  color: inherit;
}
.icon p {
  font-size: 1.2rem;
  color: inherit;
}
</style>
