<template>
  <div class='tab' v-show='isActive'>
    <slot></slot>
    <div class="modal-footer">         
        <!--button class="btn btn-danger" @click="$emit('closeFormingPre')">
          Salir
        </button-->
    </div>    
  </div>
</template>

<script>
export default {
  props: {
    title: { type: String, default: '' },
    image: { type: String, default: null },
  },
  data () {
    return {
      isActive: true
    }
  }
}
</script>

<style scoped>
  
</style>
