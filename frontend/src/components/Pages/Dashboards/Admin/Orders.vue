<script setup>
import DefaultAdminLayout from "../../../DefaultAdminLayout.vue";

import {getPedidos} from "../../../../api.js";
import {onMounted, ref} from "vue";
import useOrderStore from "../../../../store/order.js";

const orderStore = useOrderStore()
onMounted(() => {
  orderStore.fetchOrders();
})
</script>

<template>
  <DefaultAdminLayout>
    <header class="shadow-sm">
      <div class="mx-auto max-w-xl sm:px-6 lg:px-8 ">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Pedidos</h1>
      </div>
    </header>
    <main>
      <div class="mx-auto max-w-7xl px-1 py-2 m-0">
        <div v-for="pedido in orderStore.orders" class="text-sm/4 inline-flex items-center">
          <a href="/admin/orders/{{pedido.numero}}">
          <div class="my-2 bg-white shadow-sm border border-slate-500 rounded-lg">
            <div class="p-4 bg-purple-400">
              <ul class="list-disc list-inside">
                <li>Nº: {{ pedido.numero }}</li>
                <li>Cliente: {{ pedido.nome_cliente }}</li>
                <li>Status: {{ pedido.status }}</li>
                <li>Observações: {{ pedido.observacao }}</li>
                <li>Total: R$ <strong>{{ pedido.total}}</strong></li>
                <li :class="[pedido.tipo_entrega === 'Retirada' ? 'text-green-700' : 'text-blue-700', 'font-bold'] ">{{pedido.tipo_entrega }}</li>
              </ul>
            </div>
          </div>
          </a>
        </div>
      </div>
    </main>
  </DefaultAdminLayout>


</template>

<style scoped>

</style>