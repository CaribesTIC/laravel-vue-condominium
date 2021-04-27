<template>
  <div>  
    <page-header>      
        <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('users.index')">Usuarios</inertia-link>
        <span class="text-indigo-400 font-medium">/</span> Crear
    </page-header>
    <div class="py-2">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
          <div class="bg-white rounded shadow overflow-hidden max-w-full">
            <form @submit.prevent="submit">
              <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                <!--text-input
                  v-model="form.first_name"
                  :error="errors.first_name"
                  class="pr-6 pb-8 w-full lg:w-1/2"
                  label="First name" />
                <text-input
                  v-model="form.last_name"
                  :error="errors.last_name"
                  class="pr-6 pb-8 w-full lg:w-1/2"
                  label="Last name" /-->
                <text-input
                  v-model="form.name"
                  :error="errors.name"
                  class="pr-6 pb-8 w-full lg:w-1/2"
                  label="Nombre" /> 
                <text-input
                  v-model="form.email"
                  :error="errors.email"
                  class="pr-6 pb-8 w-full lg:w-1/2"
                  label="Correo" />
                <text-input
                  v-model="form.password"
                  :error="errors.password"
                  class="pr-6 pb-8 w-full lg:w-1/2"
                  type="password"
                  autocomplete="new-password"
                  label="Contraseña" />
                <select-input v-model="form.owner" :error="errors.owner" class="pr-6 pb-8 w-full lg:w-1/2" label="Dueño">
                  <option :value="1">Yes</option>
                  <option :value="2">No</option>
                </select-input>
                <file-input
                  v-model="form.photo"
                  :error="errors.photo"
                  class="pr-6 pb-8 w-full lg:w-1/2"
                  type="file"
                  accept="image/*"
                  label="Foto" />
              </div>
              <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                <loading-button
                  :loading="sending"
                  class="ml-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3" type="submit">
                      Crear Usuario
                </loading-button>
              </div>
            </form>
          </div>   
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import LoadingButton from '@/Shared/LoadingButton'
import SelectInput from '@/Shared/SelectInput'
import PageHeader from '@/Shared/PageHeader'
import TextInput from '@/Shared/TextInput'
import FileInput from '@/Shared/FileInput'

export default {
  metaInfo: { title: 'Create User' },
  layout: Layout,
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
    FileInput,
    PageHeader
  },
  props: {
    errors: Object,
  },
  remember: 'form',
  data() {
    return {
      sending: false,
      form: {
        //first_name: null,
        //last_name: null,
        name: null,
        email: null,
        password: null,
        owner: 2,
        photo: null,
      },
    }
  },
  methods: {
    submit() {
      const data = new FormData()
      //data.append('first_name', this.form.first_name || '')
      //data.append('last_name', this.form.last_name || '')
      data.append('name', this.form.name || '')      
      data.append('email', this.form.email || '')
      data.append('password', this.form.password || '')
      data.append('owner', this.form.owner || '2')
      data.append('photo', this.form.photo || '')

      this.$inertia.post(this.route('users.store'), data, {
        onStart: () => this.sending = true,
        onFinish: () => this.sending = false,
      })
    },
  },
}
</script>
