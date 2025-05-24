<script setup>

import DefaultAdminLayout from "../../../DefaultAdminLayout.vue";
import useSizeStore from "../../../../store/size.js";
import {capitalize, onMounted, ref} from "vue";

const sizeStore = useSizeStore();



onMounted(() => {
  sizeStore.fetchSizes();

});


const data = ref({
  nome: '',
  valor: 0,
  max_cremes: 1,
  max_recheios: 1,
  max_acompanhamentos: 1,
  max_coberturas: 1,
})

const showForm = ref(false)

const submit = () => {
  sizeStore.addSize(data.value)
}
</script>

<template>
  <DefaultAdminLayout>
    <header class="bg-white shadow-sm">
      <div class="max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="inline text-3xl font-bold tracking-tight text-gray-900">Tamanhos</h1>
        <button v-on:click="showForm = true" class="ml-10 flex-inline rounded-md bg-green-600 h-10 w-30 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-green-700 focus:shadow-none active:bg-green-700 hover:bg-green-700 active:shadow-none" type="button">
          Adicionar
        </button>
      </div>
    </header>
    <main>
      <div v-show="showForm">
        <form @submit.prevent="submit()" class="ml-4 align-center pb-4">
          <label for="name" class="block text-sm/6 font-medium text-gray-900">Nome</label>
          <input required type="text" v-model="data.nome" name="nome" class="block w-[10%] rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">

          <label for="valor" class="block text-sm/6 font-medium text-gray-900">Valor</label>
          <input required type="number" v-model="data.valor" name="valor" class="block w-[10%] rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">

          <label for="max_cremes" class="block text-sm/6 font-medium text-gray-900">Max. Cremes</label>
          <input required type="number" v-model="data.max_cremes" name="max_cremes" class="block w-[10%] rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">

          <label for="max_recheios" class="block text-sm/6 font-medium text-gray-900">Max. Recheios</label>
          <input required type="number" v-model="data.max_recheios" name="max_recheios" class="block w-[10%] rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">

          <label for="max_recheios" class="block text-sm/6 font-medium text-gray-900">Max. Acompanhamentos</label>
          <input required type="number" v-model="data.max_acompanhamentos" name="max_acompanhamentos" class="block w-[10%] rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">

          <label for="max_recheios" class="block text-sm/6 font-medium text-gray-900">Max. Coberturas</label>
          <input required type="number" v-model="data.max_coberturas" name="max_coberturas" class="block w-[10%] rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">

          <button type="submit" class="mt-2 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
            Adicionar
          </button>

          <button type="button" v-on:click="showForm = false" class="ml-4 mt-2 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
            Cancelar
          </button>
        </form>
      </div>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl px-1 py-2 m-0 grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
          <div v-for="tamanho in sizeStore.sizes" class="text-sm/4 px-2">
              <div class="my-2 bg-white shadow-sm border border-slate-500 rounded-lg">
                <div class="p-4 bg-purple-400">
                  <ul>
                    <li>Tamanho: {{ tamanho.name }}</li>
                    <li>Valor: R${{ tamanho.valor }}</li>
                    <li>Max. Cremes: {{ tamanho.qtd_cremes}}</li>
                    <li>Max. Recheios: {{ tamanho.qtd_recheios}}</li>
                    <li>Max. Acompanhamentos: {{ tamanho.qtd_acompanhamentos}}</li>
                    <li>Max. Coberturas: {{ tamanho.qtd_coberturas}}</li>
                    <li>Status: {{ capitalize(tamanho.status) }}</li>

                    <!-- Botão atualizar status -->
                    <button @click="sizeStore.update_size(tamanho)"
                            class="mt-2 ml-0 rounded-md bg-yellow-500 py-2 w-[45%] px-2 mx-1 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-yellow-400 focus:shadow-none active:bg-yellow-400 hover:bg-yellow-400 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                      {{ tamanho.status === 'ativo' ? 'Desativar' : 'Ativar' }}
                    </button>

                    <!-- Botão Excluir -->
                    <button @click="sizeStore.delete_size(tamanho)"
                            class="text-center rounded-md bg-red-600 py-2 w-[45%] px-4 border border-transparent text-center text-sm text-red-950 transition-all shadow-md hover:shadow-lg focus:bg-red-500 focus:shadow-none active:bg-red-500 hover:bg-red-500 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                      Excluir
                    </button>
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