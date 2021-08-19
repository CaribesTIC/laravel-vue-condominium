/* https://tailwindcss-forms.vercel.app/ */
<template>
  <div>
    <page-header> Editar categoría </page-header>
    <div class="flex space-x-2">
      <Link class="btn btn-primary" :href="route('categories.index')">
        Ver todas
      </Link>
    </div>

    <div class="panel mt-6">
      <form @submit.prevent="submit" class="p-4">
        <div class="grid lg:grid-cols-2 gap-4">
          <!-- name -->
          <label class="block">
            <span class="text-gray-700">Nombre de la Categoría</span>
            <input v-model="form.name" type="text" class="" />
            <div v-if="errors.name" class="form-error">
              {{ errors.name }}
            </div>
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
   
    <div class="panel mt-6">
      <div class="p-4">
        <div class="table-data__wrapper">
          <table class="table-data">
            <thead>
              <tr class="">
                <th class="">Tareas</th>
                <th class="">Descripción</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="task in form.tasks" :key="task.id" class="">
                <td class="w-2/5">
                  {{ task.name }}
                </td>
                <td class="w-2/5">
                  {{ task.description }}
                </td>
              </tr>
              <tr v-if="form.tasks.length === 0">
                <td class="" colspan="4">Tareas no encontradas.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import Layout from "@/Layouts/AppLayout";
import LoadingButton from "@/Shared/LoadingButton";
import PageHeader from "@/Shared/PageHeader";

export default {
  layout: Layout,
  components: {
    Link,
    LoadingButton,
    PageHeader,
  },
  props: {
    errors: Object,
    category: Object
  },
  data() {
    return {
      sending: false,
      form: {
        name: this.category.name,
        tasks: this.category.tasks
      }
    };
  },
  methods: {
    submit() {
      this.$inertia.put(this.route("categories.update", this.category.id), this.form, {
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
