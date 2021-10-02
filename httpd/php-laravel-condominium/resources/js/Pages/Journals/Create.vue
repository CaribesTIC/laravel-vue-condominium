<template>
  <div>
    <page-header> Crear journal </page-header>
    <div class="flex space-x-2">
      <Link class="btn btn-primary" :href="route('journals')">
        Ver todas
      </Link>
    </div>

    <div class="panel mt-6">
      <form @submit.prevent="submit" class="p-4">
        <div class="grid lg:grid-cols-2 gap-4">
          <!-- date -->
          <label class="block">
            <span class="text-gray-700">Fecha</span>
            <input v-model="form.date" type="date" class="" />
            <div v-if="errors.date" class="form-error">
              {{ errors.date }}
            </div>
          </label>
          
          <!-- employee -->
          <label class="block">
            <span class="text-gray-700">Usuario</span>
            <select v-model="form.user_id" class="">
              <option v-for="user in users" :value="user.id" :key="user.id">
                {{ user.name }}
              </option>
            </select>
            <div v-if="errors.user_id" class="form-error">
              {{ errors.user_id }}
            </div>
          </label>        
        </div>
        
        <div class="grid lg:grid-cols-2 gap-4">
          <!-- date -->
          <label class="block">
            <span class="text-gray-700">Tarea</span>
            <select v-model="form.task_id" class="">
              <option v-for="task in tasks" :value="task.id" :key="task.id">
                {{ task.name }}
              </option>
            </select>
            <div v-if="errors.task_id" class="form-error">
              {{ errors.task_id }}
            </div>
          </label>
          
          <!-- employee -->
          <label class="block">
            <span class="text-gray-700">Zona</span>
            <select v-model="form.zone_id" class="">
              <option v-for="zone in zones" :value="zone.id" :key="zone.id">
                {{ zone.name }}
              </option>
            </select>
            <div v-if="errors.zone_id" class="form-error">
              {{ errors.zone_id }}
            </div>
          </label>        
        </div>
        
        <div class="grid lg:grid-cols-2 gap-4">
          <!-- input -->
          <label class="block">
            <span class="text-gray-700">Entrada</span>
            <input v-model="form.input" type="time" class="" />
            <div v-if="errors.input" class="form-error">
              {{ errors.input }}
            </div>
          </label>
          
          <!-- output -->
          <label class="block">
            <span class="text-gray-700">Salida</span>
            <input v-model="form.output" type="time" class="" />
            <div v-if="errors.output" class="form-error">
              {{ errors.output }}
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
  metaInfo: { title: "Create Daily" },
  layout: Layout,
  components: {
    Link,
    LoadingButton,
    PageHeader,
  },
  props: {
    errors: Object,
    users: Array,
    tasks: Array,
    zones: Array  
  },
  data() {
    return {
      sending: false,
      form: {
        date: null,
        user_id: null,
        task_id: null,
        zone_id: null,
        input: null,
        output: null
      }
    };
  },
  methods: {
    submit() {
      this.$inertia.post(this.route("journals.store"), this.form, {
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
