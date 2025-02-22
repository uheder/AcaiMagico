<script setup>
import DefaultAdminLayout from "../../../DefaultAdminLayout.vue";

import {getPedidos} from "../../../../api.js";
import {onMounted, ref} from "vue";

const pedidos = ref([]);
onMounted(() => getPedidos(pedidos))
</script>

<template>
  <DefaultAdminLayout>
    <header class="bg-white shadow-sm">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Pedidos</h1>
      </div>
    </header>
    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg: ml-4 mr-4">
        <div v-for="pedido in pedidos"
             class="text-sm/4 inline-flex items-center">
          <ul class="list-disc">
            <hr>
            <li>Número do pedido: {{ pedido.numero }}</li>
            <li>Nome do cliente: {{pedido.nome_cliente }}</li>
            <li>Observação: {{ pedido.observacao }}</li>
            <li>Status: {{ pedido.status }}</li>
            <li>Tipo de entrega: {{ pedido.tipo_entrega }}</li>
            <li>Total do pedido: R$ {{ pedido.total }}</li>
            <li>Itens do pedido:</li>
            <ul v-for="item in pedido.items">
              <li>Tamanho: {{ item.tamanho }}</li>
              <li>Cremes: {{ item.creme ? item.creme : "Sem"}}</li>
              <li>Recheios: {{ item.recheio ? item.recheio : "Sem"}}</li>
              <li>Acompanhamentos: {{ item.acompanhamento ? item.acompanhamento : "Sem"}}</li>
              <li>Coberturas: {{ item.cobertura ? item.cobertura : "Sem"}}</li>
              <li>Quantidade: {{ item.quantidade }}</li>
              <hr class="border-gray-900/10">
            </ul>
              <li>Informações de entrega: {{ pedido.tipo_entrega === "Entrega" ? pedido.entrega : ""}}</li>
          </ul>
        </div>
      </div>
    </main>

  </DefaultAdminLayout>


</template>

<style scoped>

</style>