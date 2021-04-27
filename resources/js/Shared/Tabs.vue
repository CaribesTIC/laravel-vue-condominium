<template>
  <!--https://learnvue.co/2019/12/building-reusable-components-in-vuejs-tabs/-->
  <div :class='{"tabs__light": mode === "light", "tabs__dark": mode === "dark"}'>
    <ul class='tabs__header'>
      <li v-for='(tab, index) in tabs'
        :key='index'
        @click='selectTab(index)'
        :class='{"tab__selected": (index == selectedIndex)}'>
        {{ tab.title }}        
        <img v-if='tab.image' v-bind:src="tab.image" width="50px"/>
      </li>
    </ul>
    <slot></slot>
  </div>
</template>

<script>
export default {
  props: {
    mode: {
      type: String,
      default: 'light'
    }
  },
  data () {
    return {
      selectedIndex: 0, // the index of the selected tab,
      tabs: []         // all of the tabs
    }
  },
  created () {
    this.tabs = this.$children
  },
  mounted () {
    this.selectTab(0)
  },
  methods: {
    selectTab (i) {
      this.selectedIndex = i

      // loop over all the tabs
      this.tabs.forEach((tab, index) => {
        tab.isActive = (index === i)
      })
    }
  }
}
</script>

<style lang="css">

  ul.tabs__header {
    display: block;
    list-style: none;
    margin: 0 0 0 0;/*10px;*/
    padding: 0;
  }

  ul.tabs__header > li {
    padding: 15px 30px;
    /*border-radius: 5px;*/
    margin: 0;
    display: inline-block;
    /*margin-right: 5px;*/
    cursor: pointer;
  }

  ul.tabs__header > li.tab__selected {
    /*font-weight: bold;*/
    /*border-radius: 5px 5px 0 0;*/
    /*border-bottom: 8px solid transparent;*/
  }

  .tab {
    display: inline-block;
    color: black;
    padding: 5px;    
    width: 100%;
    border-radius: 5px;
    min-height: 400px;    
  }

  .tabs__light .tab{
    background-color: #fff;
  }

  .tabs__light li {
    /*background-color: #ddd;*/
    background-color: #6f8d6b;
    color: #aaa;
  }

  .tabs__light li.tab__selected {
    background-color: #fff;
    color: #83FFB3;
  }

  .tabs__dark .tab{
    /*background-color: #555;*/
    background-color: #e5e7eb;
    color: #000000;
  }

  .tabs__dark li {
    /*background-color: #ddd;*/ 
    background-color: #c7d2fe;
    color: #000000;
  }
  
  .tabs__dark li:hover {
    background-color: #818cf8;
    color: #000000;
  }

  .tabs__dark li.tab__selected {
    /*background-color: #555;*/
    background-color: #e5e7eb;
    
    color: #000000;

  }

</style>

