<template>
  <el-config-provider :locale="localLanguage" :zIndex="2000">
    <el-scrollbar height="100vh" ref="scroll">
      <router-view></router-view>
    </el-scrollbar>
  </el-config-provider>
</template>

<script setup>
import { onMounted, computed, ref, watch } from 'vue';
import { useStore } from 'vuex';

import i18n from '@/locales';
import { useRouter } from 'vue-router';
const locale = i18n.global.locale;

const store = useStore();

const localLanguage = computed(() => {
  const isDev = process.env.NODE_ENV === 'development';
  if (isDev) return i18n.global.messages.value[locale.value];
  else return i18n.global.messages[locale];
});

const scroll = ref(null);

const router = useRouter();
onMounted(() => {
  changeBodyWidth();
  window.addEventListener('resize', changeResize);
  // router.push({path: sessionStorage.getItem('routeNow')})
  // router.push(sessionStorage.getItem('routeNow'))
  // console.log('router',router)
});

watch(
  () => router.currentRoute.value,
  (r) => {
    scroll.value.setScrollTop(0);
    sessionStorage.setItem('routeNow', JSON.stringify(r))
  }
);

const changeBodyWidth = () => {
  const flag = document.body.getBoundingClientRect().width - 1 < 992;
  store.dispatch('setting/changeMobile', flag);
};

const changeResize = () => {
  changeBodyWidth();
};
</script>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  font-size: $base-font-size-default;
  color: #2c3e50;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;

  .app-container {
    padding: $base-main-padding;
    background-color: $base-color-white;

    .pagination {
      margin-top: 16px;
      margin-bottom: 46px;

      .el-pagination {
        display: inline-flex;
        float: right;
      }

      .el-pagination .el-select .el-input {
        line-height: 32px;
        height: 32px;
      }
    }

    .el-table .el-table__header th.el-table__cell {
      background-color: #f5f5f5;
      color: #747d8c;
    }
  }
}
</style>
