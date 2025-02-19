<script setup>
import {onMounted, ref} from "vue";
import DefaultAdminLayout from "../../DefaultAdminLayout.vue";
import axios from "axios";

const ordersURL = 'localhost:8000/api/v1/orders';
const orders = ref([]);

onMounted(async () => {
  try {
    const response = await axios.get(ordersURL);
    orders.value = response.data;
  } catch (error) {
    console.log(error);
  }
});

</script>

<template>
  <DefaultAdminLayout>
    <ul>
      <li v-for="order in orders" :key="order.id">{{ order }}</li>
    </ul>
  </DefaultAdminLayout>


</template>

<style scoped>

</style>