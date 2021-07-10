<template>
  <div>
    <page-header> Mostrar actividad </page-header>
    <div class="flex space-x-2">
      <inertia-link class="btn btn-primary" :href="route('categories.index')">
        Ver todos
      </inertia-link>
    </div>
    
    <div class="panel mt-6 p-4">      
      <div class="table-data__wrapper">
        <table class="table-data">
          <thead>
            <tr class="">
              <th class="w-2/5">Dato</th>
              <th class="w-3/5">Valor</th>
            </tr>
          </thead>      
          <tbody>
            <tr class="">
              <th class="">Nombre</th>
              <td class="">{{ category.name }}</td>
            </tr>    
          </tbody>
        </table>
      </div>
    </div>
    
    <div class="panel mt-6">
      <div class="p-4">
        <div class="table-data__wrapper">
          <table class="table-data">
            <thead>
              <tr class="">
                <th class="">Tarea</th>
                <th class="">Descripción</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="task in category.tasks" :key="task.id" class="">
                <td class="w-2/5">
                  {{ task.name }}
                </td>
                <td class="w-2/5">
                  {{ task.description }}
                </td>
              </tr>
              <tr v-if="activity.tasks.length === 0">
                <td class="" colspan="4">Categorías no encontradas.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
      
  </div>
</template>

<script>
import Layout from "@/Layouts/AppLayout";
import PageHeader from "@/Shared/PageHeader";

export default {
  layout: Layout,
  components: { PageHeader },
  props: { category: Object }
};
</script>
