<template>
  <div>
    <page-header> Crear usuario </page-header>
    <div class="flex space-x-2">
      <inertia-link class="btn btn-primary" :href="route('users.index')"
        >Ver todos</inertia-link
      >
    </div>

    <div class="panel mt-6">
      <form @submit.prevent="submit" class="p-4">
        <div class="grid lg:grid-cols-2 gap-4">
          <!-- name -->
          <label class="block">
            <span class="text-gray-700">Nombre</span>
            <input v-model="form.name" type="text" class="" />
            <div v-if="errors.name" class="form-error">
              {{ errors.name }}
            </div>
          </label>
          <!-- email -->
          <label class="block">
            <span class="text-gray-700">Correo</span>
            <input
              v-model="form.email"
              type="email"
              class=""
              autocomplete="nope"
            />
            <div v-if="errors.email" class="form-error">
              {{ errors.email }}
            </div>
          </label>
          <!-- password -->
          <label class="block">
            <span class="text-gray-700">Password</span>
            <input
              v-model="form.password"
              type="password"
              class=""
              autocomplete="new-password"
            />
            <div v-if="errors.password" class="form-error">
              {{ errors.password }}
            </div>
          </label>
          <!-- role -->
          <label class="block">
            <span class="text-gray-700">Rol</span>
            <select v-model="form.role" class="">
              <option v-for="rol in roles" :value="rol" :key="rol">
                {{ rol }}
              </option>
            </select>
            <div v-if="errors.role" class="form-error">
              {{ errors.role }}
            </div>
          </label>
        </div>

        <div class="mt-6 px-2 border-gray-100 flex justify-end space-x-2">
          <loading-button
            :loading="sending"
            class="btn btn-primary ml-auto"
            type="submit"
          >
            Guardar
          </loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from "@/Layouts/AppLayout";
import LoadingButton from "@/Shared/LoadingButton";
import PageHeader from "@/Shared/PageHeader";

export default {
  metaInfo: { title: "Create User" },
  layout: Layout,
  components: {
    LoadingButton,
    PageHeader,
  },
  props: {
    errors: Object,
    roles: Array,
  },
  data() {
    return {
      sending: false,
      form: {
        name: null,
        email: null,
        password: null,
        role: "User",
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.post(this.route("users.store"), this.form, {
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
        onSuccess: () => {
          if (Object.keys(this.$page.props.errors).length === 0) {
            this.form.password = null;
          }
        },
        onError: () => {
          this.errors = this.$page.props.errors;
        },
      });
    },
  },
};
</script>
