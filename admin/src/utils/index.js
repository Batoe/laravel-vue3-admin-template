/**
 * @author hu-snail 1217437592@qq.com
 * @description 常用公共工具函数
 */

import { setting } from '@/config/setting';
const { title } = setting;

export const getPageTitle = (pageTitle) => {
  if (pageTitle) {
    return `${pageTitle}-${title}`;
  }
  return `${title}`;
};

export function deepCopy(obj) {
  if (obj instanceof Object) {
    const newObj = {};
    if (Array.isArray(obj)) {
      const arr = [];
      obj.forEach(item => {
        arr.push(deepCopy(item));
      });
      return arr;
    } else {
      for (const key in obj) {
        const value = obj[key];
        if (typeof value === 'function') {
          newObj[key] = value.bind(newObj);
        } else if (typeof value === 'object') {
          if (Array.isArray(value)) {
            newObj[key] = [];
            value.forEach(item => {
              newObj[key].push(deepCopy(item));
            });
          } else {
            newObj[key] = deepCopy(value);
          }
        } else {
          newObj[key] = value;
        }
      }
    }
    return newObj;
  } else {
    return obj;
  }
}
