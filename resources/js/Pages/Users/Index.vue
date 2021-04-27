<template>
  <div>      
    <page-header>Usuarios</page-header>
    <div class="py-2">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
        
          <div class="mb-6 flex justify-between items-center">
            <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
              <label class="block text-gray-700">Role:</label>
              <select v-model="form.role" class="mt-1 w-full form-select">
                <option :value="null" />
                <option value="user">User</option>
                <option value="owner">Owner</option>
              </select>
              <label class="mt-4 block text-gray-700">Trashed:</label>
              <select v-model="form.trashed" class="mt-1 w-full form-select">
                <option :value="null" />
                <option value="with">With Trashed</option>
                <option value="only">Only Trashed</option>
              </select>
            </search-filter>
            <inertia-link
              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3"
              :href="route('users.create')">
                <span>Crear</span>
                <span class="hidden md:inline">Usuario</span>
            </inertia-link>
          </div>
          <div class="bg-white rounded shadow overflow-x-auto">      
            <table class="table-fixed w-full whitespace-no-wrap">
              <thead>
                <tr class="bg-gray-200 text-left font-bold">
                <th class="px-6 pt-6 pb-4">Nombre</th>
                <th class="px-6 pt-6 pb-4">Correo</th>
                <th class="px-6 pt-6 pb-4" colspan="2">Role</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in users" :key="user.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                <td class="border-t">
                  <inertia-link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('users.edit', user.id)">
                    <img v-if="user.photo" class="block w-5 h-5 rounded-full mr-2 -my-2" :src="user.photo">
                    {{ user.name }}
                    <icon v-if="user.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" />
                  </inertia-link>
                </td>
                <td class="border-t">
                  <inertia-link class="px-6 py-4 flex items-center" :href="route('users.edit', user.id)" tabindex="-1">
                    {{ user.email }}
                  </inertia-link>
                </td>
                <td class="border-t">
                  <inertia-link class="px-6 py-4 flex items-center" :href="route('users.edit', user.id)" tabindex="-1">
                    {{ user.owner==1 ? 'Owner' : 'User' }}
                  </inertia-link>
                </td>
                <td class="border-t w-px">
                  <inertia-link class="px-4 flex items-center" :href="route('users.edit', user.id)" tabindex="-1">
                    <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                  </inertia-link>
                </td>
              </tr>
              <tr v-if="users.length === 0">
                <td class="border-t px-6 py-4" colspan="4">Usuarios no encontrados.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  </div>
</template>

<script>
import Icon from '@/Shared/Icon'
import Layout from '@/Shared/Layout'
import mapValues from 'lodash/mapValues'
import pickBy from 'lodash/pickBy'
import PageHeader from '@/Shared/PageHeader'
import SearchFilter from '@/Shared/SearchFilter'
import throttle from 'lodash/throttle'
import FlashMessages from '@/Shared/FlashMessages'

export default {
  metaInfo: { title: 'Users' },
  layout: Layout,
  components: {
    Icon,
    SearchFilter,
    FlashMessages,
    PageHeader
  },
  props: {
    users: Array,
    filters: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        role: this.filters.role,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    form: {
      handler: throttle(function() {
        let query = pickBy(this.form)
        this.$inertia.replace(this.route('users.index', Object.keys(query).length ? query : { remember: 'forget' }))
      }, 150),
      deep: true,
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },
}
</script>
