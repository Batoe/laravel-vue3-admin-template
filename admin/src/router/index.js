import { createRouter, createWebHashHistory, createWebHistory } from 'vue-router';
import Layout from '@/layouts/index.vue';
import i18n from '@/locales';
const { global } = i18n;
export const constantRoutes = [
  {
    path: '/login',
    name: 'Login',
    component: () => import('@/views/login/index.vue'),
    meta: {
      title: '登录',
    },
    hidden: true,
  },
  {
    path: '/401',
    name: '401',
    component: () => import('@/views/errorPage/401.vue'),
    hidden: true,
  },
  {
    path: '/404',
    name: '404',
    component: () => import('@/views/errorPage/404.vue'),
    hidden: true,
  },
  // {
  //   path: '/:W+',
  //   redirect: '/404',
  //   hidden: true,
  // },
  {
    path: '/',
    component: Layout,
    redirect: '/index',
    name: 'Root',
    children: [
      {
        path: '/index',
        name: 'Index',
        component: () => import('../views/index/index.vue'),
        meta: {
          title: global.t('route.home'),
          icon: 'icon-home',
          affix: true,
          noKeepAlive: true,
        },
      },
    ],
  },
];

export const asyncRoutes = [
  {
    path: '/system',
    component: Layout,
    name: 'system',
    meta: { title: '系统设置', icon: 'icon-setting' },
    redirect: '/system/role',
    children: [
      {
        path: '/system/role',
        name: 'role',
        component: () => import('@/views/system/role.vue'),
        meta: {
          title: '角色管理',
          icon: 'icon-every-user',
        },
      },
      {
        path: '/system/managers',
        name: 'managers',
        component: () => import('@/views/system/manager.vue'),
        meta: {
          title: '人员管理',
          icon: 'icon-peoples',
        },
      },
    ],
  },
  {
    path: '/log',
    component: Layout,
    name: 'log',
    meta: { title: '日志管理', icon: 'icon-log' },
    redirect: '/log/list',
    children: [
      {
        path: '/log/list',
        name: 'list',
        meta: { title: '日志管理', icon: 'icon-log', hidden: true },
        component: () => import('@/views/log/index.vue'),
      },
    ],
  },
  // {
  //   path: '*',
  //   redirect: '/404',
  //   hidden: true,
  // },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes: constantRoutes,
});

// reset router
export function resetRouter() {
  router.getRoutes().forEach((route) => {
    const { name } = route;
    if (name) {
      router.hasRoute(name) && router.removeRoute(name);
    }
  });
}

export default router;
