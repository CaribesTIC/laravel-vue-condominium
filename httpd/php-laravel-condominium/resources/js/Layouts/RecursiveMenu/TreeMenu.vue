<template>
  <li>
    <div v-if="menu.path==='#'" class="mb-2 border-l-2 px-2">
      <a href="#" @click="toggleChildren" style="color:white" class="flex items-center group py-0">
        {{ menu.title }}
      </a>
    </div>
    <div v-else
      class="mb-2 px-2"
      :class="[$page.url.startsWith('/' + menu.path) ? 'activeClass' : 'inactiveClass']"
    >  
      <Link class="items-center py-0" :href="route(menu.path)">
        <span class="flex items-center group py-0">
          <icon :name="menu.icon" class="w-5 h-5 mr-2"/>          
          {{ menu.title }}
        </span>
      </Link>
    </div>  
    <ul v-if="menu.children_menus.length>0" style="padding-left: 21px">
      <tree-menu
        v-if="showChildren"
        v-for="(menu, index) in menu.children_menus"
        :key="index"
        :menu="menu"/>
    </ul>
  </li>    
</template>

<script>
import { defineComponent, ref, computed } from "vue";
import { Link } from '@inertiajs/inertia-vue3'
import Icon from './IconMenu'

export default defineComponent({
  name: 'tree-menu',  
  components: {
    Icon,
    Link    
  },  
  props: [ 'menu' ],
  setup(props, context) {  
    const showChildren = ref(true);
    const toggleChildren = ()=> showChildren.value = !showChildren.value
    return {
      showChildren,
      toggleChildren
    };    
  }
});
</script>
