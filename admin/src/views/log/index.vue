<template>
  <div class="app-container">
    <el-form inline>
      <el-form-item label="操作日期">
        <el-date-picker v-model="listQuery.date" type="daterange" range-separator="-" start-placeholder="起始日期"
          end-placeholder="结束日期" value-format="YYYY-MM-DD" />
      </el-form-item>
      <el-form-item label="操作员">
        <el-select v-model="listQuery.manager" multiple filterable>
          <el-option v-for="item in managers" :key="item.id" :label="item.username" :value="item.id" />
        </el-select>
      </el-form-item>
      <el-form-item>
        <el-button :icon="Search" type="primary" @click="handleSearch">搜索</el-button>
      </el-form-item>
    </el-form>

    <el-table :data="table" stripe>
      <el-table-column prop="username" label="操作员" />
      <el-table-column prop="type" label="类型" />
      <el-table-column prop="remark" label="说明" />
      <el-table-column prop="created_at" label="操作时间" />
      <el-table-column prop="ip" label="操作IP" />
    </el-table>

    <div class="pagination">
      <el-pagination background layout="total, sizes, prev, pager, next" v-model:currentPage="listQuery.page"
        v-model:page-size="listQuery.limit" :page-sizes="[10, 30, 50, 100]" @size-change="getList"
        @current-change="getList" :page-size="listQuery.limit" :total="listQuery.total" />
    </div>
  </div>
</template>

<script setup>
import { onMounted, reactive, ref } from "vue-demi";
import { Search } from '@element-plus/icons-vue'
import { getLog } from '@/api/index'
import { getManager } from '@/api/system'

const listQuery = reactive({
  page: 1,
  limit: 30,
  total: 0,
  manager: [],
  type: [],
  date: []
})
const table = ref([])
const managers = ref([])

onMounted(() => {
  getList(), getManagers()
})

const getList = () => {
  getLog(listQuery).then(r => {
    table.value = r.data
    listQuery.total = r.total
  })
}

const getManagers = () => {
  getManager({ listQuery: { page: 1, limit: 999 } }).then(r => {
    managers.value = r.data
  })
}

const handleSearch = () => {
  listQuery.page = 1
  getList()
}
</script>