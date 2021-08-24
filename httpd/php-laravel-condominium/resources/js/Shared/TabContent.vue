<template>
  <div v-bind:class="this.color" 
       v-show="this.tabname == this.tabSelected">
    <div class="tab-enh-content"
         v-bind:class="{ 'is-hovered' : this.tabHovered == this.tabname}">
      <h3>{{ title }}</h3>
      <p>{{ text }}</p>
    </div>
  </div>
</template>

<script>
import { inject } from 'vue'

export default {
  name: 'TabContent',
  props: {
    tabname:  { type: String, required: true },
    title:    { type: String, required: true },
    text:     { type: String, required: true },
    color:    { type: String, required: true }
  },
  setup() {
    const tabSelected = inject('tabSelected')
    const tabHovered  = inject('tabHovered')
    return { tabSelected, tabHovered }
  }
}
</script>



