import request from '@/utils/request.js';

export const getAllPermission = () => {
  return request({
    url: '/system/permission/all',
    method: 'get',
  });
};

export const getRole = () => {
  return request({
    url: '/system/role',
    method: 'get',
  });
};

export const saveRole = (data) => {
  return request({
    url: '/system/role',
    method: 'post',
    data,
  });
};

export const deleteRole = ({ id }) => {
  return request({
    url: '/system/role/' + id,
    method: 'delete',
  });
};

export const getManager = (params) => {
  return request({
    url: '/system/manager',
    method: 'get',
    params,
  });
};

export const saveManager = (data) => {
  return request({
    url: '/system/manager',
    method: 'post',
    data,
  });
};

export const deleteManager = ({ id }) => {
  return request({
    url: '/system/manager/' + id,
    method: 'delete',
  });
};

export const pullBlack = (data) => {
  return request({
    url: '/system/manager/' + data.id,
    method: 'post',
    data,
  });
};

export const getProduct = (params) => {
  return request({
    url: '/system/product',
    method: 'get',
    params,
  });
};

export const saveProduct = (data) => {
  return request({
    url: '/system/product',
    method: 'post',
    data,
  });
};

export const deleteProduct = ({ id }) => {
  return request({
    url: '/system/product/' + id,
    method: 'delete',
  });
};

export const getWareHouse = (params) => {
  return request({
    url: '/system/warehouse',
    method: 'get',
    params,
  });
};

export const saveWareHouse = (data) => {
  return request({
    url: '/system/warehouse',
    method: 'post',
    data,
  });
};

export const deleteWareHouse = ({ id }) => {
  return request({
    url: '/system/warehouse/' + id,
    method: 'delete',
  });
};

export const getCompany = (params) => {
  return request({
    url: '/system/company',
    method: 'get',
    params,
  });
};

export const saveCompany = (data) => {
  return request({
    url: '/system/company',
    method: 'post',
    data,
  });
};

export const deleteCompany = ({ id }) => {
  return request({
    url: '/system/company/' + id,
    method: 'delete',
  });
};