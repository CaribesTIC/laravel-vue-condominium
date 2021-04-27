<template>
  <div>
    <!--div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('articles')">
        <icon name="printer" class="w-4 h-4 mr-2" :class="isUrl('articles') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('articles') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Artículos</div>
      </inertia-link>
    </div>
    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('shopcart')">
        <icon name="printer" class="w-4 h-4 mr-2" :class="isUrl('shopcart') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('shopcart') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Carrito</div>
      </inertia-link>
    </div>
    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('clients.index')">
        <icon name="printer" class="w-4 h-4 mr-2" :class="isUrl('clients.index') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('clients.index') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Clientes</div>
      </inertia-link>
    </div>
    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('dashboard')">
        <icon name="dashboard" class="w-4 h-4 mr-2" :class="isUrl('') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Dashboard</div>
      </inertia-link>
    </div>
    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('posts.index')">
        <icon name="office" class="w-4 h-4 mr-2" :class="isUrl('posts.index') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('posts.index') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Publicaciones</div>
      </inertia-link>
    </div>
    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('replacements.index')">
        <icon name="office" class="w-4 h-4 mr-2" :class="isUrl('replacements.index') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('replacements.index') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Reposiciones</div>
      </inertia-link>
    </div>
    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('users.index')">
        <icon name="users" class="w-4 h-4 mr-2" :class="isUrl('users.index') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('users.index') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Usuarios</div>
      </inertia-link>
    </div-->
    
    <div class="mb-4">
    <recursive-menu></recursive-menu>
    </div>


  </div>
</template>

<script>
import Icon from '@/Shared/Icon'
import RecursiveMenu from '@/Shared/RecursiveMenu/Index'

export default {
  components: {
    Icon,
    RecursiveMenu
  },
  props: {
    url: String,
  },
  methods: {
    isUrl(...urls) {
      if (urls[0] === '') {
        return this.url === ''
      }

      return urls.filter(url => this.url.startsWith(url)).length
    },
  },
}
</script>
