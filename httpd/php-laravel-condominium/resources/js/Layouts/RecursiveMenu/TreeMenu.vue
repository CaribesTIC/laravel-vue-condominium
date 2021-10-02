<template>
  <li>
    <div v-if="menu.path==='#'" class="mb-2 border-l-2 px-2">
      <a href="#" @click="toggleChildren" style="color:white" class="flex items-center group py-0">                
        {{ menu.title }}
      </a>
    </div>
    <div v-else
      class="mb-2 px-2"
      :class="[ isActive ? activeClass : inactiveClass]"
    >  
      <Link
        class="items-center py-0" 
        :href="route(menu.path)"
      >
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
        :menu="menu" />
    </ul>
  </li>    
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import Icon from './IconMenu'

export default {
  name: 'tree-menu',  
  components: {
    Icon,
    Link,
  },  
  props: [ 'menu' ],
    data() {
     return {
       isActive:false,
       valor: false,
       pathNameUrl: window.location.pathname,     
       showChildren: true,
       activeClass: "bg-gray-600 bg-opacity-25 text-gray-100 border-gray-100",
       inactiveClass: "border-gray-900 text-gray-500 hover:bg-gray-600 hover:bg-opacity-25 hover:text-gray-100"
     }
  },
  mounted(){
    this.pathNameUrl = window.location.pathname;
  },
  computed: {
    isActive () {
      return this.$page.url.startsWith('/' + this.menu.path);
    },
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
       return this.showChildren = !this.showChildren; 
    }    
  } 
}
</script>

