<template>
  <div v-if="props.permission.items">
    <div v-if="props.leaf" :style="{ 'padding': '16px' }">
      <div class="title" :style="{ 'line-height': '18px' }">{{ props.permission.title }}</div>
      <el-checkbox-group v-model="form" :ref="props.permKey" @change="handleSubmit">
        <el-checkbox v-for="(item, key) in permission.items" :key="key" :label="key">{{ item }}</el-checkbox>
      </el-checkbox-group>
    </div>
    <el-collapse-item v-else :title="props.permission.title" :key="props.permKey">
      <el-checkbox-group v-model="form" :ref="props.permKey" @change="handleSubmit">
        <el-checkbox v-for="(item, key) in permission.items" :key="key" :label="key">{{ item }}</el-checkbox>
      </el-checkbox-group>
    </el-collapse-item>
  </div>
  <div v-else>
    <el-collapse-item v-if="!props.leaf" :title="props.permission.title" :key="props.permKey">
      <Permission v-for="(item, key) in props.permission.children" :key="key" :permission="item" :permKey="key"
        :leaf="!Boolean(item.children)" v-model="props.modelValue[key]" @input="submit" />
    </el-collapse-item>

    <el-collapse v-else>
      <Permission v-for="(item, key) in props.permission.children" :key="key" :permission="item" :permKey="key"
        :leaf="!Boolean(item.children)" v-model="props.modelValue[key]" @input="submit" />
    </el-collapse>
  </div>
</template>

<script>
export default {
  name: 'Permission',
};
</script>

<script setup>
import { ref, defineEmits, reactive, onMounted, nextTick, watch } from "vue-demi";
import { deepCopy } from "@/utils";

const activeNames = ref("")
const props = defineProps({
  permission: {
    type: Object,
    default: () => {
      return {};
    },
  },
  modelValue: {
    type: Object,
    default: () => {
      return {};
    },
  },
  permKey: {
    type: String
  },
  leaf: {
    type: Boolean
  }
});
const form = ref([])
const perm = reactive({
  data: {}
})
const emit = defineEmits(["change", "update:modelValue"]);

onMounted(() => {
  if (Array.isArray(props.modelValue) && props.modelValue.length > 0) {
    form.value = props.modelValue
  }
})

const handleSubmit = (v) => {
  // console.log('v', v)
  emit('update:modelValue', v)
  return true;
}

const submit = () => {
  setTimeout(() => emit('update:modelValue', props.modelValue), 0)
}
</script>