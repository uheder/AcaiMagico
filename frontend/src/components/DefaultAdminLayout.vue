<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'

const user = {
  name: 'Tom Cook',
  email: 'tom@example.com',
}

const navigation = [
  { name: 'Inicio', to: {name: 'Dashboard'}},
  { name: 'Pedidos', to: {name: 'Orders'} },
  { name: 'Entregas', to: {name: 'Deliveries'}},
  { name: 'Ingredientes', to: {name: 'Ingredients'}},
  { name: 'Tamanhos',  to: {name: 'Sizes'}},
  { name: 'Cadastro' , to: {name: 'UserRegister'}}
]
const userNavigation = [
  { name: 'Sair', href: '#' },
]
</script>

<template>
  <div class="sm:max-w-full md:max-w-[90%]  lg:w-[75%] xl:max-w-[60%] mx-auto justify-center items-center">
    <Disclosure as="nav" class="bg-purple-950" v-slot="{ open }">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <RouterLink v-for="item in navigation" :key="item.name" :to="item.to" :class="[$route.name === item.to.name ? 'bg-purple-900 text-white opacity-90' : 'text-gray-300 hover:bg-purple-900', 'rounded-md px-3 py-2 text-sm font-medium']" :aria-current="$route.name === item.to.name ? 'page' : undefined">{{ item.name }}
                </RouterLink>
              </div>
            </div>
          </div>
          <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">
              <!-- Profile dropdown -->
              <Menu as="div" class="relative ml-3">
                <div>
                  <MenuButton class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
                    <span class="absolute -inset-1.5" />
                    <span class="sr-only">Open user menu</span>
                    <img class="size-8 rounded-full" src="@/assets/LogoAcai.jpg" alt="Logo Açai Mágico" />
                  </MenuButton>
                </div>
                <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                  <MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 ring-1 shadow-lg ring-black/5 focus:outline-hidden">
                    <MenuItem v-for="item in userNavigation" :key="item.name">
                      <RouterLink :class="[$route.name === item.to.name ? 'bg-gray-100 outline-hidden' : '', 'block px-4 py-2 text-sm text-gray-700']" :to="item.to">{{ item.name }}</RouterLink>
                    </MenuItem>
                  </MenuItems>
                </transition>
              </Menu>
            </div>
          </div>
          <div class="-mr-2 flex md:hidden">
            <!-- Mobile menu button -->
            <DisclosureButton class="relative inline-flex items-center justify-center rounded-md bg-purple-900 p-2 text-purple-500 hover:bg-purple-800 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
              <span class="absolute -inset-0.5" />
              <span class="sr-only">Open main menu</span>
              <Bars3Icon v-if="!open" class="block size-6" aria-hidden="true" />
              <XMarkIcon v-else class="block size-6" aria-hidden="true" />
            </DisclosureButton>
          </div>
        </div>
      </div>


      <!-- Mobile config -->
      <DisclosurePanel class="md:hidden">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
          <DisclosureButton v-for="item in navigation" :key="item.name"  :to="item.to" :class="[$route.name === item.to.name ? 'bg-purple-900 text-white' : 'text-gray-300 hover:bg-purple-900 hover:text-white', 'block rounded-md px-3 py-2 text-base font-medium']" :aria-current="item.to.name ? 'page' : undefined">{{ item.name }}</DisclosureButton>
        </div>
        <div class="border-t border-gray-700 pt-4 pb-3">
          <div class="flex items-center px-5">
            <div class="shrink-0">
              <img class="size-10 rounded-full" :src="LogoAcai" alt="Logo Açaí Mágico" />
            </div>
            <div class="ml-3">
              <div class="text-base/5 font-medium text-white">{{ user.name }}</div>
              <div class="text-sm font-medium text-gray-400">{{ user.email }}</div>
            </div>

            <button type="button" class="relative ml-auto shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
              <span class="absolute -inset-1.5" />
            </button>
          </div>
          <div class="mt-3 space-y-1 px-2">

            <!-- Mobile logout button -->
            <DisclosureButton v-for="item in userNavigation" :key="item.name" as="a" :href="item.href" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-purple-900 hover:text-white">{{ item.name }}
            </DisclosureButton>
          </div>
        </div>
      </DisclosurePanel>
    </Disclosure>
    <slot></slot>
  </div>
</template>

<style scoped>

</style>