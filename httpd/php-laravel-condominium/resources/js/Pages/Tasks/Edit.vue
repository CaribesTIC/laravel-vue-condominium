/* https://tailwindcss-forms.vercel.app/ */
<template>
  <div>
    <page-header> Editar tarea </page-header>
    <div class="flex space-x-2">
      <inertia-link class="btn btn-primary" :href="route('tasks.index')">
        Ver todas
      </inertia-link>
    </div>

    <div class="panel mt-6">
      <form @submit.prevent="submit" class="p-4">
        <div class="grid lg:grid-cols-2 gap-4">
          <!-- name -->
          <label class="block">
            <span class="text-gray-700">Tarea</span>
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
    task: Object,
    categories: Array
  },
  data() {
    return {
      sending: false,
      form: {
        name: this.task.name,
        description: this.task.description,
        category_id: this.task.category_id
      }
    };
  },
  methods: {
    submit() {
      this.$inertia.put(this.route("tasks.update", this.task.id), this.form, {
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
