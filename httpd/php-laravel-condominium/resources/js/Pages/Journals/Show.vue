<template>
  <div>
    <page-header> Mostrar journal </page-header>
    <div class="flex space-x-2">
      <inertia-link class="btn btn-primary" :href="route('journals.index')">
        Ver todas
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
              <th class="">Fecha</th>
              <td class="">{{ journal.date }}</td>
            </tr>
            <tr class="">
              <th class="">Usuario</th>
              <td class="">{{ journal.user.name }}</td>
            </tr>
            <tr class="">
              <th class="">Tarea</th>
              <td class="">{{ journal.task.name }}</td>              
            </tr>
            <tr class="">
              <th class="">Zona</th>
              <td class="">{{ journal.zone.name }}</td>              
            </tr>
            <tr class="">
              <th class="">Entrada</th>
              <td class="">{{ journal.input }}</td>              
            </tr>
            <tr class="">
              <th class="">Salida</th>
              <td class="">{{ journal.output }}</td>              
            </tr>  
          </tbody>
        </table>
      </div>
     </div>
  </div>
</template>

<script>
import Layout from "@/Layouts/AppLayout";
import LoadingButton from "@/Shared/LoadingButton";
import PageHeader from "@/Shared/PageHeader";

export default {
  name: 'Journal',
  layout: Layout,
  components: {
    LoadingButton,
    PageHeader,
  },
  props: {
    journal: Object
  }
};
</script>
