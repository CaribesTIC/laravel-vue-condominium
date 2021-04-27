<template>
  <nav>
    <ul v-if="menus.length>0">
      <tree-menu
        v-for="(menu, index) in menus"
        :key="index"
        :menu="menu" />
      </ul>
    </nav>
</template>

<script>
import TreeMenu from './TreeMenu'
import tree from './tree.js'

export default {  
  components: { TreeMenu }, 
  data() {
    return { menus: this.$page.props.menu.data }
  }
}
</script>

<style scope>

</style>
