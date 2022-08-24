<template>
  <div v-if="store.getters['setting/routerView']" class="app-main-container">
    <router-view class="app-main-height" v-slot="{ Component }">
      <component :is="Component" v-if="$route.meta.noKeepAlive" :key="$route.name"  />
      <keep-alive>
        <component :is="Component" v-if="!$route.meta.noKeepAlive" :key="$route.name"  />
      </keep-alive>
    </router-view>
    <footer class="footer-copyright">{{ copyrightStr }}</footer>
  </div>
</template>

<script>
export default {
  name: "AppMain",
};
</script>

<script setup>
import { ref } from "vue";
import { useStore } from "vuex";
import { setting } from "@/config/setting";
const { copyright } = setting;

const copyrightStr = ref(copyright);
const store = useStore();
</script>

<style lang="scss" scoped>
.app-main-container {
  position: relative;
  box-sizing: border-box;
  width: $base-width;
  overflow: hidden;
  text-align: left;
  .app-main-height {
    min-height: $app-main-min-height;
  }
  .footer-copyright {
    min-height: $footer-copyright-height;
    line-height: $footer-copyright-height;
    color: $base-color-3;
    text-align: center;
    border-top: 1px dashed $base-border-color;
  }

  .fade-enter-active,
  .fade-leave-active {
    transform: translateX(100%);
    transition: all 20s ease;
  }

  .fade-enter-from,
  .fade-leave-to {
    opacity: 0;
  }

  // .threefade-enter {
  //   opacity: 0;
  //   transform: translateX(-100%);
  // }
  // .threefade-leave-to {
  //   opacity: 0;
  //   transform: translateX(100%);
  // }
  // .threefade-enter-active {
  //   opacity: 1;
  //   transition: all 0s;
  //   position: absolute;
  //   z-index: 2;
  // }
  // .threefade-leave-active {
  //   transition: all 3s;
  //   position: absolute;
  //   z-index: 999;
  //   height: 100%;
  // }
}
</style>
