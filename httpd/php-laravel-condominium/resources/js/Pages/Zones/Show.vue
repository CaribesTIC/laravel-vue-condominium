<template>
  <div>
    <page-header> Mostrar zona </page-header>
    <div class="flex space-x-2">
      <inertia-link class="btn btn-primary" :href="route('zones.index')">
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
              <td class="">{{ zone.name }}</td>
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
  props: { zone: Object }
};
</script>
