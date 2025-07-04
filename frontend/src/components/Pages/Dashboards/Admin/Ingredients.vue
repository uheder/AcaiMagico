<script setup>

import DefaultAdminLayout from "../../../DefaultAdminLayout.vue";
import {capitalize, onMounted, ref} from "vue";
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

const showForm = ref({
  cremes: false,
  recheios: false,
  acompanhamentos: false,
  coberturas: false,
})

const data = ref({
  creme: {nome: ''},
  recheio: {nome: ''},
  acompanhamento: {nome: ''},
  cobertura: {nome: ''},
})

const submitCreme = () => {
  cremeStore.addCreme(data.value);
}

const submitRecheio = () => {
  recheioStore.addRecheio(data.value);
}

const submitAcompanhamento = () => {
  acompanhamentoStore.addAcompanhamento(data.value);
}

const submitCobertura = () => {
  coberturaStore.addCobertura(data.value)
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
          <div class="flex justify-center items-center">
            <h1 class="ml-4 text-3xl font-semibold text-purple-900 text-center">Cremes</h1>
            <div v-show="!showForm.cremes">
              <button v-on:click="showForm.cremes = true"
                      class="ml-10 rounded-md bg-green-600 h-10 w-30 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-green-700 focus:shadow-none active:bg-green-700 hover:bg-green-700 active:shadow-none"
                      type="button">
                Adicionar
              </button>
            </div>

            <div v-show="showForm.cremes">
              <form @submit.prevent="submitCreme()" class="ml-4 pb-4">
                <label for="name" class="block text-sm/6 font-medium text-gray-900">Nome</label>
                <input required type="text" v-model="data.creme.nome" name="nome"
                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                <button type="submit"
                        class="mt-2 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                  Adicionar
                </button>
                <button type="button" v-on:click="showForm.cremes = false"
                        class="ml-4 mt-2 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                  Cancelar
                </button>
              </form>
            </div>
          </div>
          <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl px-1 py-2 grid sm:grid-cols-2 lg:grid-cols-3">
              <div v-for="creme in cremeStore.cremes" :key="creme.id"
                   class="text-sm/4 mx-1 lg:mx-2 inline-flex items-center text-center">
                <div class="my-1 lg:my-2 bg-white shadow-sm border border-slate-500 rounded-lg w-full">
                  <div class="p-4 bg-purple-400">
                    <ul>
                      <li class="mb-1 text-slate-800 text-xl font-semibold">{{ capitalize(creme.nome) }}</li>

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


          <div class="flex justify-center items-center">
            <h1 class="inline text-3xl font-semibold text-purple-900 text-center">Recheios</h1>
            <div v-show="!showForm.recheios">
              <button v-on:click="showForm.recheios = true"
                      class="ml-10 flex-inline rounded-md bg-green-600 h-10 w-30 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-green-700 focus:shadow-none active:bg-green-700 hover:bg-green-700 active:shadow-none"
                      type="button">
                Adicionar
              </button>
            </div>

            <div v-show="showForm.recheios">
              <form @submit.prevent="submitRecheio()" class="ml-4 align-center pb-4">
                <label for="name" class="block text-sm/6 font-medium text-gray-900">Nome</label>
                <input required type="text" v-model="data.recheio.nome" name="nome"
                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                <button type="submit"
                        class="mt-2 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                  Adicionar
                </button>
                <button type="button" v-on:click="showForm.recheios = false"
                        class="ml-4 mt-2 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                  Cancelar
                </button>
              </form>
            </div>
          </div>

          <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl px-1 py-2 grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
              <div v-for="recheio in recheioStore.recheios" :key="recheio.id"
                   class="text-sm/4 mx-1 lg:mx-2 inline-flex items-center text-center">
                <div class="my-1 lg:my-2 bg-white shadow-sm border border-slate-500 rounded-lg w-full">
                  <div class="p-4 bg-purple-400">
                    <ul>
                      <li class="mb-1 text-slate-800 text-xl font-semibold">{{ capitalize(recheio.nome) }}</li>

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


          <div class="flex justify-center items-center">
          <h1 class="inline text-3xl font-semibold text-purple-900 text-center">Acompanhamentos</h1>
          <div v-show="!showForm.acompanhamentos">
            <button v-on:click="showForm.acompanhamentos = true"
                    class="ml-2 !sm:ml-10 flex-inline rounded-md bg-green-600 h-10 w-30 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-green-700 focus:shadow-none active:bg-green-700 hover:bg-green-700 active:shadow-none"
                    type="button">
              Adicionar
            </button>
          </div>

          <div v-show="showForm.acompanhamentos">
            <form @submit.prevent="submitAcompanhamento()" class="ml-4 align-center pb-4">
              <label for="name" class="block text-sm/6 font-medium text-gray-900">Nome</label>
              <input required type="text" v-model="data.acompanhamento.nome" name="nome"
                     class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
              <button type="submit"
                      class="mt-2 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                Adicionar
              </button>
              <button type="button" v-on:click="showForm.acompanhamentos = false"
                      class="ml-4 mt-2 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                Cancelar
              </button>
            </form>
            </div>
          </div>
          <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl px-1 py-2 grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
              <div v-for="acompanhamento in acompanhamentoStore.acompanhamentos" :key="acompanhamento.id"
                   class="text-sm/4 mx-1 lg:mx-2 inline-flex items-center text-center">
                <div class="my-1 lg:my-2 bg-white shadow-sm border border-slate-500 rounded-lg w-full">
                  <div class="p-4 bg-purple-400">
                    <ul>
                      <li class="mb-1 text-slate-800 text-xl font-semibold">{{ capitalize(acompanhamento.nome) }}</li>

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


          <div class="flex justify-center items-center">
          <h1 class="inline text-3xl font-semibold text-purple-900 text-center">Coberturas</h1>
          <div v-show="!showForm.coberturas">
            <button v-on:click="showForm.coberturas = true"
                    class="ml-10 flex-inline rounded-md bg-green-600 h-10 w-30 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-green-700 focus:shadow-none active:bg-green-700 hover:bg-green-700 active:shadow-none"
                    type="button">
              Adicionar
            </button>
          </div>

          <div v-show="showForm.coberturas">
            <form @submit.prevent="submitCobertura()" class="ml-4 align-center pb-4">
              <label for="name" class="block text-sm/6 font-medium text-gray-900">Nome</label>
              <input required type="text" v-model="data.cobertura.nome" name="nome"
                     class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
              <button type="submit"
                      class="mt-2 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                Adicionar
              </button>
              <button type="button" v-on:click="showForm.coberturas = false"
                      class="ml-4 mt-2 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                Cancelar
              </button>
            </form>
          </div>
          </div>
          <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl px-1 py-2 grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
              <div v-for="cobertura in coberturaStore.coberturas" :key="cobertura.id"
                   class="text-sm/4 mx-1 lg:mx-2 inline-flex items-center text-center">
                <div class="my-1 lg:my-2 bg-white shadow-sm border border-slate-500 rounded-lg w-full">
                  <div class="p-4 bg-purple-400">
                    <ul>
                      <li class="mb-1 text-slate-800 text-xl font-semibold">{{ capitalize(cobertura.nome) }}</li>

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


