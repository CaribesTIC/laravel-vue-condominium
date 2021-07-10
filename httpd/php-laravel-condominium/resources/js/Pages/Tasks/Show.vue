<template>
  <div>
    <page-header> Mostrar usuario </page-header>
    <div class="flex space-x-2">
      <inertia-link class="btn btn-primary" :href="route('tasks.index')">
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
              <th class="">Tarea</th>
              <td class="">{{ task.name }}</td>
            </tr>
            <tr class="">
              <th class="">Descripción</th>
              <td class="">{{ task.description }}</td>
            </tr>
            <tr class="">
              <th class="">Categoría</th>
              <td class="">{{ task.category.name }}</td>
            </tr>
          </tbody>
        </table>
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
  props: { task: Object }
};
</script>
