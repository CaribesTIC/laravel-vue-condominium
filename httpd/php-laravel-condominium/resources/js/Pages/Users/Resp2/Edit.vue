<template>
  <div>
    <page-header>      
        <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('users.index')">Usuarios</inertia-link>
        <span class="text-indigo-400 font-medium">/</span> {{ form.name }}
      <img v-if="user.photo" class="block w-8 h-8 rounded-full ml-4" :src="user.photo">
    </page-header>  
    <div class="py-2">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
          <trashed-message v-if="user.deleted_at" class="mb-6" @restore="restore">
            Este usuario ha sido eliminado.
          </trashed-message>
          <div class="bg-white rounded shadow overflow-hidden max-w-full">
            <form @submit.prevent="submit">
              <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                <text-input 
                  v-model:value="form.name"
                  :error="errors.name"
                  class="pr-6 pb-8 w-full lg:w-1/2"
                  label="Nombre" />
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
import TextInput from '@/Shared/TextInput'
import FileInput from '@/Shared/FileInput'
import TrashedMessage from '@/Shared/TrashedMessage'
import PageHeader from '@/Shared/PageHeader'

export default {
  metaInfo() {
    return {
      //https://v3.vuejs.org/guide/component-custom-events.html#validate-emitted-events
      //title: `${this.form.first_name} ${this.form.last_name}`,
      title: `${this.form.name}`,
    }
  },
  layout: Layout,
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
    FileInput,
    PageHeader,
    TrashedMessage,
  },
  props: {
    errors: Object,
    user: Object,
  },
  remember: 'form',
  data() {
    return {
      sending: false,
      form: {
        name: this.user.name,
        //first_name: this.user.first_name,
        //last_name: this.user.last_name,
        email: this.user.email,
        password: this.user.password,
        owner: this.user.owner,
        photo: null,
      },
    }
  },
  methods: {
    submit() {
      var data = new FormData()
      //data.append('first_name', this.form.first_name || '')
      //data.append('last_name', this.form.last_name || '')
      data.append('name', this.form.name || '')
      data.append('email', this.form.email || '')
      data.append('password', this.form.password || '')
      data.append('owner', this.form.owner)
      //data.append('owner', this.form.owner || '2')
      data.append('photo', this.form.photo || '')
      data.append('_method', 'put')

      this.$inertia.post(this.route('users.update', this.user.id), data, {
        onStart: () => this.sending = true,
        onFinish: () => this.sending = false,
        onSuccess: () => {
          if (Object.keys(this.$page.props.errors).length === 0) {
            this.form.photo = null
            this.form.password = null
          }
        },
      })
    },
    destroy() {
      if (confirm('Are you sure you want to delete this user?')) {
        this.$inertia.delete(this.route('users.destroy', this.user.id))
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this user?')) {
        this.$inertia.put(this.route('users.restore', this.user.id))
      }
    },
  },
}
</script>
