<template>
  <main class="tabs-enh">
    <div class="tab-enh-headers">
      <tabheader
        v-for="tab in tabs" v-bind:key="tab.name"
        :title="tab.title" :color="tab.color"
        :tabname="tab.name"
      />
    </div>

    <div class="tab-spacer"></div>

    <div class="tab-enh-contents">
      <tabcontent
        v-for="tab in tabs" v-bind:key="tab.name"
        :text="tab.text" :title="tab.title" :color="tab.color"
        :tabname="tab.name"
      />
    </div>
  </main>
</template>

<script>
import { inject } from 'vue'
import { provide, ref } from 'vue'
import tabheader  from '@/Shared/TabHeader.vue'
import tabcontent from '@/Shared/TabContent.vue'

export default {
  name: 'TabsEnhanced',
  components: { tabheader, tabcontent },
  setup() {
    const tabs = inject('tabsArray')

    const tabSelected = ref('team')
    const tabHovered  = ref('')
    provide('tabSelected', tabSelected)
    provide('tabHovered',  tabHovered)

    return { tabs }
  }
}
</script>

<style scoped>
  /*@import '@/css/tabs-enhanced-layout.css';
  @import '@/css/tabs-background-colors.css';
  @import '@/css/tabs-border-radius.css';*/
  
  
  
  
  /* Main Layout: Mobile First */

.tabs-enh {
  display: flex;
  flex-direction: column;
  max-width: 1024px;
  border: 1px solid #ccc;
}

.tabs-enh * {
  box-sizing: border-box;
}

@media (min-width: 768px) {
  .tabs-enh {
    flex-direction: row;
  }
  
  .tabs-enh > * {
    min-height: 12rem;
  }
}

/* Inner and Outer Layout */

.tab-enh-headers {
  flex-basis: 30%;
}

.tab-enh-headers div {
  padding-left:  1rem;
  padding-right: 1rem;
  height: 4rem;
  display: flex;
  align-items: center;

  cursor: pointer;
  transition: 0.3s;
  overflow: hidden;

  /*color: black;*/
  font-size: 1rem; 
}

.tab-enh-headers div div {
  width: 100%;
}

.tab-enh-spacer {
  height: 1.25rem;
}

.tab-enh-contents {
  flex-basis: 70%;
}

.tab-enh-contents > div {
  padding-left:  1rem;
  padding-right: 1rem;
  height: 100%;

  color: black;
  font-size: 1rem;
}

.tab-enh-content {
  padding: 1rem;
  height: 100%;
}

@media (min-width: 768px) {
  .tab-enh-headers div {
    padding-left:  1rem;
    padding-right: 0rem;
  }

  .tab-enh-contents > div {
  padding-left:  0;
  padding-right: 1rem;
  }
}









.tab-enh-headers > div:hover {
  background-color: #9e9e9e;
}

.tab-enh-headers div.active:hover {
  background-color: #616161;
}

.tab-enh-headers div.active div:hover {
  background-color: #e0e0e0;
}

.tab-enh-spacer {
  background-color: #616161;
}

.tab-enh-content {
  /*background-color: white;*/
}

.tab-enh-contents div div.is-hovered {
  background-color: #e0e0e0;
}

/* Add some decoration */

.bg-white      { background-color: white; }
.bg-gray-700   { background-color: #616161; }
.bg-orange-500 { background-color: #ff9800; }
.bg-teal-500   { background-color: #009688;  }
.bg-blue-500   { background-color: #2196f3; }
.bg-red-500    { background-color: #f44336; }

.tab-enh-headers .bg-white {
  color: black;
}
















/* Shadow */

.tabs-enh {
  box-shadow: 0.25rem 0.25rem 0.25rem #ccc;
}

/* Responsive border-radius */

.tabs-enh {
  border-radius: 0.5rem;
}

.tab-enh-headers {
  border-radius: 0.5rem 0.5rem;
}

.tab-enh-headers > div:first-child {
  border-top-left-radius: 0.5rem;
  border-top-right-radius: 0.5rem;  
}

.tab-enh-contents {
  border-radius: 0 0.5rem 0.5rem 0;
}

.tab-enh-content,
.tab-enh-contents > div {
  border-bottom-left-radius: 0.5rem;
  border-bottom-right-radius: 0.5rem;
}

@media (min-width: 640px) {
  .tab-enh-headers {
    border-radius: 0.5rem 0 0 0.5rem;
  }

  .tab-enh-headers > div:first-child {
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0;
  }

  .tab-enh-headers > div:last-child {
    border-bottom-left-radius: 0.5rem;
  }

  .tab-enh-headers .active div {
    border-top-left-radius: 0.5rem;
    border-bottom-left-radius: 0.5rem;
  }

  .tab-enh-contents {
    flex: 70%;
    border-radius: 0 0.5rem 0.5rem 0;
  }

  .tab-enh-contents > div {
    border-top-left-radius: 0;
    border-top-right-radius: 0.5rem; 
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0.5rem;
  }

  .tab-enh-content {
    border-bottom-left-radius: 0;
    border-top-right-radius: 0.5rem; 
    border-bottom-right-radius: 0.5rem;
  }
}




  
</style>
