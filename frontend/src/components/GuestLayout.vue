<script setup>
import {Disclosure} from "@headlessui/vue";
import {useRoute} from "vue-router";

const navigation = [
  { name: 'Pagina Inicial', to: {name:'Home'} },
  { name: 'Cardápio', to: {name:'Cardapio'} },
  { name: 'Carrinho', to: {name:'Cart'} },
];

const route = useRoute()

</script>

<template>
  <div class="sm:w-full md:w-[90%]  lg:w-[75%] xl:w-[70%] mx-auto mb-3 mt-1 pl-2 pr-2">
    <Disclosure as="nav" class="bg-purple-950 rounded-md">
      <div class="mx-auto max-w-7xl">
        <div class="flex h-10 items-center justify-between">
          <div class="flex items-center">
              <div class="ml-4 flex items-center justify-center">
                <RouterLink v-for="item in navigation" :key="item.name" :to="item.to" :class="[route.name === item.to.name ? 'bg-purple-900 text-white opacity-90' : 'text-gray-300 hover:bg-purple-900', 'rounded-md px-3 py-2 text-sm font-medium']" :aria-current="route.name === item.to.name ? 'page' : undefined">{{ item.name }}</RouterLink>
              </div>
          </div>
        </div>
      </div>
    </Disclosure>
    <slot></slot>
  </div>
</template>

<style scoped>

</style>