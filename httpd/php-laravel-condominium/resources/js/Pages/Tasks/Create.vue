<template>
  <div>
    <page-header> Crear tarea </page-header>
    <div class="flex space-x-2">
      <Link class="btn btn-primary" :href="route('tasks')"
        >Ver todas</Link
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
          <!-- category -->
          <label class="block">
            <span class="text-gray-700">Descripción</span>
            <textarea v-model="form.description" class="" ></textarea>
            <div v-if="errors.description" class="form-error">
              {{ errors.description }}
            </div>
          </label>
        </div>
        
        <div class="grid lg:grid-cols-2 gap-4">
          <!-- category -->
          <label class="block">
            <span class="text-gray-700">Categoría</span>
            <select v-model="form.category_id" class="">
              <option v-for="category in categories" :value="category.id" :key="category.id">
                {{ category.name }}
              </option>
            </select>
            <div v-if="errors.category_id" class="form-error">
              {{ errors.category_id }}
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
import { Link } from "@inertiajs/inertia-vue3";
import Layout from "@/Layouts/AppLayout";
import LoadingButton from "@/Shared/LoadingButton";
import PageHeader from "@/Shared/PageHeader";

export default {
  name:"Tasks",
  layout: Layout,
  components: {
    Link,
    LoadingButton,
    PageHeader,
  },
  props: {
    errors: Object,
    categories: Array
  },
  data() {
    return {
      sending: false,
      form: {
        name: null,
        description: null,
        category_id: null
      }
    };
  },
  methods: {
    submit() {
      this.$inertia.post(this.route("tasks.store"), this.form, {
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
        onSuccess: () => {
          if (Object.keys(this.$page.props.errors).length === 0) {
            this.form.password = null;
          }
        },
        onError: () => {
          this.errors = this.$page.props.errors;
        }
      });
    }
  }
};
</script>
