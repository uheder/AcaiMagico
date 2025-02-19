<script setup>

const cremes = [
  {name: 'creme1'},
  {name: 'creme2'},
  {name: 'creme3'},
  {name: 'creme4'},
]

const recheios = [
  {name: 'recheio1'},
  {name: 'recheio2'},
  {name: 'recheio3'},
  {name: 'recheio4'},
]

const acompanhamentos = [
  {name: 'acompanhamento1'},
  {name: 'acompanhamento2'},
  {name: 'acompanhamento3'},
  {name: 'acompanhamento4'},
  {name: 'acompanhamento5'},
]

const coberturas = [
  {name: 'cobertura1'},
  {name: 'cobertura2'},
  {name: 'cobertura3'},
]

const tamanhos = [
  {name: 'tamanho1', valor: 7, max_cremes: 1, max_recheios: 3, max_acompanhamentos: 1, max_coberturas: 1},
  {name: 'tamanho2', valor: 9, max_cremes: 1, max_recheios: 4, max_acompanhamentos: 2, max_coberturas: 2},
  {name: 'tamanho3', valor: 12, max_cremes: 1, max_recheios: 4, max_acompanhamentos: 3, max_coberturas: 3},
  {name: 'tamanho4', valor: 14, max_cremes: 4, max_recheios: 5, max_acompanhamentos: 4, max_coberturas: 4},
]

</script>

<template>
  <div class="mt-10 space-y-10">

    <!-- TAMANHOS -->
    <fieldset>
      <div class="mt-6 space-y-6">
        <div class="grid grid-cols-10 gap-3 h-6">
          <div v-for="tamanho in tamanhos" :key="tamanho.name"
               class="group grid size-4 grid-cols-1">
            <input
                :id="`creme-${tamanho.id}`"
                type="checkbox"
                v-model="tamanho.selected"
                :value="tamanho.name"
                :class="{
                'col-start-1 row-start-1 rounded-sm border border-gray-300': true,
                'bg-white checked:border-indigo-600 checked:bg-indigo-600': !tamanho.disabled,
                'disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100': tamanho.disabled,
              }"
                :disabled="tamanho.disabled"
            />
            <div class="text-sm/6">
              <label :for="`creme-${tamanho.id}`" class="font-medium text-gray-900">
                {{ tamanho.name }}
              </label>
            </div>
          </div>
        </div>
      </div>
    </fieldset>

    <!-- CREMES -->
    <fieldset>
      <div class="mt-6 space-y-6">
          <div class="grid grid-cols-10 gap-3 h-6">
            <div v-for="creme in cremes" :key="creme.name"
                 class="group grid size-4 grid-cols-1">
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
              <div class="text-sm/6">
                <label :for="`creme-${creme.id}`" class="font-medium text-gray-900">
                  {{ creme.name }}
                </label>
              </div>
            </div>
          </div>
      </div>
    </fieldset>

  <!-- RECHEIOS -->
    <fieldset>
      <div class="mt-6 space-y-6">
        <div class="grid grid-cols-10 gap-3 h-6">
          <div v-for="recheio in recheios" :key="recheio.name"
               class="group grid size-4 grid-cols-1">
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
            <div class="text-sm/6">
              <label :for="`creme-${recheios.id}`" class="font-medium text-gray-900">
                {{ recheio.name }}
              </label>
            </div>
          </div>
        </div>
      </div>
    </fieldset>

    <!-- ACOMPANHAMENTOS -->
    <fieldset>
      <div class="mt-6 space-y-6">
        <div class="grid grid-cols-10 gap-3 h-6">
          <div v-for="acompanhamento in acompanhamentos" :key="acompanhamento.name"
               class="group grid size-4 grid-cols-1">
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
            <div class="text-sm/6">
              <label :for="`creme-${acompanhamento.id}`" class="font-medium text-gray-900">
                {{ acompanhamento.name }}
              </label>
            </div>
          </div>
        </div>
      </div>
    </fieldset>

    <!-- COBERTURAS -->
    <fieldset>
      <div class="mt-6 space-y-6">
        <div class="grid grid-cols-10 gap-3 h-6">
          <div v-for="cobertura in coberturas" :key="cobertura.name"
               class="group grid size-4 grid-cols-1">
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
            <div class="text-sm/6">
              <label :for="`creme-${cobertura.id}`" class="font-medium text-gray-900">
                {{ cobertura.name }}
              </label>
            </div>
          </div>
        </div>
      </div>
    </fieldset>
  </div>
</template>

<style scoped>
</style>