<template>
  <div>      
    <div class="py-2">
      <page-header>Menus</page-header>
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
          <button
            @click="openModalCreate"            
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">
              Create
          </button>          
          <div class="bg-white rounded shadow overflow-x-auto">      
            <table class="table-fixed w-full whitespace-no-wrap">
              <thead>
                <tr class="bg-gray-200 text-left font-bold"> 
                  <th class="px-6 pt-6 pb-4">Menu Options</th>                                                      
                  <th class="px-6 pt-6 pb-4">Path</th>
                  <th class="px-6 pt-6 pb-4">Sort</th>               
                  <th class="px-6 pt-6 pb-4">Atcion(s)</th>               
              </tr>
            </thead>
            <tbody>              
              <tr v-for="menu in menus.data" :key="menu.id" class="hover:bg-gray-100 focus-within:bg-gray-100">               
                <td class="border-t text-sm">{{ menu.alias }}</td>                                
                <td class="border-t text-sm">{{ menu.path }}</td>      
                <td class="border-t text-sm">{{ menu.sort }}</td>                          
                <td class="border-t w-px text-sm">
                  <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    @click="edit(menu)">Edit</button>
                  <button                  
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                    @click="remove(menu.id)"
                   >Delete</button>
                </td>               
              </tr>                
            </tbody>            
          </table>
        </div>
        <pagination :links="menus.links" />        
      </div>
      
      <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpenCreate">
          <Create @closeModal0="closeModalCreate"/>
      </div>
      
      <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
        <Edit :menu="menu" @closeModal1="closeModal"/>
      </div>
      
    </div>
  </div>
  </div>
</template>

<script>
import Create from './Create'
import Edit from './Edit'
import Layout from '@/Shared/Layout'
import PageHeader from '@/Shared/PageHeader'
import Pagination from '@/Shared/Pagination'
import FlashMessages from '@/Shared/FlashMessages'

export default {
  metaInfo: { title: 'Menus' },
  layout: Layout,
  components: {
    Create,
    Edit,  
    PageHeader,
    Pagination,    
    FlashMessages
  },
  props: {
    menus: Object    
  },
  data() {
    return {
      // editMode: false,
      isOpenCreate: false,
      isOpen: false,
      menu:{}
    }
  },
  methods: {
    openModalCreate: function () {
      this.isOpenCreate = true;
    },
    openModal: function () {
      this.isOpen = true;
    },
    closeModalCreate: function () {
      this.isOpenCreate = false;
    },
    closeModal: function () {
      this.isOpen = false;
      //this.reset();
      //this.editMode=false;
    },
    closeModalCreate: function () {
      this.isOpenCreate = false;
    },
    edit: function (data) {      
      //this.editMode = true;
      this.menu=data;
      this.openModal();
    },
    remove(id) {
       Notification.confirm(() => {       
        this.$inertia.delete(this.route('menus.destroy', id));
      });
    }
  }
}
</script>
