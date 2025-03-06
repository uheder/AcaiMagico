<script setup>

import GuestLayout from "../../GuestLayout.vue";
import LogoAcai from "/LogoAcai.jpg";
</script>

<template>
  <GuestLayout>
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto max-h-25 w-auto rounded-full " :src="LogoAcai" alt="Logo açai mágico"  />
      <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Entrar na sua conta</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="/login" method="POST">
        <div>
          <label for="username" class="block text-sm/6 font-medium text-gray-900">Nome de Usuário</label>
          <div class="mt-2">
            <input name="username" id="username" required="" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
          </div>
        </div>
        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm/6 font-medium text-gray-900">Senha</label>
          </div>
          <div class="mt-2">
            <input type="password" name="password" id="password"  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
          </div>
        </div>

        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Entrar</button>
        </div>
      </form>

      <p class="mt-10 text-center text-sm/6 text-gray-500">
        Não está cadastrado? Solicite o seu cadastro
      </p>
    </div>
  </GuestLayout>
</template>

<style scoped>

</style>