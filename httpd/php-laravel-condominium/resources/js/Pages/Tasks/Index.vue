<template>
  <div>
    <page-header> Tareas </page-header>

    <div class="flex space-x-2">
      <inertia-link class="btn btn-primary" :href="route('tasks.create')">
        <span>Crear</span>
      </inertia-link>
    </div>

    <div class="overflow-hidden panel mt-6">
      <div class="mb-6 flex justify-between items-center">
        <div class="flex items-center">
          <div class="flex w-full bg-white shadow rounded">
            <!-- Note: can't use v-model here, because search is a prop. -->
            <!-- Also, setSearch is debounced 300ms -->
            <input
              class=""
              type="text"
              :value="search"
              @input="setSearch"
              placeholder="Filtrar…"
            />
          </div>
        </div>
      </div>
      <div class="table-data__wrapper">
        <table class="table-data">
          <thead>
            <tr class="">
              <th class="">
                <a href="#" @click.prevent="setSort('name')">Tarea</a>
              </th>
              <th class="">
                <a href="#" @click.prevent="setSort('description')"
                  >Descripción</a
                >
              </th>
              <th class="">
                <a href="#" @click.prevent="setSort('category')">Categoría</a>
              </th>
              <th class="">Acción</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="row in rows.data" :key="row.id" class="">
              <td class="">
                {{ row.name }}
              </td>
              <td class="">
                {{ row.description }}
              </td>
              <td class="">
                {{ row.category.name }}
              </td>
              <td class="">
                <div class="flex items-center space-x-1">
                  <inertia-link
                    :href="route('tasks.show', row.id)"
                    tabindex="-1"
                  >
                    <button class="btn btn-success btn-xs">Mostrar</button>
                  </inertia-link>

                  <inertia-link
                    :href="route('tasks.edit', row.id)"
                    tabindex="-1"
                  >
                    <button class="btn btn-primary btn-xs">Editar</button>
                  </inertia-link>

                  <button
                    @click="deleteRow(row.id)"
                    class="btn btn-danger btn-xs"
                  >
                    Eliminar
                  </button>
                </div>
              </td>
            </tr>
            <tr v-if="rows.length === 0">
              <td class="" colspan="4">Tareas no encontradas.</td>
            </tr>
          </tbody>
        </table>
      </div>
      <Pagination :links="rows.links" />
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { Inertia } from "@inertiajs/inertia";
import Layout from "@/Layouts/AppLayout";
import PageHeader from "@/Shared/PageHeader";
import Pagination from "@/Shared/Pagination";
import { useSearch } from "@/hooks/useTableGrid";

export default defineComponent({
  metaInfo: { title: "Tasks" },
  name: "Tasks",
  layout: Layout,
  components: {
    PageHeader,
    Pagination,
  },
  props: ["rows", "errors", "search", "sort", "direction"],
  setup(props) {
    const load = (newParams) => {
      // mix defaults and new parameters
      const params = {
        search: props.search || "",
        sort: props.sort || "",
        direction: props.direction || "",
        ...newParams,
      };
      // convert obj into url
      const urlQuery = new URLSearchParams(params).toString();
      Inertia.get(`/tasks?${urlQuery}`, [], {
        preserveState: true,
      });
    };
    const deleteRow = (rowId) => {
      if (confirm("¿Estás seguro de que quieres eliminar?")) {
        Inertia.delete(route("tasks.destroy", rowId));
      }
    };

    return {
      deleteRow,
      ...useSearch(props, load),
    };
  },
});
</script>
