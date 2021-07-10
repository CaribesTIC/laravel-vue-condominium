<template>
  <div
    class="relative flex items-top justify-center min-h-screen sm:items-center sm:pt-0 bg-gray-100"
  >
    <div class="lg:px-8 max-w-md mx-auto sm:px-6">
      <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
        <img src="/img/logo.png" alt="logo" />
      </div>

      <div v-if="canLogin" class="flex justify-center text-lg mt-10 space-x-5">
        <inertia-link
          v-if="$page.props.user"
          href="/dashboard"
          class="block border border-gray-300 hover:bg-gray-300 px-4 py-1 rounded"
        >
          Dashboard
        </inertia-link>

        <template v-else>
          <inertia-link
            :href="route('login')"
            class="btn btn-primary"
          >
            Iniciar sesión
          </inertia-link>

          <inertia-link
            v-if="canRegister"
            :href="route('register')"
            class="btn btn-default"
          >
            Registrarse
          </inertia-link>
        </template>
      </div>
    </div>
  </div>
</template>

<script>
export default {  
  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    //laravelVersion: String,
    //phpVersion: String,
  },
};
</script>
