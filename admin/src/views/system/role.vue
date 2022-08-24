<template>
  <div class="app-container">
    <el-form>
      <el-form-item>
        <el-button type="primary" :icon="DocumentAdd" @click="dialogVisible = true, type = '添加'" v-permission="'add'">添加角色</el-button>
      </el-form-item>
    </el-form>
    <el-table :data="table" stripe v-loading="loading" table-layout="auto">
      <el-table-column prop="name" label="角色名称" />
      <el-table-column prop="created_at" label="创建时间" />
      <el-table-column label="操作">
        <template #default="{ row }">
          <el-button @click="handleUpdateRole(row)" v-permission="'update'" :icon="Edit">编辑</el-button>
          <el-button type="danger" @click="handelDeleteRole(row)" v-permission="'delete'" :icon="Delete" plain>删除</el-button>
        </template>
      </el-table-column>
    </el-table>

    <el-dialog v-model="dialogVisible" :title="type + '角色'" width="50%" draggable :close-on-click-modal="false">
      <el-form label-width="80px">
        <el-form-item label="角色名称">
          <el-input v-model="form.name" :style="{ 'width': '240px' }" placeholder="请输入角色名称" />
        </el-form-item>
        <el-form-item label="权限">
          <el-collapse :style="{ 'width': '100%' }">
            <Permission v-for="(item, key) in permissions.data" :key="key" :permKey="key" :permission="item" :leaf="false" v-model="form.permission[key]" />
          </el-collapse>
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
import { DocumentAdd, Delete, Edit } from '@element-plus/icons-vue'
import { deepCopy } from '@/utils'
import { getAllPermission, saveRole, getRole, deleteRole } from '@/api/system'
import { onMounted, reactive, ref } from 'vue'
import { ElMessage } from 'element-plus'
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'
import Permission from './components/Permission.vue'

let table = ref([])
let dialogVisible = ref(false)
let type = ref('添加')
let form = reactive({
  id: '',
  name: '',
  permission: []
})
let permissions = reactive({ data: {} })
let activeNames = ref('');
const store = useStore();
const route = useRouter();
let prem = ref([]); // 当前页的权限
let loading = ref(false)

onMounted(() => {
  getAllPermission().then(r => {
    permissions.data = r.data
    activeNames.value = Object.keys(r.data)[0]
  })
  getRoles()
})

const getRoles = () => {
  loading.value = true
  getRole().then(r => {
    table.value = r.data
    loading.value = false
  })
}

const handleSubmit = () => {
  saveRole(form).then(r => {
    dialogVisible.value = false
    ElMessage.success(r.message)
    getRoles()
  })
}

const handleUpdateRole = (row) => {
  dialogVisible.value = true
  type.value = '编辑'
  row = deepCopy(row)
  form.id = row.id
  form.name = row.name
  form.permission = row.permission
}

const setPermission = (permission, form) => {
  for (let key in form) {
    form[key] = permission[key].length ? permission[key] : []
  }
  return form
}

const initForm = () => {
  form.id = ''
  form.name = ''
  for (let key in permissions.data) {
    let el = permissions.data[key]
    if (el.children) {
      form.permission[key] = []
      for (let k in el.children) {
        form.permission[key][k] = []
      }
    } else {
      form.permission[key] = []
    }
  }
}

const handelDeleteRole = (row) => {
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
      deleteRole({ id: row.id }).then(r => {
        getRoles()
        ElMessage.success(r.message)
      })
    })
}

const getData = (e, k) => {
  e = deepCopy(e)
  form.permission[k] = e[k]
  console.log('form.permission',form.permission)
}

</script>

<style lang="scss">
.app-container {
  .el-collapse {
    user-select: none;

    .el-collapse-item {
      user-select: none;

      .el-collapse-item__header {
        background-color: #f5f5f5 !important;
        padding-left: 16px;
      }
    }
  }

}
</style>

<style lang="scss" scoped>
</style>
