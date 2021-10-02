<template>
  <div>
    <page-header> Mostrar usuario </page-header>
    <div class="flex space-x-2">
      <Link class="btn btn-primary" :href="route('dwellings')">
        Ver todos
      </Link>
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
              <td class="">{{ dwelling.name }}</td>
            </tr>
            <tr class="">
              <th class="">Tipo de Vivienda</th>
              <td class="">{{ dwelling.dwelling_type.name }}</td>
            </tr>
            <tr class="">
              <th class="">Localización</th>
              <td class="">{{ dwelling.location }}</td>              
            </tr>        
            <tr class="">
              <th class="">Alíquota</th>
              <td class="">{{ dwelling.aliquot }}</td>              
            </tr>
	    <tr class="">
              <th class="">Usuario</th>
              <td class="">
                <Link
                  class="text-indigo-600 hover:text-indigo-800 underline"
                  :href="route('users.show', dwelling.user.id)"
                  tabindex="-1"
                >
                  {{ dwelling.user.name }}
                </Link>
		</td>              
            </tr>
	  </tbody>
        </table>
      </div>
     </div>
  </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import Layout from "@/Layouts/AppLayout";
import PageHeader from "@/Shared/PageHeader";

export default {
  layout: Layout,
  components: {
    Link,
    PageHeader
  },
  props: { dwelling: Object }
};
</script>
