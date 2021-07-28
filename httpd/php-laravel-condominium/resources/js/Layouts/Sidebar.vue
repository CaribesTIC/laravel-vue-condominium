<template>
  <div class="flex">
    <!-- Backdrop -->
    <div
      :class="isOpen ? 'block' : 'hidden'"
      @click="isOpen = false"
      class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"
    ></div>
    <!-- End Backdrop -->

    <div
      :class="isOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
      class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform overflow-y-auto lg:translate-x-0 lg:static lg:inset-0 bg-gray-800 bg-gradient-to-b from-gray-700 to-gray-900"
    >
      <div class="px-1 py-1 w-full">
        <inertia-link :href="route('dashboard')">          
          <svg class="h-60 w-60" version="1.0" xmlns="http://www.w3.org/2000/svg"
 width="220.000000pt" height="229.000000pt" viewBox="0 0 220.000000 229.000000"
 preserveAspectRatio="xMidYMid meet">

<g transform="translate(0.000000,229.000000) scale(0.100000,-0.100000)"
fill="#FFFFFF" stroke="none">
<path d="M1396 2017 l-226 -172 40 -3 40 -3 0 -224 0 -224 165 -128 c166 -128
184 -150 153 -181 -7 -7 -27 -12 -45 -12 l-33 0 0 -415 0 -415 233 0 c127 0
238 4 244 8 10 6 13 181 15 798 l3 789 41 5 42 5 -132 101 c-72 56 -172 133
-223 172 l-91 71 -226 -172z m214 -272 l0 -45 -45 0 -45 0 0 45 0 45 45 0 45
0 0 -45z m110 0 l0 -45 -45 0 -45 0 0 45 0 45 45 0 45 0 0 -45z m-110 -115 l0
-40 -45 0 -45 0 0 40 0 40 45 0 45 0 0 -40z m110 0 l0 -40 -45 0 -45 0 0 40 0
40 45 0 45 0 0 -40z"/>
<path d="M853 1303 c-122 -93 -222 -171 -222 -175 -1 -5 17 -8 39 -8 l40 0 0
-114 0 -114 173 -132 c169 -130 207 -163 207 -181 0 -20 -42 -49 -70 -49 l-30
0 0 -145 0 -145 209 0 c115 0 216 3 225 6 14 5 16 54 16 440 l0 433 47 3 48 3
-218 168 c-119 92 -223 170 -230 172 -6 3 -112 -70 -234 -162z m217 -233 l0
-40 -45 0 -45 0 0 40 0 40 45 0 45 0 0 -40z m110 0 l0 -40 -45 0 -45 0 0 40 0
40 45 0 45 0 0 -40z m-110 -115 l0 -45 -45 0 -45 0 0 45 0 45 45 0 45 0 0 -45z
m110 0 l0 -45 -45 0 -45 0 0 45 0 45 45 0 45 0 0 -45z"/>
<path d="M361 756 l-224 -171 39 -5 39 -5 3 -160 c2 -112 6 -161 15 -167 21
-13 691 -10 705 4 8 8 12 60 12 169 l0 158 40 3 40 3 -207 160 c-114 88 -214
165 -222 171 -13 9 -57 -20 -240 -160z m209 -206 l0 -40 -45 0 -45 0 0 40 0
40 45 0 45 0 0 -40z m110 0 l0 -40 -45 0 -45 0 0 40 0 40 45 0 45 0 0 -40z
m-110 -115 l0 -45 -45 0 -45 0 0 45 0 45 45 0 45 0 0 -45z m110 0 l0 -45 -45
0 -45 0 0 45 0 45 45 0 45 0 0 -45z"/>
</g>
</svg>
        </inertia-link>
      </div>

      <div class="font-bold text-center text-gray-100 text-lg">
        {{ $page.props.username }}
      </div>

      <div class="flex justify-evenly mt-3 text-gray-100 text-xs">
        <inertia-link
          :href="route('myprofile.edit')"
          class="block border border-gray-500 hover:bg-gray-500 px-2 py-1 rounded-sm"
          >Mi cuenta</inertia-link
        >

        <inertia-link
          :href="route('logout')"
          class="block border border-gray-500 hover:bg-gray-500 px-2 py-1 rounded-sm"
          method="post"
          >Cerrar sesión</inertia-link
        >
      </div>
      
                <div class="mt-8 py-2 px-6">
    <recursive-menu></recursive-menu>
    </div>

      <nav class="mt-8">
     
        <inertia-link
          class="flex items-center duration-200 mt-4 py-2 px-6 border-l-4"
          :class="[route().current('dashboard*') ? activeClass : inactiveClass]"
          :href="route('dashboard')"
        >          
          <svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 10C2 5.58172 5.58172 2 10 2V10H18C18 14.4183 14.4183 18 10 18C5.58172 18 2 14.4183 2 10Z" fill="currentColor" />
            <path d="M12 2.25195C14.8113 2.97552 17.0245 5.18877 17.748 8.00004H12V2.25195Z" fill="currentColor" />
          </svg>
          <span class="mx-4">Dashboard</span>
        </inertia-link>
        
        <inertia-link
          class="flex items-center duration-200 mt-4 py-2 px-6 border-l-4"
          :class="[route().current('journals*') ? activeClass : inactiveClass]"
          :href="route('journals.index')"
        >          

          <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="thumbtack" class="h-5 w-5 svg-inline--fa fa-thumbtack fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M298.028 214.267L285.793 96H328c13.255 0 24-10.745 24-24V24c0-13.255-10.745-24-24-24H56C42.745 0 32 10.745 32 24v48c0 13.255 10.745 24 24 24h42.207L85.972 214.267C37.465 236.82 0 277.261 0 328c0 13.255 10.745 24 24 24h136v104.007c0 1.242.289 2.467.845 3.578l24 48c2.941 5.882 11.364 5.893 14.311 0l24-48a8.008 8.008 0 0 0 .845-3.578V352h136c13.255 0 24-10.745 24-24-.001-51.183-37.983-91.42-85.973-113.733z"></path></svg> 
          
          <span class="mx-4">Jornales</span>
        </inertia-link>
        
        <inertia-link
          class="flex items-center duration-200 mt-4 py-2 px-6 border-l-4"
          :class="[route().current('categories*') ? activeClass : inactiveClass]"
          :href="route('categories.index')"
        >
          
<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="layer-group" class="h-5 w-5 svg-inline--fa fa-layer-group fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M12.41 148.02l232.94 105.67c6.8 3.09 14.49 3.09 21.29 0l232.94-105.67c16.55-7.51 16.55-32.52 0-40.03L266.65 2.31a25.607 25.607 0 0 0-21.29 0L12.41 107.98c-16.55 7.51-16.55 32.53 0 40.04zm487.18 88.28l-58.09-26.33-161.64 73.27c-7.56 3.43-15.59 5.17-23.86 5.17s-16.29-1.74-23.86-5.17L70.51 209.97l-58.1 26.33c-16.55 7.5-16.55 32.5 0 40l232.94 105.59c6.8 3.08 14.49 3.08 21.29 0L499.59 276.3c16.55-7.5 16.55-32.5 0-40zm0 127.8l-57.87-26.23-161.86 73.37c-7.56 3.43-15.59 5.17-23.86 5.17s-16.29-1.74-23.86-5.17L70.29 337.87 12.41 364.1c-16.55 7.5-16.55 32.5 0 40l232.94 105.59c6.8 3.08 14.49 3.08 21.29 0L499.59 404.1c16.55-7.5 16.55-32.5 0-40z"></path></svg>          
          
          <span class="mx-4">Categorías</span>
        </inertia-link>
        
        <inertia-link
          class="flex items-center duration-200 mt-4 py-2 px-6 border-l-4"
          :class="[route().current('tasks*') ? activeClass : inactiveClass]"
          :href="route('tasks.index')"
        >
          
<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="tasks" class="h-5 w-5 svg-inline--fa fa-tasks fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M139.61 35.5a12 12 0 0 0-17 0L58.93 98.81l-22.7-22.12a12 12 0 0 0-17 0L3.53 92.41a12 12 0 0 0 0 17l47.59 47.4a12.78 12.78 0 0 0 17.61 0l15.59-15.62L156.52 69a12.09 12.09 0 0 0 .09-17zm0 159.19a12 12 0 0 0-17 0l-63.68 63.72-22.7-22.1a12 12 0 0 0-17 0L3.53 252a12 12 0 0 0 0 17L51 316.5a12.77 12.77 0 0 0 17.6 0l15.7-15.69 72.2-72.22a12 12 0 0 0 .09-16.9zM64 368c-26.49 0-48.59 21.5-48.59 48S37.53 464 64 464a48 48 0 0 0 0-96zm432 16H208a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h288a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-320H208a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h288a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16zm0 160H208a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h288a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z"></path></svg>         
          
          <span class="mx-4">Tareas</span>
        </inertia-link>

        <inertia-link
          class="flex items-center duration-200 mt-4 py-2 px-6 border-l-4"
          :class="[route().current('zones*') ? activeClass : inactiveClass]"
          :href="route('zones.index')"
        >          

<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="grip-horizontal" class="h-5 w-5 svg-inline--fa fa-grip-horizontal fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M96 288H32c-17.67 0-32 14.33-32 32v64c0 17.67 14.33 32 32 32h64c17.67 0 32-14.33 32-32v-64c0-17.67-14.33-32-32-32zm160 0h-64c-17.67 0-32 14.33-32 32v64c0 17.67 14.33 32 32 32h64c17.67 0 32-14.33 32-32v-64c0-17.67-14.33-32-32-32zm160 0h-64c-17.67 0-32 14.33-32 32v64c0 17.67 14.33 32 32 32h64c17.67 0 32-14.33 32-32v-64c0-17.67-14.33-32-32-32zM96 96H32c-17.67 0-32 14.33-32 32v64c0 17.67 14.33 32 32 32h64c17.67 0 32-14.33 32-32v-64c0-17.67-14.33-32-32-32zm160 0h-64c-17.67 0-32 14.33-32 32v64c0 17.67 14.33 32 32 32h64c17.67 0 32-14.33 32-32v-64c0-17.67-14.33-32-32-32zm160 0h-64c-17.67 0-32 14.33-32 32v64c0 17.67 14.33 32 32 32h64c17.67 0 32-14.33 32-32v-64c0-17.67-14.33-32-32-32z"></path></svg>        
          
          <span class="mx-4">Zonas</span>
        </inertia-link>
        
        <inertia-link
          class="flex items-center duration-200 mt-4 py-2 px-6 border-l-4"
          :class="[
            route().current('posts.index*') ? activeClass : inactiveClass,
          ]"
          :href="route('posts.index')"
        >
        
        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M7 3C6.44772 3 6 3.44772 6 4C6 4.55228 6.44772 5 7 5H13C13.5523 5 14 4.55228 14 4C14 3.44772 13.5523 3 13 3H7Z" fill="currentColor" />
          <path d="M4 7C4 6.44772 4.44772 6 5 6H15C15.5523 6 16 6.44772 16 7C16 7.55228 15.5523 8 15 8H5C4.44772 8 4 7.55228 4 7Z" fill="currentColor" />
          <path d="M2 11C2 9.89543 2.89543 9 4 9H16C17.1046 9 18 9.89543 18 11V15C18 16.1046 17.1046 17 16 17H4C2.89543 17 2 16.1046 2 15V11Z"
fill="currentColor" />
        </svg>
        
          <span class="mx-4">Publicaciones</span>
        </inertia-link>
        
        <inertia-link
          class="flex items-center duration-200 mt-4 py-2 px-6 border-l-4"
          :class="[
            route().current('dwelling-types.index*') ? activeClass : inactiveClass,
          ]"
          :href="route('dwelling-types.index')"
        >
        
        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M7 3C6.44772 3 6 3.44772 6 4C6 4.55228 6.44772 5 7 5H13C13.5523 5 14 4.55228 14 4C14 3.44772 13.5523 3 13 3H7Z" fill="currentColor" />
          <path d="M4 7C4 6.44772 4.44772 6 5 6H15C15.5523 6 16 6.44772 16 7C16 7.55228 15.5523 8 15 8H5C4.44772 8 4 7.55228 4 7Z" fill="currentColor" />
          <path d="M2 11C2 9.89543 2.89543 9 4 9H16C17.1046 9 18 9.89543 18 11V15C18 16.1046 17.1046 17 16 17H4C2.89543 17 2 16.1046 2 15V11Z"
fill="currentColor" />
        </svg>
        
          <span class="mx-4">Tipos de Vivienda</span>
        </inertia-link>
        
        <inertia-link
          class="flex items-center duration-200 mt-4 py-2 px-6 border-l-4"
          :class="[
            route().current('users.index*') ? activeClass : inactiveClass,
          ]"
          :href="route('users.index')"
        >
          
          <svg
            aria-hidden="true"
            focusable="false"
            data-prefix="fas"
            data-icon="users"
            class="h-5 w-5 svg-inline--fa fa-users fa-w-20"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 640 512"
          ><path fill="currentColor" d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm32 32h-64c-17.6 0-33.5 7.1-45.1 18.6 40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64zm-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zm-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z"></path>
          </svg>        
                    
          <span class="mx-4">Usuarios</span>
        </inertia-link>        
        
        <inertia-link
          class="flex items-center duration-200 mt-4 py-2 px-6 border-l-4"
          :class="[route().current('settings*') ? activeClass : inactiveClass]"
          :href="route('settings.edit')"
        >
          
          <svg
            aria-hidden="true"
            focusable="false"
            data-prefix="fas"
            data-icon="cog"
            class="h-5 w-5 svg-inline--fa fa-cog fa-w-16"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
          ><path fill="currentColor" d="M487.4 315.7l-42.6-24.6c4.3-23.2 4.3-47 0-70.2l42.6-24.6c4.9-2.8 7.1-8.6 5.5-14-11.1-35.6-30-67.8-54.7-94.6-3.8-4.1-10-5.1-14.8-2.3L380.8 110c-17.9-15.4-38.5-27.3-60.8-35.1V25.8c0-5.6-3.9-10.5-9.4-11.7-36.7-8.2-74.3-7.8-109.2 0-5.5 1.2-9.4 6.1-9.4 11.7V75c-22.2 7.9-42.8 19.8-60.8 35.1L88.7 85.5c-4.9-2.8-11-1.9-14.8 2.3-24.7 26.7-43.6 58.9-54.7 94.6-1.7 5.4.6 11.2 5.5 14L67.3 221c-4.3 23.2-4.3 47 0 70.2l-42.6 24.6c-4.9 2.8-7.1 8.6-5.5 14 11.1 35.6 30 67.8 54.7 94.6 3.8 4.1 10 5.1 14.8 2.3l42.6-24.6c17.9 15.4 38.5 27.3 60.8 35.1v49.2c0 5.6 3.9 10.5 9.4 11.7 36.7 8.2 74.3 7.8 109.2 0 5.5-1.2 9.4-6.1 9.4-11.7v-49.2c22.2-7.9 42.8-19.8 60.8-35.1l42.6 24.6c4.9 2.8 11 1.9 14.8-2.3 24.7-26.7 43.6-58.9 54.7-94.6 1.5-5.5-.7-11.3-5.6-14.1zM256 336c-44.1 0-80-35.9-80-80s35.9-80 80-80 80 35.9 80 80-35.9 80-80 80z"></path>
          </svg>          
          
          <span class="mx-4">Ajustes</span>
        </inertia-link>

      </nav>
      

    </div>
    

    
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";
import { useSidebar } from "../hooks/useSidebar.js";
import RecursiveMenu from "@/Layouts/RecursiveMenu/Index";

export default defineComponent({
components: {
    //Icon,
    RecursiveMenu
  },
  setup() {
    const { isOpen } = useSidebar();
    const activeClass = ref(
      "bg-gray-600 bg-opacity-25 text-gray-100 border-gray-100"
    );
    const inactiveClass = ref(
      "border-gray-900 text-gray-500 hover:bg-gray-600 hover:bg-opacity-25 hover:text-gray-100"
    );

    return {
      isOpen,
      activeClass,
      inactiveClass,
    };
  },
});
</script>
