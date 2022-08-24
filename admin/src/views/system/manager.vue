<template>
  <div class="app-container">
    <el-form inline>
      <el-form-item label="角色">
        <el-select v-model="listQuery.role">
          <el-option label="全部角色" value="" />
          <el-option v-for="item in role" :key="item.id" :label="item.name" :value="item.id" />
        </el-select>
      </el-form-item>
      <el-form-item label="状态">
        <el-select v-model="listQuery.status">
          <el-option label="全部状态" value="" />
          <el-option label="正常" value="0" />
          <el-option label="锁定" value="1" />
        </el-select>
      </el-form-item>
      <el-form-item label="关键词">
        <el-input v-model="listQuery.kw" placeholder="管理员名称" />
      </el-form-item>
      <el-form-item>
        <el-button type="primary" :icon="Search" @click="getManagers">搜索</el-button>
        <el-button type="success" :icon="DocumentAdd" @click="handleAddManager" v-permission="'add'">添加</el-button>
      </el-form-item>
    </el-form>

    <el-table :data="table" stripe v-loading="loading" table-layout="auto">
      <el-table-column label="用户名" prop="username" />
      <el-table-column label="角色" prop="roles.name" />
      <el-table-column label="创建时间" prop="created_at" />
      <el-table-column label="上次登录时间" prop="last_login_time" />
      <el-table-column label="上次登录IP" prop="last_login_ip" />
      <el-table-column label="状态">
        <template #default="{ row }">
          <el-tag v-if="!row.black">正常</el-tag>
          <el-tag v-else type="warning">锁定</el-tag>
        </template>
      </el-table-column>
      <el-table-column label="操作">
        <template #default="{ row }">
          <el-button :icon="Edit" @click="handleUpdateManager(row)" v-permission="'update'">编辑</el-button>
          <el-button :icon="CircleClose" type="warning" @click="handleBlack(row)" v-permission="'update'" plain>{{ row.black ? '解锁' : '拉黑' }}</el-button>
          <el-button :icon="Delete" type="danger" @click="handleDelete(row)" v-permission="'delete'" plain>删除</el-button>
        </template>
      </el-table-column>
    </el-table>
    <div class="pagination">
      <el-pagination background layout="total, prev, pager, next" v-model:currentPage="listQuery.page"
        @current-change="getManagers" :page-size="listQuery.limit" :total="listQuery.total" />
    </div>

    <el-dialog v-model="dialogVisible" :title="type + '用户'" width="36%" draggable :close-on-click-modal="false">
      <el-form label-width="80px">
        <el-form-item label="用户名">
          <el-input v-model="form.username" placeholder="请输入用户名" />
        </el-form-item>
        <el-form-item label="密　码">
          <el-input type="password" v-model="form.password" placeholder="请输入密码" />
          <div class="tips" v-if="type == '编辑'" :style="{ 'color': '#595959', 'font-size': '12px' }">注：不输入密码，即保持上次密码</div>
        </el-form-item>
        <el-form-item label="角　色">
          <el-select v-model="form.role">
            <el-option v-for="item in role" :key="item.id" :label="item.name" :value="item.id" />
          </el-select>
        </el-form-item>
      </el-form>
      <template #footer>
        <span class="dialog-footer">
          <el-button @click="dialogVisible = false, initForm()">取消</el-button>
          <el-button type="primary" @click="handleSubmit">确定</el-button>
        </span>
      </template>
    </el-dialog>
  </div>
</template>

<script setup>
import { Search, DocumentAdd, Edit, Delete, CircleClose } from '@element-plus/icons-vue'
import { onMounted, reactive, ref } from "vue";
import { getRole, getManager, saveManager, deleteManager, pullBlack } from '@/api/system'
import { ElMessage } from 'element-plus';

let listQuery = reactive({
  role: '',
  kw: '',
  status: '',
  page: 1,
  limit: 12,
  total: 0
})
let table = ref([])
let role = ref([])
let dialogVisible = ref(false)
let type = ref('')
let form = reactive({
  id: '',
  username: '',
  role: '',
  password: ''
})
let loading = ref(false)

onMounted(() => {
  getRole().then(r => {
    role.value = r.data
  })
  getManagers()
})

const getManagers = () => {
  loading.value = true
  getManager({ listQuery }).then(r => {
    table.value = r.data
    listQuery.total = r.total
    loading.value = false
  })
}

const handleAddManager = () => {
  type.value = '添加', dialogVisible.value = true
}

const handleUpdateManager = (row) => {
  form.id = row.id
  form.username = row.username
  form.role = row.role
  dialogVisible.value = true
  type.value = '编辑'
}

const handleSubmit = () => {
  saveManager(form).then(r => {
    initForm()
    ElMessage.success(r.message)
    dialogVisible.value = false
    getManagers()
  })
}

const handleDelete = (row) => {
  ElMessageBox.confirm(
    '此操作将删除当前记录，将无法恢复，继续操作？',
    '警告',
    {
      confirmButtonText: '确认',
      cancelButtonText: '取消',
      type: 'warning',
    }
  )
    .then(() => {
      deleteManager({ id: row.id }).then(r => {
        getManagers()
        ElMessage.success(r.message)
      })
    })
}

const initForm = () => {
  form.id = ''
  form.username = ''
  form.role = ''
  form.password = ''
}

const handleBlack = (row) => {
  let data = { id: row.id, status: Number(!row.black) }
  pullBlack(data).then(r => {
    ElMessage.success(r.message)
    getManagers()
  })
}
</script>