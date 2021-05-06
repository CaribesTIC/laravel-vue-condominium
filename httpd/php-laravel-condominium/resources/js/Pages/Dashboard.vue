<template>
 <!--template #header>
   <h2 class="font-semibold text-xl text-gray-800 leading-tight">
     Dashboard
   </h2>
 </template-->
 <div>
    <page-header>Dashboard</page-header>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <welcome />
      </div>
    </div>
  </div>
</template>

<script>
    import Layout from '@/Shared/Layout'
    import PageHeader from '@/Shared/PageHeader'
    import Welcome from '@/Jetstream/Welcome'

    export default {
        layout: Layout,
        components: {
            PageHeader,
            Welcome
        },
    }
</script>
