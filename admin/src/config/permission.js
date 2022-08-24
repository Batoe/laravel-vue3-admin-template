/**
 * @author hujiangjun 1217437592@qq.com
 * @description 路由控制
 */
import router from '@/router';
import store from '@/store';
import NProgress from 'nprogress';
import 'nprogress/nprogress.css';
import { getPageTitle } from '@/utils/index';
import { setting } from '@/config/setting';
const { authentication, loginInterception, progressBar, routesWhiteList, recordRoute } = setting;

NProgress.configure({
  easing: 'ease',
  speed: 500,
  trickleSpeed: 200,
  showSpinner: false,
});

function permission (route, allow) {
  let cur = Array.isArray(route) ? route.shift() : route;
  let index = allow.find(function (el) {
    if (el.path == cur.path) return el;
  })
  if (index) {
    if (route.length && index.children) {
      return permission(route, index.children)
    } else if (route.length && !index.children) {
      return false;
    } else {
      return true;
    }
  } else {
    return false;
  }
}

router.beforeEach(async (to, from, next) => {
  if (progressBar) NProgress.start();

  let hasToken = store.state.user.accessToken;
  if (!loginInterception) hasToken = true;

  if (hasToken) {
    if (to.path === '/login') {
      next({ path: '/' });
      if (progressBar) NProgress.done();
    } else {
      if (store.state.user.username) {
        if (permission(from.matched.length ? from.matched : from, store.state.routes.routes)) {
          next()
        } else {
          next('/401');
        }
      } else {
        try {  
          let permission = await store.dispatch('user/getUserInfo');

          let accessRoutes = [];
          if (authentication === 'intelligence') {
            accessRoutes = await store.dispatch('routes/setRoutes', store.state.user?.permission);
          } else if (authentication === 'all') {
            accessRoutes = await store.dispatch('routes/setAllRoutes');
          }
          accessRoutes.forEach((item) => {
            router.addRoute(item);
          });
          console.log('accessRoutes',accessRoutes)
          if (to.name == '404' || to.name == '401' || to.path == '/') {
            let sroute = sessionStorage.getItem('routeNow')
            sroute = JSON.parse(sroute)
            if (sroute.path) {
              let path = router.getRoutes().find(e => e.path == sroute.path)
              next({...path, replace: true, query: sroute.query})
            } else {
              next({...from, replace: true})
            }
          } else {
            next({ ...to, replace: true });
          }
        } catch (e) {
          console.error('e',e)
          await store.dispatch('user/resetAccessToken');
          if (progressBar) NProgress.done();
        }
      }
    }
  } else {
    // 免登录路由
    if (routesWhiteList.indexOf(to.path) !== -1) {
      next();
    } else {
      if (recordRoute) {
        next(`/login?redirect=${to.path}`);
      } else {
        next('/login');
      }
      if (progressBar) NProgress.done();
    }
  }
  document.title = getPageTitle(to.meta.title);
});
router.afterEach(() => {
  if (progressBar) NProgress.done();
});
