<template>
  <li>
    <div v-if="menu.path==='#'" class="mb-0">
      <a href="#" @click="toggleChildren" style="color:white" class="flex items-center group py-0">
        <!--icon :name="menu.icon" class="w-4 h-4 mr-2" :class="'fill-white'" /-->
        {{ menu.title }}
      </a>
    </div>
    <div v-else class="mb-0">  
      <inertia-link class="items-center py-0" :href="route(menu.path)" preserve-scroll>        
        <div :class="'text-indigo-300 group-hover:text-white'">{{ menu.title }}</div>
      </inertia-link>
    </div>  
    <ul v-if="menu.children_menus.length>0" style="padding-left: 21px">
      <tree-menu
        v-if="showChildren"
        v-for="(menu, index) in menu.children_menus"
        :key="index"
        :menu="menu" />
    </ul>
  </li>    
</template>

<script>
//import Icon from '@/Shared/Icon'
export default {
  name: 'tree-menu',  
  components: {
    //Icon
  },  
  props: [ 'menu' ],
    data() {
     return {
       showChildren: false
     }
  },
  computed: {
    iconClasses() {
      return {
        'fa-plus-square-o': !this.showChildren,
        'fa-minus-square-o': this.showChildren
      }
    },
    labelClasses() {
      return { 'has-children': this.nodes }
    },
    indent() {
      return { transform: `translate(${this.depth * 50}px)` }
    }
  },
  methods: {
    toggleChildren() {
       true; this.showChildren = !this.showChildren;
    }    
  } 
}
</script>
