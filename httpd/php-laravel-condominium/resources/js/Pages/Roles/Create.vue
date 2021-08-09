<template>
  <div>
    <page-header> Crear rol </page-header>
    <div class="flex space-x-2">
      <inertia-link class="btn btn-primary" :href="route('roles')">
        Ver todos
      </inertia-link>
    </div>

    <div class="panel mt-6">
      <form @submit.prevent="submit" class="p-4">
        <div class="grid lg:grid-cols-2 gap-4">
          <!-- name -->
          <label class="block">
            <span class="text-gray-700">Nombre del rol</span>
            <input v-model="form.name" type="text" class="" />
            <div v-if="errors.name" class="form-error">
              {{ errors.name }}
            </div>
          </label>          
        </div><br/>
        <div class="table-data__wrapper">
          <table class="table-data">
            <thead>
              <tr class=""> 
                <th class="">Opciones del Menú</th>                             
                <th><input type="checkbox" @click="selectAll" v-model="allSelected" title="Seleccionar todos"></th>
              </tr>
            </thead>
          <tbody>              
            <tr v-for="menu in menus" :key="menu.id" class="hover:bg-gray-100 focus-within:bg-gray-100">               
              <td class="">{{ menu.alias }}</td>                         
              <td class="">              
                <div v-if="menu.path !== '#'" class="flex items-center space-x-1">                                
                  <input type="checkbox" v-model="form.menuIds" @click="select" :value="menu.id">
                </div>
              </td>               
            </tr>                
          </tbody>            
        </table>      
      </div>
      <span>Checked names: {{ form.menuIds }}</span>
      <div class="mt-6 px-2 border-gray-100 flex justify-end space-x-2">
        <loading-button
          :loading="sending"
          class="btn btn-primary ml-auto"
          type="submit"
        >
          Guardar
        </loading-button>
      </div>
    </form>
  </div>
</div>
</template>

<script>
import Layout from "@/Layouts/AppLayout";
import LoadingButton from "@/Shared/LoadingButton";
import PageHeader from "@/Shared/PageHeader";
//https://v3.vuejs.org/guide/forms.html#checkbox
export default {
  metaInfo: { title: "Create Zone" },
  layout: Layout,
  components: {
    LoadingButton,
    PageHeader,
  },
  props: {
    errors: Object,
    menus: Array,
  },
  data() {
    return {
      sending: false,           
      allSelected: false,
      selected: [],        
      form: {
        name: null,
        menuIds: []
      }
    };
  },
  methods: {
    selectAll: function() {      
      if (!this.allSelected) {        
        let temp = [];
        this.menus.forEach(function (menu) {
          if (menu.path !== '#')
              temp.push(menu.id);
        });
        this.form.menuIds=[];
        this.form.menuIds=temp;
        this.allSelected=true;                     
      } else {
        this.form.menuIds=[];        
        this.allSelected=false;
      }      
    },
    select: function() {
      this.allSelected = false;
    },
    submit() {
      this.$inertia.post(this.route("zones.store"), this.form, {
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
        onSuccess: () => {
          if (Object.keys(this.$page.props.errors).length === 0) {
            this.form.password = null;
          }
        },
        onError: () => {
          this.errors = this.$page.props.errors;
        },
      });
    },
  },
};
</script>
