<template>
    <div class="demo-tab">
        <div class="panel mt-6">
            <form method="post" @submit.prevent="submit" class="p-0">
                <div class="grid lg:grid-cols-2 gap-4">
                    <!-- year -->
                    <label class="block">
                        <span class="text-gray-700">Año</span>
                        <input v-model="form.year" type="number" min="1900" max="2099" required/>
                        <div v-if="errors.year" class="form-error">
                            {{ errors.year[0] }}
                        </div>
                    </label>
                    <!-- month -->
                    <label class="block">
                        <span class="text-gray-700">Mes</span>
                        <select v-model="form.month" class="">
                            <option v-for="(month, index) in months" :value="month" :key="month.index" required>
                              {{ month }}
                            </option>
                        </select>
                        <div v-if="errors.month" class="form-error">
                            {{ errors.month[0] }}
                        </div>
                    </label>
                </div>

                <div class="grid lg:grid-cols-2 gap-4">
                    <!-- fund -->
                    <label class="block">
                        <span class="text-gray-700">Fondo</span>
                        <input v-model="form.fund" type="number" class="" step=".01" required/>

                        <div v-if="errors.fund" class="form-error">
                            {{ errors.fund[0] }}
                        </div>
                    </label>
                </div>

                <div
                    class="mt-4 px-2 border-gray-100 flex justify-end space-x-2"
                >
                    <input
                        :disabled="sending"
                        type="submit"
                        class="btn btn-primary"
                        :value="sending ? 'Guardando...' : 'Guardar'"
                    />
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import LoadingButton from "@/Shared/LoadingButton";

export default {
    components: {
        Inertia,
        LoadingButton,
    },
    inject:["data", "errors"],
    data() {
        return {
            sending: false,
            isCreate: this.data.isCreate,
            form: {
                id: this.data.monthlyMovement.id,
                year: this.data.monthlyMovement.year,
                month: this.data.monthlyMovement.month,
                fund: this.data.monthlyMovement.fund,
                is_generated: this.data.monthlyMovement.is_generated,
            },
            months: this.data.months,
        };
    },
    methods: {
        submit() {
            this.isCreate ? this.create() : this.update();
        },
        create() {
            this.sending = true;
            axios.interceptors.response.use(
                (res) => res,
                (err) => Promise.reject(err)
            );
            axios
                .post("../../monthly-movements", this.form)
                .then((res) => {
                    this.form.id = res.data.id;
                    this.isCreate = false;
                    this.errors = {};
                    this.$page.props.flash.success = res.data.success;
                })
                .catch((err) => {
                    if (err.response.data.errors) {
                        this.errors = err.response.data.errors;
                        this.$page.props.flash.error = err.response.data.message;
                    }
                })
                .finally(() => (this.sending = false));
        },
        async update() {
            this.sending = true;
            axios.interceptors.response.use(
                (res) => res,
                (err) => Promise.reject(err)
            );

            this.form._method = "PUT";
            axios
                .post(`../../monthly-movements/${this.form.id}`, this.form)
                .then((res) => {
                    this.errors = {};
                    this.$page.props.flash.success = res.data.success;
                })
                .catch((err) => {
                    if (err.response.data.errors) {
                        this.errors = err.response.data.errors;
                        //this.$page.props.flash.error=err.response.data.message;
                    }
                })
                .finally(() => (this.sending = false));
        },
    },
};
</script>

