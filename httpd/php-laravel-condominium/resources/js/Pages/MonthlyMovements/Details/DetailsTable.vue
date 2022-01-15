<template>
    <div class="table-data__wrapper">
        <table class="table-data">
            <thead>
                <tr class="">
                    <th class="">Movimiento</th>
                    <th class="">Monto</th>
                    <th class="">Tipo</th>
                    <th class="">Clasificación</th>
                    <th class="">Alcance</th>
                    <th class="">Especificación</th>
                    <th class="">Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="row in details" :key="row.id" class="">
                    <td class="">{{ row.description }}</td>
                    <td class="">{{ row.amount }}</td>
                    <td class="">{{ row.is_expense }}</td>
                    <td class="">{{ row.is_ordinal }}</td>
                    <td class="">{{ row.is_general }}</td>
                    <td class="">{{ row.dwelling_id }}</td>
                    <td class="">
                        <div class="flex items-center space-x-1">
                            <Link
                                :href="route('monthly-movements.edit', row.id)"
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
                <tr v-if="details.length === 0">
                    <td class="" colspan="4">
                        Movimientos mensuales no encontrados.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: { Link },
    inject: ["data", "errors"],
    data () {
        return {
            details: this.data.monthlyMovement.monthly_movement_details
        }
    },
};
</script>
