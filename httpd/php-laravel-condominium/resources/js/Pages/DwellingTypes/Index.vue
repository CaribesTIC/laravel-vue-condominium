<template>
  <div>
    <page-header> Tipos de Vivienda </page-header>

    <div class="flex space-x-2">
      <inertia-link class="btn btn-primary" :href="route('dwelling-types.create')">
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
                <a href="#" @click.prevent="setSort('name')">Nombre</a>
              </th>
              <th class="">
                <a href="#" @click.prevent="setSort('is_active')">Activo</a>
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
                {{ row.is_active }}
              </td>
              <td class="">
                <div class="flex items-center space-x-1">
                  <inertia-link
                    :href="route('dwelling-types.show', row.id)"
                    tabindex="-1"
                  >
                    <button class="btn btn-success btn-xs">Mostrar</button>
                  </inertia-link>

                  <inertia-link
                    :href="route('dwelling-types.edit', row.id)"
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
              <td class="" colspan="4">Tipos de Vivienda no encontradas.</td>
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
  metaInfo: { title: "DwellingTypes" },
  name: "DwellingTypes",
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
      Inertia.get(`/dwelling-types?${urlQuery}`, [], {
        preserveState: true,
      });
    };
    const deleteRow = (rowId) => {
      if (confirm("¿Estás seguro de que quieres eliminar?")) {
        Inertia.delete(route("dwelling-types.destroy", rowId));
      }
    };

    return {
      deleteRow,
      ...useSearch(props, load),
    };
  },
});
</script>
