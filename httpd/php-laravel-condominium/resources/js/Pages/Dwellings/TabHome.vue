<template>
  <div class="demo-tab">
    <div class="panel mt-6">
      <form method ="post" @submit.prevent="submit" class="p-0">
        <div class="grid lg:grid-cols-2 gap-4">
          <!-- name -->
          <label class="block">
            <span class="text-gray-700">Nombre de la vivienda</span>
            <input v-model="form.name" type="text" class="" />
            <div v-if="errors.name" class="form-error">
              {{ errors.name }}
            </div>
          </label>
          <!-- dwelling_type_id -->
          <label class="block">
            <span class="text-gray-700">Tipo de Vivienda</span>
            <select v-model="form.dwelling_type_id" class="">
              <option v-for="dwellingType in dwellingTypes" :value="dwellingType.id" :key="dwellingType.id">
                {{ dwellingType.name }}
              </option>
            </select>
            <div v-if="errors.dwelling_type_id" class="form-error">
              {{ errors.dwelling_type_id }}
            </div>
          </label> 
        </div>
        
        <div class="grid lg:grid-cols-2 gap-4">          
          <!-- type -->
          <label class="block">
            <span class="text-gray-700">Localización</span>            
            <input v-model="form.location" type="number" class="" />
            <div v-if="errors.location" class="form-error">
              {{ errors.location }}
            </div>
          </label>
          <!-- type -->
          <label class="block">
            <span class="text-gray-700">Alícuota</span> 
            <input v-model="form.aliquot" type="number" step=".01" class="" />
            <div v-if="errors.aliquot" class="form-error">
              {{ errors.aliquot }}
            </div>
          </label>
        </div>
        <div class="grid lg:grid-cols-2 gap-4 my-2">

          <label class="block">
            <span class="text-gray-700">Usuario</span>            
             <select v-model="form.user_id" class="">
              <option v-for="user in users" :value="user.id" :key="user.id">
                {{ user.name }}
              </option>
            </select>
            <div v-if="errors.user_id" class="form-error">
              {{ errors.user_id }}
            </div>
          </label>
          <!-- is_habited -->
          <label class="block">
            <span class="text-gray-700">Habitada actualmente</span><br/>
            <input v-model="form.is_habited" type="checkbox" class="ml-2" />
          </label>
       
        </div>

        <!--div class="mt-4 px-2 border-gray-100 flex justify-end space-x-2">
          <loading-button
            :loading="sending"
            class="btn btn-primary ml-auto"
            type="submit"            
          >{{ sending ? 'Guardando...' : 'Guardar' }}</loading-button>
        </div-->

        <div class="mt-4 px-2 border-gray-100 flex justify-end space-x-2">
          <input
            :disabled="sending"
            type="submit"
            class="btn btn-primary"
            :value="sending ? 'Guardando...' : 'Guardar'"
          />
        </div>
        
      </form>
    </div>
    <!--span>{{ this.propiedad[1] }}</span-->
  </div>  
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import LoadingButton from "@/Shared/LoadingButton";

export default {
  components: {
    Inertia,  
    LoadingButton
  },
  props: {    
    propiedad: Object
  },
  data() {
    return {
      sending: false,
      isCreate: this.propiedad[0].isCreate,
      form: this.propiedad[0].form,
      users: this.propiedad[0].users,
      dwellingTypes: this.propiedad[0].dwellingTypes,
      errors: this.propiedad[1]
    }
  },
  methods: {
    submit() {      
      this.isCreate ? this.create() : this.update();      
    },
    create() {
      alert('create');
      //Inertia.visit(
      //  route("dwellins.create", { this.form })
      //);
    },
    async update() {
      this.sending = true;
      axios.interceptors.response.use(
        res => res,
        err => Promise.reject(err)
      );

      this.form._method = 'PUT';      
      axios.post(`../../dwellings/${this.form.id}`, this.form)
        .then(res => { 
          console.log(res.data);
          this.$page.props.flash.success="Excelente"
        })
        .catch(err => {
         // alert(err.message)
          this.$page.props.flash.error=err.message;
          }
        )
        .finally(() => this.sending = false);
    }
  }

}
/*
https://thedutchlab.com/blog/using-axios-interceptors-for-refreshing-your-api-token
https://blog.clairvoyantsoft.com/intercepting-requests-responses-using-axios-df498b6cab62
https://masteringjs.io/tutorials/axios/interceptors
https://axios-http.com/docs/interceptors
https://stackoverflow.com/questions/52737078/how-can-you-use-axios-interceptors
https://www.bezkoder.com/axios-interceptors-refresh-token/
https://www.it-swarm-es.com/es/javascript/como-puedes-usar-los-interceptores-axios/806909494/
https://www.it-swarm-es.com/es/javascript/como-puedes-usar-los-interceptores-axios/806909494/
*/
</script>








