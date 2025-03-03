<script setup>
import useCartStore from "../../../store/cart.js";
import {storeToRefs} from "pinia";
import {onMounted, ref, toRaw} from "vue";

const cartStore = useCartStore();
const { cart } = storeToRefs(cartStore)

onMounted(() => {
  cartStore.fetchCart();
})

const quantidade = ref(1)

</script>

<template>
  <div class="sm:max-w-full md:max-w-[90%]  lg:w-[75%] xl:max-w-[60%] justify-between items-center mx-auto mb-3 mt-1 pl-2">
    <div>
      <h3 class="text-lg font-semibold text-slate-800">Seu carrinho</h3>
      <div class="grid grid-cols-2 gap-2 mt-2">
      <p class="text-slate-500">Confira os itens selecionados</p>
      <RouterLink to="Home" class="justify-items-end pr-2"><img src="../../../../public/svgHome.svg" class="h6 w-6" alt="Retornar a pagina principal"></RouterLink>
      </div>
    </div>
  </div>

  <div class="sm:max-w-full md:max-w-[90%]  lg:w-[75%] xl:max-w-[60%] justify-center items-center mx-auto h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
    <table class="w-full text-left table-auto min-w-max">
      <thead>
      <tr class="border-b border-slate-300 bg-slate-50">
        <th class="p-4 text-sm font-normal leading-none text-slate-500">Item</th>
        <th class="p-4 text-sm font-normal leading-none text-slate-500">Quantidade</th>
        <th class="p-4 text-sm font-normal leading-none text-slate-500">Valor unitário</th>
        <th class="p-4 text-sm font-normal leading-none text-slate-500"></th>
      </tr>
      </thead>
      <tbody v-for="(item, index) in cart" :key="index">
      <tr class="hover:bg-slate-50">
        <td class="p-4 border-b border-slate-200 py-5">
          <p class="block font-semibold text-sm text-slate-800">Tamanho: {{ item.tamanho.name }}</p>
          <p class="block font-semibold text-sm text-slate-800">Cremes: {{ item.creme.map(creme => creme.name).join(', ')}}</p>
          <p class="block font-semibold text-sm text-slate-800">Recheios: {{ item.recheio.length > 0 ? item.recheio.map(recheio => recheio.name).join(', ') :'Sem'}} </p>
          <p class="block font-semibold text-sm text-slate-800">Acompanhamentos: {{ item.acompanhamento.length > 0 ? item.acompanhamento.map(acompanhamento => acompanhamento.name).join(', ') : 'Sem'}} </p>
          <p class="block font-semibold text-sm text-slate-800">Coberturas: {{item.cobertura.length > 0 ? item.cobertura.map(cobertura => cobertura.name).join(', ') : 'Sem'}}</p>
        </td>
        <td class="p-4 border-b border-slate-200 py-5">
          <p class="text-sm text-slate-500 flex-auto max-w-[118px] min-w-[80px]"><input type="number" value="1" v-model="quantidade"></p>
        </td>
        <td class="p-4 border-b border-slate-200 py-5">
          <p class="text-sm text-slate-500">R$ {{ item.tamanho.valor }}</p>
        </td>
        <td class="p-4 border-b border-slate-200 py-5">
          <button type="button" @click="cartStore.removeFromCart(index)" class="text-slate-500 hover:text-slate-700">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="w-6 h-6" viewBox="0,0,256,256">
              <g fill="#9a0ee0" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(2,2)"><path d="M49,1c-1.66,0 -3,1.34 -3,3c0,1.66 1.34,3 3,3h30c1.66,0 3,-1.34 3,-3c0,-1.66 -1.34,-3 -3,-3zM24,15c-7.17,0 -13,5.83 -13,13c0,7.17 5.83,13 13,13h77v63c0,9.37 -7.63,17 -17,17h-40c-9.37,0 -17,-7.63 -17,-17v-52c0,-1.66 -1.34,-3 -3,-3c-1.66,0 -3,1.34 -3,3v52c0,12.68 10.32,23 23,23h40c12.68,0 23,-10.32 23,-23v-63.35937c5.72,-1.36 10,-6.50062 10,-12.64062c0,-7.17 -5.83,-13 -13,-13zM24,21h80c3.86,0 7,3.14 7,7c0,3.86 -3.14,7 -7,7h-80c-3.86,0 -7,-3.14 -7,-7c0,-3.86 3.14,-7 7,-7zM50,55c-1.66,0 -3,1.34 -3,3v46c0,1.66 1.34,3 3,3c1.66,0 3,-1.34 3,-3v-46c0,-1.66 -1.34,-3 -3,-3zM78,55c-1.66,0 -3,1.34 -3,3v46c0,1.66 1.34,3 3,3c1.66,0 3,-1.34 3,-3v-46c0,-1.66 -1.34,-3 -3,-3z"></path></g></g>
            </svg>
          </button>
        </td>
      </tr>
      </tbody>
    </table>
    <fieldset>
      <legend class="ml-3 text-sm/6 font-semibold text-gray-900">Tipo de Entrega</legend>
      <div class="mt-4 ml-3 inline-flex gap-x-5">
          <div class="flex items-center gap-x-2">
            <input id="retirada" name="tipoEntrega" type="radio" checked class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
            <label for="push-email" class="block text-sm/6 font-medium text-gray-900">Retirada</label>
          </div>

        <div class="flex items-center gap-x-2">
          <input id="entrega" name="tipoEntrega" type="radio" class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
          <label for="push-everything" class="block text-sm/6 font-medium text-gray-900">Entrega</label>
        </div>
      </div>
    </fieldset>

    <div class="flex justify-center items-center mt-4">
      <button class="text-center rounded-md w-[50%] mt-6 bg-purple-900 py-2 px-4 border border-transparent text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-cyan-700 focus:shadow-none active:bg-cyan-700 hover:bg-purple-950 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="submit">
        Enviar pedido
      </button>
    </div>
  </div>
</template>

<style scoped>

</style>