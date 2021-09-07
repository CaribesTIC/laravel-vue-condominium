<template>
  <div class="demo-tab">
    <div class="panel mt-6">
      <form @submit.prevent="submit" class="p-0">
        <div class="grid lg:grid-cols-2 gap-4">
          <!-- name -->
          <label class="block">
            <span class="text-gray-700">Nombre de la vivienda</span>
            <input v-model="form.name" type="text" class="" />
            <div v-if="errors.name" class="form-error">
              {{ errors.name }}
            </div>
          </label>
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
            <input v-model="form.location" type="text" class="" />
            <div v-if="errors.location" class="form-error">
              {{ errors.location }}
            </div>
          </label>
          
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
        </div>
        <div class="grid lg:grid-cols-2 gap-4 my-2">
          <!-- is_active -->
          <label class="block">
            <span class="text-gray-700">Habitada actualmente</span>
            <input v-model="form.is_active" type="checkbox" class="ml-2" />
          </label>          
        </div>
        <div class="mt-4 px-2 border-gray-100 flex justify-end space-x-2">
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
    <!--span>{{ this.propiedad[1] }}</span-->
  </div>  
</template>

<script>
export default {
  props: {    
    propiedad: Array
  },
  data() {
    return {
      form: this.propiedad[0].form,
      users: this.propiedad[0].users,
      dwellingTypes: this.propiedad[0].dwellingTypes,
      errors: this.propiedad[1]
    }
  }
}
</script>
