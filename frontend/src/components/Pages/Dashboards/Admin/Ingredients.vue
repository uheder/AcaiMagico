<script setup>

import DefaultAdminLayout from "../../../DefaultAdminLayout.vue";
import {onMounted} from "vue";
import useCremeStore from "../../../../store/creme.js";
import useRecheioStore from "../../../../store/recheio.js";
import useAcompanhamentoStore from "../../../../store/acompanhamento.js";
import useCoberturaStore from "../../../../store/cobertura.js";

const cremeStore = useCremeStore();
const recheioStore = useRecheioStore();
const acompanhamentoStore = useAcompanhamentoStore();
const coberturaStore = useCoberturaStore();

onMounted(() => {
  cremeStore.fetchCremes();
  recheioStore.fetchRecheios();
  acompanhamentoStore.fetchAcompanhamentos();
  coberturaStore.fetchCoberturas();
})

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
            <div class="mx-auto max-w-7xl px-1 py-2 grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
              <div v-for="creme in cremeStore.cremes" :key="creme.id" class="text-sm/4 mx-1 lg:mx-2 inline-flex items-center text-center">
                <div class="my-1 lg:my-2 bg-white shadow-sm border border-slate-500 rounded-lg w-full">
                  <div class="p-4 bg-purple-400">
                    <ul>
                      <li class="mb-1 text-slate-800 text-xl font-semibold">{{ creme.name }}</li>

                      <!-- Botão atualizar status -->
                      <button @click="cremeStore.update_creme(creme)"
                              class="rounded-md bg-yellow-500 py-2 px-4 mx-1 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-yellow-400 focus:shadow-none active:bg-yellow-400 hover:bg-yellow-400 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                              type="button">
                        {{ creme.status === 'ativo' ? 'Desativar' : 'Ativar' }}
                      </button>

                      <!-- Botão Excluir -->
                      <button @click="cremeStore.delete_creme(creme)"
                              class="rounded-md bg-red-600 py-2 px-4 border border-transparent text-center text-sm text-red-950 transition-all shadow-md hover:shadow-lg focus:bg-red-500 focus:shadow-none active:bg-red-500 hover:bg-red-500 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                              type="button">
                        Excluir
                      </button>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <h1 class="text-3xl font-semibold text-purple-900 text-center">Recheios</h1>
          <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl px-1 py-2 grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
              <div v-for="recheio in recheioStore.recheios" :key="recheio.id" class="text-sm/4 mx-1 lg:mx-2 inline-flex items-center text-center">
                <div class="my-1 lg:my-2 bg-white shadow-sm border border-slate-500 rounded-lg w-full">
                  <div class="p-4 bg-purple-400">
                    <ul>
                      <li class="mb-1 text-slate-800 text-xl font-semibold">{{ recheio.name }}</li>

                      <!-- Botão atualizar status -->
                      <button @click="recheioStore.update_recheio(recheio)"
                              class="rounded-md bg-yellow-500 py-2 px-4 mx-1 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-yellow-400 focus:shadow-none active:bg-yellow-400 hover:bg-yellow-400 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                              type="button">
                        {{ recheio.status === 'ativo' ? 'Desativar' : 'Ativar' }}
                      </button>

                      <!-- Botão Excluir -->
                      <button @click="recheioStore.delete_recheio(recheio)"
                              class="rounded-md bg-red-600 py-2 px-4 border border-transparent text-center text-sm text-red-950 transition-all shadow-md hover:shadow-lg focus:bg-red-500 focus:shadow-none active:bg-red-500 hover:bg-red-500 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                              type="button">
                        Excluir
                      </button>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <h1 class="text-3xl font-semibold text-purple-900 text-center">Acompanhamentos</h1>
          <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl px-1 py-2 grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
              <div v-for="acompanhamento in acompanhamentoStore.acompanhamentos" :key="acompanhamento.id" class="text-sm/4 mx-1 lg:mx-2 inline-flex items-center text-center">
                <div class="my-1 lg:my-2 bg-white shadow-sm border border-slate-500 rounded-lg w-full">
                  <div class="p-4 bg-purple-400">
                    <ul>
                      <li class="mb-1 text-slate-800 text-xl font-semibold">{{ acompanhamento.name }}</li>

                      <!-- Botão atualizar status -->
                      <button @click="acompanhamentoStore.update_acompanhamento(acompanhamento)"
                              class="rounded-md bg-yellow-500 py-2 px-4 mx-1 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-yellow-400 focus:shadow-none active:bg-yellow-400 hover:bg-yellow-400 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                              type="button">
                        {{ acompanhamento.status === 'ativo' ? 'Desativar' : 'Ativar' }}
                      </button>

                      <!-- Botão Excluir -->
                      <button @click="acompanhamentoStore.delete_acompanhamento(acompanhamento)"
                              class="rounded-md bg-red-600 py-2 px-4 border border-transparent text-center text-sm text-red-950 transition-all shadow-md hover:shadow-lg focus:bg-red-500 focus:shadow-none active:bg-red-500 hover:bg-red-500 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                              type="button">
                        Excluir
                      </button>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <h1 class="text-3xl font-semibold text-purple-900 text-center">Coberturas</h1>
          <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl px-1 py-2 grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
              <div v-for="cobertura in coberturaStore.coberturas" :key="cobertura.id" class="text-sm/4 mx-1 lg:mx-2 inline-flex items-center text-center">
                <div class="my-1 lg:my-2 bg-white shadow-sm border border-slate-500 rounded-lg w-full">
                  <div class="p-4 bg-purple-400">
                    <ul>
                      <li class="mb-1 text-slate-800 text-xl font-semibold">{{ cobertura.name }}</li>

                      <!-- Botão atualizar status -->
                      <button @click="coberturaStore.update_cobertura(cobertura)"
                              class="rounded-md bg-yellow-500 py-2 px-4 mx-1 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-yellow-400 focus:shadow-none active:bg-yellow-400 hover:bg-yellow-400 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                              type="button">
                        {{ cobertura.status === 'ativo' ? 'Desativar' : 'Ativar' }}
                      </button>

                      <!-- Botão Excluir -->
                      <button @click="coberturaStore.delete_cobertura(cobertura)"
                              class="rounded-md bg-red-600 py-2 px-4 border border-transparent text-center text-sm text-red-950 transition-all shadow-md hover:shadow-lg focus:bg-red-500 focus:shadow-none active:bg-red-500 hover:bg-red-500 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                              type="button">
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


