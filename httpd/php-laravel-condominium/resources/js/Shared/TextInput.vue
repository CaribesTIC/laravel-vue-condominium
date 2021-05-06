<template>
  <div>
    <label
      v-if="label"
      class="form-label"
      :for="textInputId"
    >
      {{ label }}:
    </label>
    <br/>
    <input
      :id="textInputId"
      ref="input"
      v-bind="$attrs"
      class="form-input"
      :class="{ error: error }"
      :type="type"
      :value="value"
      @input="$emit('input', $event.target.value)" />
    <div
      v-if="error"
      class="form-error"
      >
        {{ error }}
    </div>
  </div>
</template>

<script>
import Uuid from '@/Mixins/Uuid'

export default {
  inheritAttrs: false,
  mixins: [Uuid],
  
  props: {
    id: {
      type: String      
    },
    type: {
      type: String,
      default: 'text',
    },
    value: String,
    label: String,
    error: String,
  },
  data() {
    return { 
      textInputId: '',
      uuid: ''  
    }
  },
  mounted() {
   this.textInputId = !this.id ? `text-input-id-${this.uuid}` : this.id;
  },
  methods: {
    focus() {
      this.$refs.input.focus()
    },
    select() {
      this.$refs.input.select()
    },
    setSelectionRange(start, end) {
      this.$refs.input.setSelectionRange(start, end)
    },
  },
}
</script>
