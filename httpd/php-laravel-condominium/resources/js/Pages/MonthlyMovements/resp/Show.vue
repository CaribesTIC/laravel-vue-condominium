<template>
    <div>
        <page-header> Mostrar Movimiento Mensual </page-header>
        <div class="flex space-x-2">
            <Link class="btn btn-primary" :href="route('dwellings')">
                Ver todos
            </Link>
        </div>
        <div class="panel mt-6 p-4">
            <div class="table-data__wrapper">
                <table class="table-data">
                    <thead>
                        <tr class="">
                            <th class="w-2/5">Dato</th>
                            <th class="w-3/5">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <th class="">Año</th>
                            <td class="">{{ monthlyMovement.year }}</td>
                        </tr>
                        <tr class="">
                            <th class="">Mes</th>
                            <td class="">{{ monthlyMovement.month }}</td>
                        </tr>
                        <tr class="">
                            <th class="">Fondo</th>
                            <td class="">{{ monthlyMovement.fund }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import Layout from "@/Layouts/AppLayout";
import PageHeader from "@/Shared/PageHeader";

export default {
    layout: Layout,
    components: {
        Link,
        PageHeader,
    },
    props: { monthlyMovement: Object },
};
</script>
