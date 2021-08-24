<template>
  <div 
    v-on:click="selectTabByName(this.tabname)"
    v-on:mouseenter="this.tabHovered = this.tabname"
    v-on:mouseleave="this.tabHovered = ''"
    v-bind:class="[activeClass(), colorClass()]">
    <div
     v-bind:class="{ 'bg-white black w-full h-full' : this.tabname == this.tabSelected }"
     >{{ title }}</div>
  </div>
</template>

<script>
import { inject } from 'vue'

export default {
  name: 'TabHeader',
  props: {
    tabname: { type: String, required: true },
    title:   { type: String, required: true },
    color:   { type: String, required: true }
  },
  setup() {
    const tabSelected = inject('tabSelected')
    const tabHovered  = inject('tabHovered')
    return { tabSelected, tabHovered }
  },
  mounted() {
    this.selectTabByName(this.tabSelected);
  },
  methods: {
    selectTabByName(tabName) {
      this.tabSelected = tabName
    },
    activeClass : function () {
      return this.tabname == this.tabSelected ? 'active' : '';
    },
    colorClass  : function () {
      return this.tabname == this.tabSelected ?
               this.color : 'bg-gray-700';
    }
  }
}
</script>



