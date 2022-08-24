import request from '@/utils/request.js';
export const getResouceList = () => {
  return request({
    url: '/getResouceList',
    method: 'get',
  });
};


export const upload = (data) => {
  return request({
    url: '/common/upload',
    method: 'post',
    data
  });
}

export const getDelivery = (data) => {
  return request({
    url: '/common/delivery',
    method: 'get',
    data
  });
}

export const getCustomer = (data) => {
  return request({
    url: '/common/customer',
    method: 'get',
    data
  });
}

export const getWarehouse = (data) => {
  return request({
    url: '/common/warehouse',
    method: 'get',
    data
  });
}

export const getProduct = (data) => {
  return request({
    url: '/common/product',
    method: 'get',
    data
  });
}

export const getCode = (params) => {
  return request({
    url: '/common/code',
    method: 'get',
    params
  });
}

export const getLog = (data) => {
  return request({
    url: '/log/list',
    method: 'post',
    data
  });
}

export const getBill = (data) => {
  return request({
    url: '/common/bill',
    method: 'post',
    data
  })
}