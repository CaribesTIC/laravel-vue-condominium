<template>
  <div>
    <page-header>Jornales</page-header>

    <div class="flex space-x-2">
      <inertia-link class="btn btn-primary" :href="route('journals.create')">
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
        <div class="flex space-x-2 flex-wrap">
          <button
            @click="setFilter({ when: 'today' })"
            :class="{
              'btn-primary': when == 'today',
              'btn-default': when != 'today',
            }"
            class="btn"
          >
            Hoy
          </button>
          <button
            @click="setFilter({ when: 'week' })"
            :class="{
              'btn-primary': when == 'week',
              'btn-default': when != 'week',
            }"
            class="btn"
          >
            Semana
          </button>
          <button
            @click="setFilter({ when: 'month' })"
            :class="{
              'btn-primary': when == 'month',
              'btn-default': when != 'month',
            }"
            class="btn"
          >
            Mes
          </button>
          <button
            @click="setFilter({ when: '' })"
            :class="{
              'btn-primary': when == null,
              'btn-default': when != '',
            }"
            class="btn"
          >
            Todos
          </button>
        </div>
      </div>
      <div class="table-data__wrapper">
        <table class="table-data">
          <thead>
            <tr class="">
              <th class="">
                <a href="#" @click.prevent="setSort('date')">Fecha</a>
              </th>
              <th class="">
                <a href="#" @click.prevent="setSort('user')">Trabajador</a>
              </th>
              <th class="">
                <a href="#" @click.prevent="setSort('task')">Tarea</a>
              </th>
              <th class="">
                <a href="#" @click.prevent="setSort('zone')">Zona</a>
              </th>
              <th class="">
                <a href="#" @click.prevent="setSort('input')">Entrada</a>
              </th>
              <th class="">
                <a href="#" @click.prevent="setSort('output')">Salida</a>
              </th>
              <th class="">Acción</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="row in rows.data" :key="row.id" class="">
              <td class="">
                {{ row.date }}
              </td>
              <td class="">
                {{ row.user }}
              </td>
              <td class="">
                {{ row.task }}
              </td>
              <td class="">
                {{ row.zone }}
              </td>
              <td class="">
                {{ row.input }}
              </td>
              <td class="">
                {{ row.output }}
              </td>
              <td class="">
                <div class="flex items-center space-x-1">
                  <inertia-link
                    :href="route('journals.show', row.id)"
                    tabindex="-1"
                  >
                    <button class="btn btn-success btn-xs">Mostrar</button>
                  </inertia-link>

                  <inertia-link
                    :href="route('journals.edit', row.id)"
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
              <td class="" colspan="4">Journals no encontrados.</td>
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
  metaInfo: { title: "Journals" },
  name: "Journals",
  layout: Layout,
  components: {
    PageHeader,
    Pagination,
  },
  props: ["rows", "errors", "search", "sort", "direction", "when"],
  setup(props) {
    const load = (newParams) => {
      // mix defaults and new parameters
      const params = {
        search: props.search || "",
        sort: props.sort || "",
        direction: props.direction || "",
        when: props.when || "",
        ...newParams,
      };
      // convert obj into url
      const urlQuery = new URLSearchParams(params).toString();
      Inertia.get(`/journals?${urlQuery}`, [], {
        preserveState: true,
      });
    };
    const deleteRow = (rowId) => {
      if (confirm("¿Estás seguro de que quieres eliminar?")) {
        Inertia.delete(route("journals.destroy", rowId));
      }
    };
    return {
      deleteRow,
      ...useSearch(props, load),
    };
  },
});
</script>
