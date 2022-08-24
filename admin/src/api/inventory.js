import request from '@/utils/request.js';

export const getWarehousingList = (params) => {
  return request({
    url: '/inventory/warehosing/list',
    method: 'get',
    params
  })
}

export const getWarehousing = (params) => {
  return request({
    url: '/inventory/warehosing/' + params.code,
    method: 'get',
  })
}

export const deleteWarehousing = (data) => {
  return request({
    url: '/inventory/warehosing/delete/' + data.code,
    method: 'delete'
  })
}

export const saveWarehousing = (data) => {
  return request({
    url: '/inventory/warehosing',
    method: 'post',
    data
  })
}

export const auditWarehousing = (data) => {
  return request({
    url: '/inventory/warehosing/audit/' + data.code,
    method: 'put'
  })
}

export const cancelAuditWarehousing = (data) => {
  return request({
    url: '/inventory/warehosing/cancelAudit/' + data.code,
    method: 'post'
  })
}

export const batchDeleteWarehousing = (data) => {
  return request({
    url: '/inventory/warehosing/batchDelete',
    method: 'delete',
    data
  })
}

export const batchAuditWarehousing = (data) => {
  return request({
    url: '/inventory/warehosing/batchAudit',
    method: 'post',
    data
  })
}

// ============================================================================================================================ //

export const getOutboundList = (params) => {
  return request({
    url: '/inventory/outbound/list',
    method: 'get',
    params
  })
}


export const getOutbound = (params) => {
  return request({
    url: '/inventory/outbound/' + params.code,
    method: 'get',
  })
}

export const deleteOutbound = (data) => {
  return request({
    url: '/inventory/outbound/delete/' + data.code,
    method: 'delete'
  })
}

export const saveOutbound = (data) => {
  return request({
    url: '/inventory/outbound',
    method: 'post',
    data
  })
}

export const auditOutbound = (data) => {
  return request({
    url: '/inventory/outbound/audit/' + data.code,
    method: 'put'
  })
}

export const cancelAuditOutbound = (data) => {
  return request({
    url: '/inventory/outbound/cancelAudit/' + data.code,
    method: 'post'
  })
}

export const batchDeleteOutbound = (data) => {
  return request({
    url: '/inventory/outbound/batchDelete',
    method: 'delete',
    data
  })
}

export const batchAuditOutbound = (data) => {
  return request({
    url: '/inventory/outbound/batchAudit',
    method: 'post',
    data
  })
}

// ============================================================================================================================ //

export const getInventory = (data) => {
  return request({
    url: '/inventory/list',
    method: 'post',
    data
  })
}

export const finishing = () => {
  return request({
    url: '/inventory/finishing',
    method: 'get'
  })
}