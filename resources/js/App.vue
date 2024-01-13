<script setup>
import {reactive, ref} from 'vue'
import http from "utils/http";
import { ElLoading } from 'element-plus'

const cleanForm = {
  name: '',
  price: [0, 500000],
  bedrooms: null,
  bathrooms: null,
  storeys: null,
  garages: null,
}

let form = reactive({ ...cleanForm });

const onSubmit = async () => {
  const loading = ElLoading.service({
    lock: true,
    text: 'Loading',
    background: 'rgba(0, 0, 0, 0.7)',
  })
  message.value = null;
  await http({
    url: '/search',
    data: form,
  }).then((res) => {
    if (res.data.length === 0) {
      results.value = [];
      message.value = 'Sorry, nothing found!';
    } else {
      results.value = res.data;
    }
  }).finally( () => {
    loading.close();
  });
}

const onClear = function () {
  Object.assign(form, cleanForm);
}

const results = ref([]);
const message = ref(null);

</script>

<template>
  <div class="page-index">
    <h3>Search form</h3>
    <el-form :model="form" label-width="120px">
      <el-form-item label="Property name">
        <el-input v-model="form.name"/>
      </el-form-item>
      <el-form-item label="Price range">
        <el-slider
          v-model="form.price"
          range
          :min=0
          :max=500000
        />
      </el-form-item>
      <el-form-item label="Bedrooms">
        <el-input-number
          v-model="form.bedrooms"
          :min="1"
          :max="5"
        />
      </el-form-item>
      <el-form-item label="Bathrooms">
        <el-input-number
          v-model="form.bathrooms"
          :min="1"
          :max="5"
        />
      </el-form-item>
      <el-form-item label="Storeys">
        <el-input-number
          v-model="form.storeys"
          :min="1"
          :max="5"
        />
      </el-form-item>
      <el-form-item label="Garages">
        <el-input-number
          v-model="form.garages"
          :min="1"
          :max="5"
        />
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="onSubmit">Search</el-button>
        <el-button @click="onClear">Clear</el-button>
      </el-form-item>
    </el-form>

    <h3>Results</h3>

    <template v-if="results.length">
      <el-table :data="results" style="width: 100%">
        <el-table-column prop="name" label="Name" width="180" />
        <el-table-column prop="price" label="Price" width="180" />
        <el-table-column prop="bedrooms" label="Bedrooms" />
        <el-table-column prop="bathrooms" label="Bathrooms" />
        <el-table-column prop="storeys" label="Storeys" />
        <el-table-column prop="garages" label="Garages" />
      </el-table>
    </template>

    <div class="message" v-if="message">
      <h3>{{ message }}</h3>
    </div>

  </div>
</template>

<style>
.page-index {
  padding-top: 60px;
  text-align: center;
  margin: 0 auto;
  max-width: 1080px;
}
.message {

}
</style>
