<template>
  <header
    class="bg-white border-b-2 border-red-700 flex items-center justify-between px-6 py-4"
  >
    <div class="flex items-center">
      <button
        @click="isOpen = true"
        class="text-gray-500 focus:outline-none lg:hidden"
      >
        <svg
          class="h-5 w-5 text-gray-500"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M4 6H20M4 12H20M4 18H11"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
      </button>
      <search />

    </div>

    <!--div class="flex items-center"></div-->

<div class="flex items-center">
        <button class="flex mx-4 text-black focus:outline-none">


        <svg
          class="h-6 w-6"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>                                                                                                
















       </button>
























       <div class="relative">
         <button
           @click="dropdownOpen = !dropdownOpen"
           class="relative z-10 block h-8 w-8 rounded-full overflow-hidden focus:outline-none"
         >



          <svg
            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
            aria-hidden="true" class="w-8 h-10 text-black rounded-full"
          >
            <path
              d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z">
            </path>
          </svg>









         </button>
 
         <div
           v-show="dropdownOpen"
           @click="dropdownOpen = false"
           class="fixed inset-0 h-full w-full z-10"
         ></div>
 
         <div
           v-show="dropdownOpen"
           class="absolute right-0 mt-2 py-2 w-48 bg-gray-600 rounded-md shadow-xl z-20"
         >
           <router-link
             to="/profile"
             class="block px-4 py-2 text-sm text-white hover:bg-gray-400"
           >
             {{ authUser ? authUser.name : 'Profile'}}
           </router-link>
 
           <router-link
             to="/"
             class="block px-4 py-2 text-sm text-white hover:bg-gray-400"                             
           >
             <Logout />
           </router-link>        
         </div>        
       </div>

</div>
  </header>
</template>

<script>
import { defineComponent, ref, onMounted } from "vue";
import { useSidebar } from "../hooks/useSidebar";
import Search from "./Search";
import Logout from "./Logout";

export default defineComponent({
  components: {
    Search,
    Logout
  },

  setup(_, { emit }) {
    const dropdownOpen = ref(false);
    const { isOpen } = useSidebar();

    return {
      isOpen,
      dropdownOpen,
    };
  },
});
</script>
