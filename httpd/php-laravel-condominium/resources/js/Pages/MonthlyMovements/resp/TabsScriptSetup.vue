<script>  
  /*import TabList from "./TabList.vue";
  import TabCart from "./TabCart.vue";
  import TabOther from "./TabOther.vue";*/
  
  /*import TabHome from "./TabHome.vue";
  import TabPosts from "./TabPosts.vue";
  import TabArchive from "./TabArchive.vue";  
  export default {
    layout: Layout,
    components: {
      'tab-home': TabHome,
      'tab-post': TabPosts,
      'tab-archive': TabArchive
    }
  };*/
</script>

<script setup>
/*  import { ref, computed } from "vue";
  import { Link } from "@inertiajs/inertia-vue3";
  import Layout from "@/Layouts/AppLayout";  
  import PageHeader from "@/Shared/PageHeader";
  
  const props = defineProps({
        errors: Object,
        home: Object,
        posts: Array,
        archive: Object,
  });
  
  const currentTab = ref("Home");
  const tabs = ref(["Home", "Post", "Archive"]);    
  const currentTabComponent = computed(() => "tab-" + currentTab.value.toLowerCase());  
  const currentTabProps = computed(() => [props[currentTab.value.toLowerCase()], props.errors]);*/
</script>

<template>
  <!--div
    class="tabsSection"
  >
    <div id="dynamic-component-demo" class="m-5 w-full">

      <div class="mx-10">
        <button
          v-for="tab in tabs"
          v-bind:key="tab"
          v-bind:class="['tab-button', { active: currentTab === tab }]"
          v-on:click="currentTab = tab"
          class=""
        >
	  {{ tab }}
	</button>
      </div>

      <transition name="fade" mode="out-in">
        <keep-alive>
          <component v-bind:is="currentTabComponent" class="bg-white" :monthlyMovement="currentTabProps"></component>
        </keep-alive>
      </transition>

    </div>
  </div-->
</template>

<style>
/*.demo {
    font-family: sans-serif;
    border: 1px solid #eee;
    border-radius: 2px;
    padding: 0px 0px;
    margin-top: 1em;
    margin-bottom: 40px;
    user-select: none;
    overflow-x: auto;
}

.tab-button {
    padding: 6px 10px;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    border: 1px solid #ccc;
    cursor: pointer;
    background: #f0f0f0;
    margin-bottom: -1px;
    margin-right: -1px;
}
.tab-button:hover {
    background: #e0e0e0;
}
.tab-button.active {
    background: #e0e0e0;
}
.demo-tab {
    border: 1px solid #ccc;
    padding: 10px;
}*/
</style>

