<script setup>

import DefaultAdminLayout from "../../../DefaultAdminLayout.vue";
import {onMounted, ref} from "vue";
import {getAcompanhamentos, getCoberturas, getCremes, getRecheios} from "../../../../api.js";
import axiosClient from "../../../../axios.js";
import useCremeStore from "../../../../store/creme.js";

const recheios = ref([]);
const acompanhamentos = ref([]);
const coberturas = ref([]);

const cremeStore = useCremeStore();

onMounted( () => {
  cremeStore.fetchCremes();
  getRecheios(recheios);
  getAcompanhamentos(acompanhamentos);
  getCoberturas(coberturas);
})


async function muda_status_creme(creme) {
  await cremeStore.update_creme(creme);
}

async function deleta_creme(creme) {
  await cremeStore.delete_creme(creme);
}

</script>

<template>
  <DefaultAdminLayout>
    <header class="bg-white shadow-sm">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Ingredientes</h1>
      </div>
    </header>
    <main>
      <div class="mt-4 space-y-10">
        <div class="border-b border-gray-900/10 pb-4">
          <h1 class="text-3xl font-semibold text-purple-900 text-center">Cremes</h1>
          <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl px-1 py-2 m-0">
              <div v-for="creme in cremeStore.cremes" :key="creme.id" class="text-sm/4 inline-flex items-center">
                <div class="my-2 bg-white shadow-sm border border-slate-500 rounded-lg w-full">
                  <div class="p-4 bg-purple-400">
                    <ul>
                      <li class="mb-1 text-slate-800 text-xl font-semibold">{{ creme.name}}</li>
                        <button @click="muda_status_creme(creme)" class="rounded-md bg-yellow-500 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-yellow-400 focus:shadow-none active:bg-yellow-400 hover:bg-yellow-400 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                          {{ creme.status === 'ativo' ? 'Desativar' : 'Ativar' }}
                        </button>

                        <!-- Botão Excluir -->
                        <button @click="deleta_creme(creme)" class="rounded-md bg-red-600 py-2 px-4 border border-transparent text-center text-sm text-red-950 transition-all shadow-md hover:shadow-lg focus:bg-red-500 focus:shadow-none active:bg-red-500 hover:bg-red-500 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                          Excluir
                        </button>
                    </ul>
                  </div>
                  </div>
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


