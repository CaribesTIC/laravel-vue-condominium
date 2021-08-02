/* https://tailwindcss-forms.vercel.app/ */
<template>
  <div>
    <page-header> Editar tipo de vivienda </page-header>
    <div class="flex space-x-2">
      <inertia-link class="btn btn-primary" :href="route('dwelling-types.index')">
        Ver todas
      </inertia-link>
    </div>

    <div class="panel mt-6">
      <form @submit.prevent="submit" class="p-4">
        <div class="grid lg:grid-cols-2 gap-4">
          <!-- name -->
          <label class="block">
            <span class="text-gray-700">Nombre del tipo de vivienda</span>
            <input v-model="form.name" type="text" class="" />
            <div v-if="errors.name" class="form-error">
              {{ errors.name }}
            </div>
          </label>
        </div>
        <div class="grid lg:grid-cols-2 gap-4 my-2">
          <!-- is_active -->
          <label class="block">
            <span class="text-gray-700">Activo</span>
            <input v-model="form.is_active" type="checkbox" class="ml-2" />
          </label>          
        </div>         

        <div class="mt-4 px-2 border-gray-100 flex justify-end space-x-2">
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
  layout: Layout,
  components: {
    LoadingButton,
    PageHeader,
  },
  props: {
    errors: Object,
    dwellingType: Object
  },
  data() {
    return {
      sending: false,
      form: {
        name: this.dwellingType.name,
        is_active: this.dwellingType.is_active        
      }
    };
  },
  methods: {
    submit() {
      this.$inertia.put(this.route("dwelling-types.update", this.dwellingType.id), this.form, {
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
        onSuccess: () => {
          if (Object.keys(this.$page.props.errors).length === 0) {
            this.form.password = null;
          }
        },
        onError: () => {},
      });
    }
  }
};
</script>
