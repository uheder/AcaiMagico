<script setup>
import {getTamanhos, getCremes, getRecheios, getAcompanhamentos, getCoberturas} from "../../../api.js";
import {onMounted, ref} from "vue";

const tamanhos = ref([]);
const cremes = ref([]);
const recheios = ref([]);
const acompanhamentos = ref([]);
const coberturas = ref([]);

onMounted( () => {
    getTamanhos(tamanhos);
    getCremes(cremes);
    getRecheios(recheios);
    getAcompanhamentos(acompanhamentos);
    getCoberturas(coberturas);
})

const submit = () => {
  const tamanhosselected = tamanhos.value.filter(tamanho => tamanho.selected);
  const cremesselected = cremes.value.filter(creme => creme.selected);
  const recheiosselected = recheios.value.filter(recheio => recheio.selected);
  const acompanhamentosselected = acompanhamentos.value.filter(acompanhamento => acompanhamento.selected);
  const coberturasselected = coberturas.value.filter(cobertura => cobertura.selected);

  const payload = {
    tamanhos: tamanhosselected,
    cremes: cremesselected,
    recheios: recheiosselected,
    acompanhamentos: acompanhamentosselected,
    coberturas: coberturasselected,
  }

  console.log(payload);
}


</script>

<template>

  <form @submit.prevent="submit()">
  <div class="space-y-12 ml-4 mr-4">
    <!-- TAMANHOS -->
    <div class="mt-4 space-y-10">
      <div class="border-b border-gray-900/10 pb-4">
        <h1 class="text-3xl font-semibold text-purple-900 text-center">Tamanhos</h1>
        <fieldset>
          <div class="grid grid-cols-4 gap-4 h-auto">
            <div v-for="tamanho in tamanhos" :key="tamanho.name"
                 class="text-sm/4 inline-flex items-center">
              <input
                  :id="`creme-${tamanho.id}`"
                  type="radio"
                  v-model="tamanho.selected"
                  :name="'tamanho'"
                  :value="tamanho.name"
                  class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden"
              />
              <div class="text-sm/4 ml-2">
                <label :for="`creme-${tamanho.id}`" class="font-medium text-gray-900">
                  {{ tamanho.name }}: R${{ tamanho.valor }}
                </label>
              </div>
            </div>
          </div>
        </fieldset>
        </div>
    </div>

    <!-- CREMES -->
    <div class="mt-4 space-y-10">
      <div class="border-b border-gray-900/10 pb-4">
        <h1 class="text-3xl font-semibold text-purple-900 text-center">Cremes</h1>
        <fieldset>
          <div class="grid grid-cols-4 gap-4 h-auto auto-rows-auto">
            <div v-for="creme in cremes" :key="creme.name"
                 class="text-sm/4 inline-flex items-center">
              <input
                  :id="`creme-${creme.id}`"
                  type="checkbox"
                  v-model="creme.selected"
                  :value="creme.name"
                  :class="{
                    'col-start-1 row-start-1 rounded-sm border border-gray-300': true,
                    'bg-white checked:border-indigo-600 checked:bg-indigo-600': !creme.disabled,
                    'disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100': creme.disabled,
                  }"
                  :disabled="creme.disabled"
              />
              <div class="text-sm/4 ml-2">
                <label :for="`creme-${creme.id}`" class="font-medium text-gray-900">
                  {{ creme.name }}
                </label>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
    </div>

    <!-- RECHEIOS -->
    <div class="mt-10 space-y-10">
      <div class="border-b border-gray-900/10 pb-4">
        <h1 class="text-3xl font-semibold text-purple-900 text-center">Recheios</h1>
        <fieldset>
          <div class="grid grid-cols-4 gap-4 h-auto">
            <div v-for="recheio in recheios" :key="recheio.name"
                 class="text-sm/4 inline-flex items-center">
              <input
                  :id="`creme-${recheio.id}`"
                  type="checkbox"
                  v-model="recheio.selected"
                  :value="recheio.name"
                  :class="{
                    'col-start-1 row-start-1 rounded-sm border border-gray-300': true,
                    'bg-white checked:border-indigo-600 checked:bg-indigo-600': !recheio.disabled,
                    'disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100': recheio.disabled,
                  }"
                  :disabled="recheio.disabled"
              />
              <div class="text-sm/4 ml-2">
                <label :for="`creme-${recheio.id}`" class="font-medium text-gray-900">
                  {{ recheio.name }}
                </label>
              </div>
            </div>
          </div>
        </fieldset>
        </div>
    </div>

    <!-- ACOMPANHAMENTOS -->
    <div class="mt-10 space-y-5">
      <div class="border-b border-gray-900/10 pb-4">
        <h1 class="text-3xl font-semibold text-purple-900 text-center">Acompanhamentos</h1>
        <fieldset>
          <div class="grid grid-cols-4 gap-4 h-auto">
            <div v-for="acompanhamento in acompanhamentos" :key="acompanhamento.name"
                 class="text-sm/4 inline-flex items-center">
              <input
                  :id="`creme-${acompanhamento.id}`"
                  type="checkbox"
                  v-model="acompanhamento.selected"
                  :value="acompanhamento.name"
                  :class="{
                    'col-start-1 row-start-1 rounded-sm border border-gray-300': true,
                    'bg-white checked:border-indigo-600 checked:bg-indigo-600': !acompanhamento.disabled,
                    'disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100': acompanhamento.disabled,
                  }"
                  :disabled="acompanhamento.disabled"
              />
              <div class="text-sm/4 ml-2">
                <label :for="`creme-${acompanhamento.id}`" class="font-medium text-gray-900">
                  {{ acompanhamento.name }}
                </label>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
    </div>

    <!-- COBERTURAS -->
    <div class="mt-10 space-y-5">
      <div class="border-b border-gray-900/10 pb-4">
        <h1 class="text-3xl font-semibold text-purple-900 text-center">Coberturas</h1>
        <fieldset>
          <div class="grid grid-cols-4 gap-4 h-auto">
            <div v-for="cobertura in coberturas" :key="cobertura.name"
                 class="text-sm/4 inline-flex items-center">
              <input
                  :id="`creme-${cobertura.id}`"
                  type="checkbox"
                  v-model="cobertura.selected"
                  :value="cobertura.name"
                  :class="{
                    'col-start-1 row-start-1 rounded-sm border border-gray-300': true,
                    'bg-white checked:border-indigo-600 checked:bg-indigo-600': !cobertura.disabled,
                    'disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100': cobertura.disabled,
                  }"
                  :disabled="cobertura.disabled"
              />
              <div class="text-sm/4 ml-2">
                <label :for="`creme-${cobertura.id}`" class="font-medium text-gray-900">
                  {{ cobertura.name }}
                </label>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
    </div>
  </div>
  <div class="mt-4 flex items-center justify-center gap-x-6 pb-2">
    <button type="submit" class="bg-purple-500 rounded-md">Adicionar seleção ao carrinho</button>
  </div>
  </form>
</template>

<style>
  body {
    background-color: #f7fafc;
  }
</style>