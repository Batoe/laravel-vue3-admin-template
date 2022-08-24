import request from '@/utils/request.js';

export const saveSale = (data) => {
  return request({
    url: '/sale/save',
    method: 'post',
    data
  })
}

export const getSale = (params) => {
  return request({
    url: '/sale/' + params.code,
    method: 'get',
  })
}

export const deleteSale = (data) => {
  return request({
    url: '/sale/' + data.code,
    method: 'delete'
  })
}

export const getSaleList = (params) => {
  return request({
    url: '/sale/list',
    method: 'get',
    params
  })
}

export const batchDeleteSale = (data) => {
  return request({
    url: '/sale/batch/delete',
    method: 'post',
    data
  })
}

export const auditSale = (data) => {
  return request({
    url: '/sale/audit/' + data.code,
    method: 'post',
    data
  })
}

export const cancelAuditSale = (data) => {
  return request({
    url: '/sale/cancelAudit/' + data.code,
    method: 'post'
  })
}

export const batchAuditSale = (data) => {
  return request({
    url: '/sale/batchAudit',
    method: 'post',
    data
  })
}

export const statement = (code) => {
  return request({
    url: '/sale/statement/' + code,
    method: 'post'
  })
}

export const getStatementList = (params) => {
  return request({
    url: '/sale/statement/list',
    method: 'get',
    params
  })
}