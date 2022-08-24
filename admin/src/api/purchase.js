import request from '@/utils/request.js';

export const savePurchase = (data) => {
  return request({
    url: '/purchase/save',
    method: 'post',
    data
  })
}

export const getPurchase = (params) => {
  return request({
    url: '/purchase/' + params.code,
    method: 'get',
  })
}

export const deletePurchase = (data) => {
  return request({
    url: '/purchase/' + data.code,
    method: 'delete'
  })
}

export const getPurchaseList = (params) => {
  return request({
    url: '/purchase/list',
    method: 'get',
    params
  })
}

export const batchDeletePurchase = (data) => {
  return request({
    url: '/purchase/batch/delete',
    method: 'post',
    data
  })
}

export const auditPurchase = (data) => {
  return request({
    url: '/purchase/audit/' + data.code,
    method: 'post',
    data
  })
}

export const cancelAuditPurchase = (data) => {
  return request({
    url: '/purchase/cancelAudit/' + data.code,
    method: 'post'
  })
}

export const batchAuditPurchase = (data) => {
  return request({
    url: '/purchase/batchAudit',
    method: 'post',
    data
  })
}