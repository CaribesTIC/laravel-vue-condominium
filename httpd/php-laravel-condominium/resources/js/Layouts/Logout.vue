<template>

<div class="inline-flex items-center space-x-2">

    <span class="hidden sm:inline">Logout</span>
    <LogoutIcon class="w-6 h-6 text-white" />
</div>
</template>

<script>
import LogoutIcon from "./LogoutIcon";
export default {
  components: { LogoutIcon },
  name: "Logout",
  /*methods: {
    logout() {
      this.$store.dispatch("auth/logout");
    },
  },*/
};
</script>
