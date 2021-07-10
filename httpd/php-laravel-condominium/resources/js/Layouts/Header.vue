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

    <div class="flex items-center"></div>
  </header>
</template>

<script>
import { defineComponent, ref, onMounted } from "vue";
import { useSidebar } from "../hooks/useSidebar";
import Search from "./Search";

export default defineComponent({
  components: { Search },
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
