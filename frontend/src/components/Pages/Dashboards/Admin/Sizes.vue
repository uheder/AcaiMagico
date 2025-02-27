<script setup>

import DefaultAdminLayout from "../../../DefaultAdminLayout.vue";
import useSizeStore from "../../../../store/sizes.js";
import {onMounted} from "vue";

const sizeStore = useSizeStore();

onMounted(() => {
  sizeStore.fetchSizes();
});
</script>

<template>
  <DefaultAdminLayout>
    <header class="bg-white shadow-sm">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Tamanhos</h1>
      </div>
    </header>
    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl px-1 py-2 m-0 grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
          <div v-for="tamanho in sizeStore.sizes" class="text-sm/4 px-2">
              <div class="my-2 bg-white shadow-sm border border-slate-500 rounded-lg">
                <div class="p-4 bg-purple-400">
                  <ul>
                    <li>{{ tamanho.nome }}</li>
                    <li>Valor: R${{ tamanho.valor }}</li>
                    <li>Max. Cremes: {{ tamanho.qtd_cremes}}</li>
                    <li>Max. Recheios: {{ tamanho.qtd_recheios}}</li>
                    <li>Max. Acompanhamentos: {{ tamanho.qtd_acompanhamentos}}</li>
                    <li>Max. Coberturas: {{ tamanho.qtd_coberturas}}</li>
                    <li>Status: {{ tamanho.status.toUpperCase() }}</li>
                  </ul>
                </div>
              </div>
          </div>
        </div>
      </div>
    </main>

  </DefaultAdminLayout>
</template>

<style scoped>

</style>