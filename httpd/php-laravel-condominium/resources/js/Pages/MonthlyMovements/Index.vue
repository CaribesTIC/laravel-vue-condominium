<template>
    <div>
        <page-header> Movimientos Mensuales </page-header>

        <div class="flex space-x-2">
            <Link
                class="btn btn-primary"
                :href="route('monthly-movements.create')"
            >
                <span>Crear</span>
            </Link>
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
                                <a href="#" @click.prevent="setSort('year')"
                                    >Año</a
                                >
                            </th>
                            <th class="">
                                <a href="#" @click.prevent="setSort('month')"
                                    >Mes</a
                                >
                            </th>
                            <th class="">
                                <a href="#" @click.prevent="setSort('fund')"
                                    >Fondo</a
                                >
                            </th>
                            <th class="">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in rows.data" :key="row.id" class="">
                            <td class="">
                                {{ row.year }}
                            </td>
                            <td class="">
                                {{ row.month }}
                            </td>
                            <td class="">
                                {{ row.fund }}
                            </td>
                            <td class="">
                                <div class="flex items-center space-x-1">
                                    <Link
                                        :href="
                                            route(
                                                'monthly-movements.show',
                                                row.id
                                            )
                                        "
                                        tabindex="-1"
                                    >
                                        <button class="btn btn-success btn-xs">
                                            Mostrar
                                        </button>
                                    </Link>

                                    <Link
                                        :href="
                                            route(
                                                'monthly-movements.edit',
                                                row.id
                                            )
                                        "
                                        tabindex="-1"
                                    >
                                        <button class="btn btn-primary btn-xs">
                                            Editar
                                        </button>
                                    </Link>

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
                            <td class="" colspan="4">
                                Movimientos mensuales no encontrados.
                            </td>
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
import { Link } from "@inertiajs/inertia-vue3";
import Layout from "@/Layouts/AppLayout";
import PageHeader from "@/Shared/PageHeader";
import Pagination from "@/Shared/Pagination";
import { useSearch } from "@/hooks/useTableGrid";

export default defineComponent({
    metaInfo: { title: "MonthlyMovements" },
    name: "MonthlyMovements",
    layout: Layout,
    components: {
        Link,
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
            Inertia.get(`/monthly-movements?${urlQuery}`, [], {
                preserveState: true,
            });
        };
        const deleteRow = (rowId) => {
            if (confirm("¿Estás seguro de que quieres eliminar?")) {
                Inertia.delete(route("monthly-movements.destroy", rowId));
            }
        };

        return {
            deleteRow,
            ...useSearch(props, load),
        };
    },
});
</script>
