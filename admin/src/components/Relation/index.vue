<template>
  <el-drawer v-model="drawer" title="关联单据" direction="rtl" size="30%">
    <el-collapse>
      <el-collapse-item title="销售单" name="1">
        <el-table :data="table.sale" border>
          <el-table-column label="销售单号" prop="code">
            <template #default="{ row }">
              <router-link :to="'/sale/post?type=check&code=' + row.code">{{ row.code }}</router-link>
            </template>
          </el-table-column>
          <el-table-column label="下单日期" prop="sale_time" />
          <el-table-column label="销货客户" prop="company.name" />
        </el-table>
      </el-collapse-item>
      <el-collapse-item title="采购单" name="2">
        <el-table :data="table.purchase" border>
          <el-table-column label="采购单号" prop="code">
            <template #default="{ row }">
              <router-link :to="'/purchase/post?type=check&code=' + row.code">{{ row.code }}</router-link>
            </template>
          </el-table-column>
          <el-table-column label="下单日期" prop="purchase_time" />
          <el-table-column label="供货客户" prop="company.name" />
        </el-table>
      </el-collapse-item>
      <el-collapse-item title="入库单" name="3">
        <el-table :data="table.warehousing" border>
          <el-table-column label="入库单号" prop="code">
            <template #default="{ row }">
              <router-link :to="'/inventory/warehousing/post?type=check&code=' + row.code">{{ row.code }}</router-link>
            </template>
          </el-table-column>
          <el-table-column label="下单日期" prop="warehousing_time" />
          <el-table-column label="供货客户" prop="company.name" />
        </el-table>
      </el-collapse-item>
      <el-collapse-item title="出库单" name="4">
        <el-table :data="table.outbound" border>
          <el-table-column label="出库单号" prop="code">
            <template #default="{ row }">
              <router-link :to="'/inventory/outbound/post?type=check&code=' + row.code">{{ row.code }}</router-link>
            </template>
          </el-table-column>
          <el-table-column label="下单日期" prop="outbound_time" />
          <el-table-column label="供货客户" prop="company.name" />
        </el-table>
      </el-collapse-item>
      <el-collapse-item title="结算单" name="5">
        <el-table :data="table.statement" border>
          <el-table-column label="结算单号" prop="code">
            <template #default="{ row }">
              <router-link :to="'/sale/statement?code=' + row.code">{{ row.code }}</router-link>
            </template>
          </el-table-column>
          <el-table-column label="结算时间" prop="statement_time" />
          <el-table-column label="结算人" prop="creater_manager.username" />
        </el-table>
      </el-collapse-item>
    </el-collapse>
  </el-drawer>
</template>

<script setup>
import { defineProps, reactive, watch } from 'vue'
import { getBill } from '@/api/index'

const drawer = ref(false)
const emit = defineEmits(['change'])
const props = defineProps({
  drawer: false,
  type: {
    type: String
  },
  code: {
    type: String
  }
})
const table = reactive({
  sale: [],
  purchase: [],
  warehousing: [],
  outbound: [],
  statement: []
})

onMounted(() => {
  drawer.value = props.drawer
  getRelationalBill()
})

watch(() => props.drawer, (v) => {
  drawer.value = props.drawer
})

watch(() => drawer.value, () => {
  emit('change', drawer.value)
})

const getRelationalBill = () => {
  let { type, code } = props
  getBill({ type, code }).then(r => {
    Object.assign(table, r.data)
  })
}
</script>