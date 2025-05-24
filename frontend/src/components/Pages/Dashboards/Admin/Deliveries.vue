<script setup>
import DefaultAdminLayout from "../../../DefaultAdminLayout.vue";
import {onMounted, ref} from "vue";
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
         <div v-for="entrega in deliveryStore.deliveries" class="text-sm/4 flex flex-col">
           <div class="my-2 bg-white shadow-sm border border-slate-500 rounded-lg">
             <div class="p-4 bg-purple-400">
               <ul>
                 <li>Pedido: {{ entrega.delivery.order_id}}</li>
                 <li>Cliente: {{entrega.delivery.nome_cliente}}</li>
                 <li>Endereço: {{entrega.delivery.rua}}, {{entrega.delivery.numero}}, {{entrega.delivery.bairro}}, {{entrega.delivery.referencia}}</li>
                 <li>Forma de Pagamento: {{entrega.delivery.forma_pagamento}}</li>
                 <li v-if="entrega.delivery.forma_pagamento">Troco: {{entrega.delivery.troco ? 'Sim': 'Não'}}</li>
                 <li v-if="entrega.delivery.troco">Troco para: R$ {{entrega.delivery.troco_para}}</li>
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