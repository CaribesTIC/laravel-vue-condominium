<template>
  <div>
    <page-header> Mostrar rol </page-header>
    <div class="flex space-x-2">
      <inertia-link class="btn btn-primary" :href="route('roles')">
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
              <th class="">Nombre del rol</th>
              <td class="">{{ form.name }}</td>
            </tr>
            <tr class="">
              <th valign="top">Opciones del menú</th>
              <td class="">             
                <ol class="list-disc list-inside" v-for="menu in menus" :key="menu.id">
                  <li v-if="form.menu_ids.includes(menu.id)">{{ menu.alias }}</li> 
                </ol>
              </td>
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
  metaInfo: { title: "Show Role" },
  name: "Show Role",
  layout: Layout,
  components: {
    LoadingButton,
    PageHeader,
  },
  props: {
    menus: Array,
    role: Object,
  },
  data() {
    return {      
      form: {
        name: this.role.name,
        menu_ids: this.role.menu_ids,
      },
    };
  },
};
</script>
