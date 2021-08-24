<template>
  <div class="demo-tab">
    Home component<br>
    <span>{{ propiedad }}</span>
  </div>
  
</template>

<script>
export default {
  props: {
    propiedad: String
  }
}
</script>
