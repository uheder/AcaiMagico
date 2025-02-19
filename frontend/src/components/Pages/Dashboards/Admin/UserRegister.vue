<script setup>
import DefaultAdminLayout from "../../../DefaultAdminLayout.vue";
</script>

<template>
  <DefaultAdminLayout>
    <header class="bg-white shadow-sm">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Cadastro de Usuário</h1>
      </div>
    </header>
    <main>
      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="#" method="POST">
          <div>
            <label for="user" class="block text-sm/6 font-medium text-gray-900">Nome de Usuário</label>
            <div class="mt-2">
              <input name="user" id="user" required="" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
          </div>


          <!--        ROLE-->
          <div>
            <label for="role" class="block text-sm/6 font-medium text-gray-900">Função</label>
            <div class="mt-2">
              <input name="role" id="role" required="" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
          </div>

          <!--        PASSWORD-->
          <div>
            <div class="flex items-center justify-between">
              <label for="password" class="block text-sm/6 font-medium text-gray-900">Senha</label>
            </div>
            <div class="mt-2">
              <input type="password" name="password" id="password" required="" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
          </div>

          <!-- REPEAT PASSWORD -->
          <div>
            <div class="flex items-center justify-between">
              <label for="repeat_password" class="block text-sm/6 font-medium text-gray-900">Repita a senha</label>
            </div>
            <div class="mt-2">
              <input type="password" name="repeat_password" id="repeat_password" required="" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
          </div>
          <!-- ADMIN PASSWORD -->
          <div>
            <div class="flex items-center justify-between">
              <label for="password" class="block text-sm/6 font-medium text-gray-900">Senha do Admin</label>
            </div>
            <div class="mt-2">
              <input type="password" name="repeat_password" required="" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
          </div>

          <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cadastrar Usuário</button>
          </div>
        </form>
      </div>
    </main>
  </DefaultAdminLayout>
</template>

<style scoped>

</style>