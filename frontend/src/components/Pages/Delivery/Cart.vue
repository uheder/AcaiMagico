<script setup>
import useCartStore from "../../../store/cart.js";
import {storeToRefs} from "pinia";
import {onMounted, ref, toRaw} from "vue";
import useOrderStore from "../../../store/order.js";
import router from "../../../router.js";

const cartStore = useCartStore();
const orderStore = useOrderStore();
const {cart} = storeToRefs(cartStore);

onMounted(() => {
  cartStore.fetchCart();
})

const bairros = [
  "Casqueira",
  "Centro",
  "COHAB",
  "Conjunto Ipe",
  "Ilha",
  "Metrô",
  "Nordeste",
  "Nossa Senhora dos Navegantes",
  "Parabólica",
  "Pedrinhas",
  "Plataforma",
  "Ponta do Mel",
  "Povoado Cristovão",
  "Povoado de Redonda",
  "Povoado Redonda",
  "Praia de Upanema",
  "Upanema de Cima",
  "Salinópolis",
  "Somoban",
  "Zona Rural",
  "NORSAL",
]

const data = ref({
  nome_cliente: '',
  observacao: '',
  tipo_entrega: 'Retirada',
  telefone_cliente: '',
  rua: '',
  numero: '',
  bairro: '',
  referencia: '',
  forma_pagamento: 'Dinheiro',
  troco: false,
  troco_para: null
})


const enviarPedido = () => {
  orderStore.createOrder(data.value);
  router.push({name: 'Orders'})
}
</script>

<template>
  <div
      class="sm:max-w-full md:max-w-[90%]  lg:w-[75%] xl:max-w-[60%] justify-between items-center mx-auto mb-3 mt-1 pl-2">
    <div>
      <h3 class="text-lg font-semibold text-slate-800">Seu carrinho</h3>
      <div class="grid grid-cols-2 gap-2 mt-2">
        <p class="text-slate-500">Confira os itens selecionados</p>
        <RouterLink to="Home" class="justify-items-end pr-2"><img src="/svgHome.svg" class="h6 w-6"
                                                                  alt="Retornar a pagina principal"></RouterLink>
      </div>
    </div>
  </div>
   <div
        class="sm:max-w-full md:max-w-[90%]  lg:w-[75%] xl:max-w-[60%] justify-center items-center mx-auto h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
     <div v-if="cart.length > 0">
      <table class="w-full text-left table-auto min-w-max">
        <thead>
        <tr class="border-b border-slate-300 bg-slate-50">
          <th class="p-4 text-sm font-normal leading-none text-slate-500">Item</th>
          <th class="p-4 text-sm font-normal leading-none text-slate-500">Quantidade</th>
          <th class="p-4 text-sm font-normal leading-none text-slate-500">Total por item</th>
          <th class="p-4 text-sm font-normal leading-none text-slate-500"></th>
        </tr>
        </thead>
        <tbody v-for="(item, index) in cart" :key="index">
        <tr class="hover:bg-slate-50">
          <td class="p-4 border-b border-slate-200 py-5">
            <p class="block font-semibold text-sm text-slate-800">Tamanho: {{ item.tamanho.name }}</p>
            <p class="block font-semibold text-sm text-slate-800">Cremes:
              {{ item.creme.map(creme => creme.name).join(', ') }}</p>
            <p class="block font-semibold text-sm text-slate-800">Recheios:
              {{ item.recheio.length > 0 ? item.recheio.map(recheio => recheio.name).join(', ') : 'Sem' }} </p>
            <p class="block font-semibold text-sm text-slate-800">Acompanhamentos:
              {{ item.acompanhamento.length > 0 ? item.acompanhamento.map(acompanhamento => acompanhamento.name).join(', ') : 'Sem' }} </p>
            <p class="block font-semibold text-sm text-slate-800">Coberturas:
              {{ item.cobertura.length > 0 ? item.cobertura.map(cobertura => cobertura.name).join(', ') : 'Sem' }}</p>
          </td>
          <td class="p-4 border-b border-slate-200 py-5">
            <p class="text-sm text-slate-500 flex-auto max-w-[118px] min-w-[80px]">{{ item.quantidade}}</p>
          </td>
          <td class="p-4 border-b border-slate-200 py-5">
            <p class="text-sm text-slate-500">R$ {{ item.tamanho.valor * item.quantidade }}</p>
          </td>
          <td class="p-4 border-b border-slate-200 py-5">
            <button type="button" @click="cartStore.removeFromCart(index)" class="text-slate-500 hover:text-slate-700">
              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="w-6 h-6" viewBox="0,0,256,256">
                <g fill="#9a0ee0" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                   stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                   font-family="none" font-weight="none" font-size="none" text-anchor="none"
                   style="mix-blend-mode: normal">
                  <g transform="scale(2,2)">
                    <path
                        d="M49,1c-1.66,0 -3,1.34 -3,3c0,1.66 1.34,3 3,3h30c1.66,0 3,-1.34 3,-3c0,-1.66 -1.34,-3 -3,-3zM24,15c-7.17,0 -13,5.83 -13,13c0,7.17 5.83,13 13,13h77v63c0,9.37 -7.63,17 -17,17h-40c-9.37,0 -17,-7.63 -17,-17v-52c0,-1.66 -1.34,-3 -3,-3c-1.66,0 -3,1.34 -3,3v52c0,12.68 10.32,23 23,23h40c12.68,0 23,-10.32 23,-23v-63.35937c5.72,-1.36 10,-6.50062 10,-12.64062c0,-7.17 -5.83,-13 -13,-13zM24,21h80c3.86,0 7,3.14 7,7c0,3.86 -3.14,7 -7,7h-80c-3.86,0 -7,-3.14 -7,-7c0,-3.86 3.14,-7 7,-7zM50,55c-1.66,0 -3,1.34 -3,3v46c0,1.66 1.34,3 3,3c1.66,0 3,-1.34 3,-3v-46c0,-1.66 -1.34,-3 -3,-3zM78,55c-1.66,0 -3,1.34 -3,3v46c0,1.66 1.34,3 3,3c1.66,0 3,-1.34 3,-3v-46c0,-1.66 -1.34,-3 -3,-3z"></path>
                  </g>
                </g>
              </svg>
            </button>
          </td>
        </tr>
        </tbody>
      </table>

      <form @submit.prevent="enviarPedido()">
        <div class="space-y-10 ml-4 mr-4">

          <div class="mt-4">
            <!-- NOME DO CLIENTE -->
              <div class="mt-2">
                <label for="nome_cliente" class="block text-sm/6 font-medium text-gray-900">Nome</label>
                <input v-model="data.nome_cliente" name="nome_cliente" id="nome_cliente" required
                       placeholder="Nome e sobrenome"
                       class="block w-[50%] rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
              </div>

            <!-- OBSERVAÇÕES -->

            <div>
              <div class="mt-4">
              <label for="observacao" class="block text-sm/6 font-medium text-gray-900">Observação</label>
                <textarea v-model="data.observacao" placeholder="Insira sua observação para o pedido, se tiver alguma"
                          class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 resize-none"></textarea>
              </div>
            </div>


            <!-- TIPO DE ENTREGA -->
            <fieldset>
              <legend class="py-2 text-sm/6 font-semibold text-gray-900">Tipo de Entrega</legend>
              <div class="inline-flex gap-x-5">
                <div class="flex items-center gap-x-2">
                  <input id="retirada" checked v-model="data.tipo_entrega" name="tipo_entrega" value="Retirada" type="radio"
                         class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                  <label for="tipo_entrega" class="block text-sm/6 font-medium text-gray-900">Retirada</label>

                  <input id="entrega" v-model="data.tipo_entrega" name="tipo_entrega" value="Entrega" type="radio"
                         class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                  <label for="tipo_entrega" class="block text-sm/6 font-medium text-gray-900">Entrega</label>
                </div>

                <div class="flex items-center gap-x-2">

                </div>
              </div>
            </fieldset>

            <!-- INFORMAÇÕES DE ENTREGA -->
            <div v-if="data.tipo_entrega === 'Entrega'">
                <div class="mt-2">
                <label for="telefone_cliente" class="block text-sm/6 font-medium text-gray-900">Telefone</label>
                  <input required v-model="data.telefone_cliente" minlength="9" maxlength="12" name="telefone_cliente"
                         id="nome_cliente" placeholder="Telefone para contato (Somente números)"
                         class="block w-full md:w-[50%] rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                </div>

              <div>
                <div class="mt-2">
                <label for="rua" class="block text-sm/6 font-medium text-gray-900">Rua</label>
                  <input required v-model="data.rua" name="rua" id="rua" placeholder="Nome da Rua"
                         class="w-full lg:w-[60%] rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                </div>

                <div class="mt-2">
                <label for="numero" class="block text-sm/6 font-medium text-gray-900">Numero</label>
                  <input required v-model="data.numero" name="numero" id="numero" placeholder="Número"
                         class="w-[50%] md:w-[20%] lg:w-[10%] rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                </div>
              </div>

              <div class="mt-2">
                <label for="bairro" class="block text-sm/6 font-medium text-gray-900">Bairro</label>
                <select required v-model="data.bairro" class="rounded-md bg-white text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                  <option disabled>Bairro</option>
                  <option v-for="bairro in bairros" :key="bairro" id="bairro">{{ bairro }}</option>
                </select>
              </div>

              <div class="mt-2">
                <label for="referencia" class="block text-sm/6 font-medium text-gray-900">Ponto de Referencia</label>
                <textarea required v-model="data.referencia" placeholder="Ponto de Referencia"
                          class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 resize-none"></textarea>
              </div>

              <fieldset class="mt-4">
              <legend class="text-sm/6 font-semibold text-gray-900">Forma de Pagamento</legend>
                <div class="inline-flex gap-x-5">
                  <div class="flex items-center gap-x-2">
                    <input id="dinheiro" v-model="data.forma_pagamento" name="forma_pagamento" value="Dinheiro" type="radio" checked
                           class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                    <label for="forma_pagamento_dinheiro" class="block text-sm/6 font-medium text-gray-900">Dinheiro</label>
                  </div>

                  <div class="flex items-center gap-x-2">
                    <input id="cartao" v-model="data.forma_pagamento" name="forma_pagamento" value="Cartao" type="radio"
                           class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                    <label for="forma_pagamento_cartao" class="block text-sm/6 font-medium text-gray-900">Cartão</label>
                  </div>

                  <div class="flex items-center gap-x-2">
                    <input id="pix" v-model="data.forma_pagamento" name="forma_pagamento" value="Pix" type="radio"
                           class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                    <label for="forma_pagamento_pix" class="block text-sm/6 font-medium text-gray-900">Pix</label>
                  </div>
                </div>
              </fieldset>

              <fieldset v-if="data.forma_pagamento === 'Dinheiro'">
                <legend class="text-sm/6 font-semibold text-gray-900">Troco?</legend>
                <div class="inline-flex gap-x-5">
                  <div class="flex items-center gap-x-2">
                    <input type="radio" v-model="data.troco" name="troco" :value="false" id="troco" checked class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                    <label for="nao" class="block text-sm/6 font-medium text-gray-900">Não</label>

                    <input type="radio" v-model="data.troco" name="troco" :value="true" id="troco" class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                    <label for="sim" class="block text-sm/6 font-medium text-gray-900">Sim</label>
                  </div>
                </div>
              </fieldset>
              <fieldset v-if="data.troco">
                <legend class="text-sm/6 font-semibold text-gray-900">Para quanto?</legend>
                <input :required="data.troco" v-model="data.troco_para" name="troco_para" id="troco_para" placeholder="Troco para quanto?" class="block w-[50%] rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
              </fieldset>


            </div>
          </div>
        </div>
        <div class="flex justify-center items-center mt-4">
          <button
              class=" mb-2 text-center rounded-md w-[50%] mt-6 bg-purple-900 py-2 px-4 border border-transparent text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-cyan-700 focus:shadow-none active:bg-cyan-700 hover:bg-purple-950 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
              type="submit">
            Enviar pedido
          </button>
        </div>
      </form>
    </div>
     <div v-else>
       <div class="flex flex-col items-center justify-center h-screen bg-gray-100 text-gray-800">
         <div class="text-center">
           <p class="text-3xl font-semibold text-purple-500 mb-4">Seu carrinho está vazio.</p>
           <p class="text-xl text-gray-600">Que tal adicionar alguns itens? 😄</p>
         </div>
       </div>
     </div>
  </div>



</template>

<style scoped>

</style>