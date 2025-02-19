<script>

import {defineComponent} from "vue";
import DefaultAdminLayout from "../../../DefaultAdminLayout.vue";

export default defineComponent({
  components: {DefaultAdminLayout}
})
</script>

<template>
  <DefaultAdminLayout>
    <header class="bg-white shadow-sm">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Relatórios</h1>
      </div>
    </header>
    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <strong>Relatórios</strong>
      </div>
    </main>
  </DefaultAdminLayout>
</template>

<style scoped>

</style>