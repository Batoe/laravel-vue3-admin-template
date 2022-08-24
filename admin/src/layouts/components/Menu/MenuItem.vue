<template>
  <el-menu-item
    :key="item.path"
    :index="item.children ? item.children[0].path : item.path"
    v-if="!item.meta || !isShow"
  >
    <component
      class="menu-icon"
      v-if="item.children ? item.children[0].meta.icon : item.meta.icon"
      theme="outline"
      size="14"
      strokeWidth="3"
      :is="item.children ? item.children[0].meta.icon : item.meta.icon"
    />
    <template #title>
      <span class="title">
        {{ item.children ? item.children[0].meta.title : item.meta.title }}
      </span>
    </template>
  </el-menu-item>
  <el-sub-menu :class="{ 'is-black': isBlack }" :index="item.path" v-else>
    <template #title>
      <component
        class="menu-icon"
        v-if="item.meta.icon"
        theme="outline"
        size="14"
        strokeWidth="3"
        :is="item.meta.icon"
      />
      <span class="title">{{ item.meta.title }}</span>
    </template>
    <template v-for="(option, index) in item.children">
      <menu-item v-if="option.children" :key="option.path" :item="option" />
      <el-menu-item v-else-if="!option.meta.hidden" :index="option.path" :key="index">
        <component
          class="menu-icon"
          v-if="option.meta.icon"
          theme="outline"
          size="14"
          strokeWidth="3"
          :is="option.meta.icon"
        />
        <span class="title">
          {{ option.meta.title }}
        </span>
      </el-menu-item>
    </template>
  </el-sub-menu>
</template>

<script>
  export default {
    name: 'MenuItem',
  };
</script>

<script setup>
  import { computed, defineProps } from 'vue';
  import { useStore } from 'vuex';

  import { themeConfig } from '@/config/theme';
  const { themeOptions } = themeConfig;

  const whiteColors = ['#fff', '#ffffff', '#FFF', '#FFF', 'rgb(255, 255, 255)'];

  const props = defineProps({
    item: {
      type: Object,
      default: () => {
        return {};
      },
    },
  });

  const store = useStore();

  const theme = computed(() => {
    return store.getters['setting/theme'];
  });

  const menuBgColor = computed(() => {
    return themeOptions[theme.value].menuBgColor;
  });

  const isBlack = computed(() => {
    return whiteColors.indexOf(menuBgColor.value) === -1;
  });

  const isShow = computed(() => {
    let item = props.item
    if (item.children) {
      // 所有children都hidden 则隐藏
      let showItem = item.children.filter(e => !e.meta?.hidden)
      return Boolean(showItem.length)
    } else {
      return !item.meta?.hidden
    }
  })
</script>
<style lang="scss" scoped>
  .menu-icon,
  .icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: $base-icon-width-big !important;
    height: 40px !important;
    margin-right: $base-margin-5;
    visibility: initial !important;
  }
</style>
