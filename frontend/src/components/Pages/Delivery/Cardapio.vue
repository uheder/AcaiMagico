<script setup>
import {onMounted, ref} from "vue";
import useSizeStore from "../../../store/size.js";
import useCremeStore from "../../../store/creme.js";
import useRecheioStore from "../../../store/recheio.js";
import useAcompanhamentoStore from "../../../store/acompanhamento.js";
import useCoberturaStore from "../../../store/cobertura.js";
import useCartStore from "../../../store/cart.js";
import router from "../../../router.js";
import GuestLayout from "../../GuestLayout.vue";

const cartStore = useCartStore();

const sizeStore = useSizeStore();
const cremeStore = useCremeStore();
const recheioStore = useRecheioStore();
const acompanhamentoStore = useAcompanhamentoStore();
const coberturaStore = useCoberturaStore();

onMounted(() => {
  sizeStore.fetchSizes();
  cremeStore.fetchCremes();
  recheioStore.fetchRecheios();
  acompanhamentoStore.fetchAcompanhamentos();
  coberturaStore.fetchCoberturas();
})

const data = ref({
  tamanho: '',
  creme: [],
  recheio: [],
  acompanhamento: [],
  cobertura: [],
  quantidade: 1,
});

const submit = () => {
  cartStore.addToCart({
    tamanho: data.value.tamanho,
    creme: data.value.creme ? data.value.creme : "Sem",
    recheio: data.value.recheio,
    acompanhamento: data.value.acompanhamento,
    cobertura: data.value.cobertura,
    valor_item: data.value.tamanho.valor,
    quantidade: data.value.quantidade,
  })
  router.push('/cart')
}


</script>

<template>
  <GuestLayout>
  <div class="items-center justify-center bg-white shadow-md">
    <form @submit.prevent="submit()">
      <div class="ml-4 mr-4">
        <!-- TAMANHOS -->
        <div>
          <div class="border-b border-gray-900/10 pb-4">
            <h1 class="text-3xl font-semibold text-purple-500 text-center pb-4">Tamanhos</h1>
            <fieldset>
              <div class="grid grid-cols-3 lg:grid-cols-4 gap-3 h-auto">
                <div v-for="tamanho in sizeStore.sizes" :key="tamanho.id"
                     class="text-sm/4 inline-flex items-center">
                  <input
                      :id="`tamanho-${tamanho.id}`"
                      type="radio"
                      v-model="data.tamanho"
                      :name="tamanho.id"
                      :value="tamanho"
                      class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden"
                  />
                  <div class="text-sm/4 ml-2">
                    <label :for="`tamanho-${tamanho.id}`" class="font-medium text-gray-600">
                      {{ tamanho.nome }}: R${{ tamanho.valor }}
                    </label>
                  </div>
                </div>
              </div>
            </fieldset>
          </div>
        </div>

        <!-- CREMES -->
        <div class="mt-4">
          <div class="border-b border-gray-900/10 pb-4">
            <h1 class="text-3xl font-semibold text-purple-500 text-center pb-2">Cremes</h1>
            <fieldset>
              <div class="grid grid-cols-3 lg:grid-cols-4 gap-3 h-auto auto-rows-auto">
                <div v-for="creme in cremeStore.cremes" :key="creme.id"
                     class="text-sm/4 inline-flex items-center">
                  <input
                      :id="`creme-${creme.id}`"
                      type="radio"
                      v-model="data.creme"
                      :value="creme"
                      :class="{
                    'col-start-1 row-start-1 rounded-sm border border-gray-300': true,
                    'bg-white checked:border-indigo-600 checked:bg-indigo-600': !creme.disabled,
                    'disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100': creme.disabled,
                  }"
                  />
                  <div class="text-sm/4 ml-2">
                    <label :for="`creme-${creme.id}`" class="font-medium text-gray-600">
                      {{ creme.nome }}
                    </label>
                  </div>
                </div>
              </div>
            </fieldset>
          </div>
        </div>

        <!-- RECHEIOS -->
        <div class="mt-4">
          <div class="border-b border-gray-900/10 pb-4">
            <h1 class="text-3xl font-semibold text-purple-500 text-center pb-2">Recheios</h1>
            <fieldset>
              <div class="grid grid-cols-3 lg:grid-cols-4 gap-3 h-auto">
                <div v-for="recheio in recheioStore.recheios" :key="recheio.id"
                     class="text-sm/4 inline-flex items-center">
                  <input
                      :id="`recheio-${recheio.id}`"
                      type="checkbox"
                      v-model="data.recheio"
                      :value="recheio"
                      :class="{
                    'col-start-1 row-start-1 rounded-sm border border-gray-300': true,
                    'bg-white checked:border-indigo-600 checked:bg-indigo-600': !recheio.disabled,
                    'disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100': recheio.disabled,
                  }"
                      :disabled="recheio.disabled"
                  />
                  <div class="text-sm/4 ml-2">
                    <label :for="`recheio-${recheio.id}`" class="font-medium text-gray-600">
                      {{ recheio.nome }}
                    </label>
                  </div>
                </div>
              </div>
            </fieldset>
          </div>
        </div>

        <!-- ACOMPANHAMENTOS -->
        <div class="mt-10">
          <div class="border-b border-gray-900/10 pb-4">
            <h1 class="text-3xl font-semibold text-purple-500 text-center pb-2">Acompanhamentos</h1>
            <fieldset>
              <div class=" grid grid-cols-3 lg:grid-cols-4 gap-3 h-auto">
                <div v-for="acompanhamento in acompanhamentoStore.acompanhamentos" :key="acompanhamento.id"
                     class="text-sm/4 inline-flex items-center">
                  <input
                      :id="`acompanhamento-${acompanhamento.id}`"
                      type="checkbox"
                      v-model="data.acompanhamento"
                      :value="acompanhamento"
                      :class="{
                    'col-start-1 row-start-1 rounded-sm border border-gray-300': true,
                    'bg-white checked:border-indigo-600 checked:bg-indigo-600': !acompanhamento.disabled,
                    'disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100': acompanhamento.disabled,
                  }"
                      :disabled="acompanhamento.disabled"
                  />
                  <div class="text-sm/4 ml-2">
                    <label :for="`acompanhamento-${acompanhamento.id}`" class="font-medium text-gray-600">
                      {{ acompanhamento.nome }}
                    </label>
                  </div>
                </div>
              </div>
            </fieldset>
          </div>
        </div>

        <!-- COBERTURAS -->
        <div class="mt-10">
          <div class="border-b border-gray-900/10 pb-4">
            <h1 class="text-3xl font-semibold text-purple-500 text-center pb-2">Coberturas</h1>
            <fieldset>
              <div class="grid grid-cols-3 lg:grid-cols-4 gap-3 h-auto">
                <div v-for="cobertura in coberturaStore.coberturas" :key="cobertura.id"
                     class="text-sm/4 inline-flex items-center">
                  <input
                      :id="`cobertura-${cobertura.id}`"
                      type="checkbox"
                      v-model="data.cobertura"
                      :value="cobertura"
                      :class="{
                    'col-start-1 row-start-1 rounded-sm border border-gray-300': true,
                    'bg-white checked:border-indigo-600 checked:bg-indigo-600': !cobertura.disabled,
                    'disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100': cobertura.disabled,
                  }"
                      :disabled="cobertura.disabled"
                  />
                  <div class="text-sm/4 ml-2">
                    <label :for="`cobertura-${cobertura.id}`" class="font-medium text-gray-600">
                      {{ cobertura.nome }}
                    </label>
                  </div>
                </div>
              </div>
            </fieldset>
          </div>
        </div>
      </div>

      <div class="ml-3">
        <label for="quantidade" class="block text-md font-medium text-gray-600">Quantidade</label>
        <input v-model="data.quantidade" type="number" value="1" min="1" name="quantidade" id="quantidade" class="mr-2 w-[20%] rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
      </div>

      <div class="mt-4 flex justify-center gap-x-6 pb-2">
        <button class="text-center rounded-md w-[60%] md:w-[40%] lg:w-[30%] mt-6 bg-purple-900 py-2 px-4 border border-transparent text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-cyan-700 focus:shadow-none active:bg-cyan-700 hover:bg-purple-950 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="submit">
          Adicionar item ao carrinho
          <img src="@/assets/svgCart.svg" class="w-6 h-6 inline-flex" alt="Adicionar ao carrinho">
        </button>
      </div>
    </form>
  </div>
  </GuestLayout>
</template>

<style scoped>

</style>