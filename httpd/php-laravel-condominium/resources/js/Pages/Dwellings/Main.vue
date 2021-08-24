<template>
  <tabs />
</template>

<script>
import { provide } from 'vue'
import { tabsArray } from './tabsArray.js'
import tabs from '@/Shared/Tabs.vue'

export default {
  name: 'MainMockup',
  components: { tabs },
  setup() {
    provide('tabsArray', tabsArray)
  }
}
</script>
