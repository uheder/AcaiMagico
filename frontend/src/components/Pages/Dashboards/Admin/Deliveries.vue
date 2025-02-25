<script setup>
import DefaultAdminLayout from "../../../DefaultAdminLayout.vue";
import {onMounted, ref} from "vue";
import {getEntregas, getPedidos} from "../../../../api.js";
import useDeliveryStore from "../../../../store/delivery.js";


const deliveryStore = useDeliveryStore();

onMounted(() => {
  deliveryStore.fetchDeliveries();
});

</script>

<template>
   <DefaultAdminLayout>
     <header class="bg-white shadow-sm">
       <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
         <h1 class="text-3xl font-bold tracking-tight text-gray-900">Entregas</h1>
       </div>
     </header>
     <main>
       <div class="mx-auto max-w-7xl px-1 py-2 m-0">
         <div v-for="entrega in deliveryStore.deliveries" class="text-sm/4 inline-flex items-center">
           <div class="my-2 bg-white shadow-sm border border-slate-500 rounded-lg w-full">
             <div class="p-4 bg-gray-100">
               <ul>
                 <li>Pedido: {{ entrega.pedido}}</li>
                 <li>Cliente: {{entrega.nome_cliente}}</li>
                 <li>Endereço: {{entrega.rua}}, {{entrega.numero}}, {{entrega.bairro}}, {{entrega.referencia}}</li>
                 <li>Forma de Pagamento: {{entrega.forma_pagamento}}</li>
                 <li>Troco: {{entrega.troco}}</li>
                 <li>Troco para: {{entrega.troco_para}}</li>
                 <li></li>
                 <li></li>
                 <li></li>
                 <li></li>
               </ul>
             </div>
           </div>
         </div>
       </div>
     </main>
   </DefaultAdminLayout>
</template>

<style scoped>

</style>