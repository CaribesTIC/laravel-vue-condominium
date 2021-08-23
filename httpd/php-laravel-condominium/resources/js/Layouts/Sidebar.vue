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
        <Link :href="route('dashboard')">          
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
        </Link>
      </div>

      <div class="font-bold text-center text-gray-100 text-lg">
        {{ $page.props.username }}
      </div>

      <div class="flex justify-evenly mt-3 text-gray-100 text-xs">

        <Link
          :href="route('myprofile.edit')"
          class="block border border-gray-500 hover:bg-gray-500 px-2 py-1 rounded-sm"
        >
          Mi cuenta
        </Link>

        <Link
          :href="route('logout')"
          class="block border border-gray-500 hover:bg-gray-500 px-2 py-1 rounded-sm"
          method="post"
          as="button">
            Cerrar sesión
        </Link>

      </div>      
    
      <RecursiveMenu />    

    </div>
    
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";
import { Link } from '@inertiajs/inertia-vue3'
import { useSidebar } from "../hooks/useSidebar.js";
import RecursiveMenu from "@/Layouts/RecursiveMenu/Index";

export default defineComponent({
components: {
    //Icon,
    Link,
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
