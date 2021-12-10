<template>
    <div class="demo-tab">
        <div class="panel mt-6">
            <form method="post" @submit.prevent="submit" class="p-0">
                <div class="grid lg:grid-cols-2 gap-4">
                    <!-- year -->
                    <label class="block">
                        <span class="text-gray-700">Año</span>
                        <input v-model="form.year" type="text" class="" />
                        <div v-if="errors.name" class="form-error">
                            {{ errors.year[0] }}
                        </div>
                    </label>
                    <!-- month -->
                    <label class="block">
                        <span class="text-gray-700">Mes</span>
                        <input v-model="form.month" type="text" class="" />
                        <div v-if="errors.name" class="form-error">
                            {{ errors.month[0] }}
                        </div>
                    </label>
                </div>

                <div class="grid lg:grid-cols-2 gap-4">
                    <!-- fund -->
                    <label class="block">
                        <span class="text-gray-700">Fondo</span>
                        <input v-model="form.fund" type="number" class="" />
                        <div v-if="errors.fund" class="form-error">
                            {{ errors.fund[0] }}
                        </div>
                    </label>
                </div>

                <!--div class="mt-4 px-2 border-gray-100 flex justify-end space-x-2">
          <loading-button
            :loading="sending"
            class="btn btn-primary ml-auto"
            type="submit"            
          >{{ sending ? 'Guardando...' : 'Guardar' }}</loading-button>
        </div-->

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
        <!--span>{{ this.monthlyMovement[1] }}</span-->
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
    props: {
        monthlyMovement: Object,
    },
    data() {
        return {
            sending: false,
            isCreate: this.monthlyMovement[0].isCreate,
            form: this.monthlyMovement[0].form,
            errors: this.monthlyMovement[1],
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
                        this.$page.props.flash.error =
                            err.response.data.message;
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
/*
https://thedutchlab.com/blog/using-axios-interceptors-for-refreshing-your-api-token
https://blog.clairvoyantsoft.com/intercepting-requests-responses-using-axios-df498b6cab62
https://masteringjs.io/tutorials/axios/interceptors
https://axios-http.com/docs/interceptors
https://stackoverflow.com/questions/52737078/how-can-you-use-axios-interceptors
https://www.bezkoder.com/axios-interceptors-refresh-token/
https://www.it-swarm-es.com/es/javascript/como-puedes-usar-los-interceptores-axios/806909494/
https://www.it-swarm-es.com/es/javascript/como-puedes-usar-los-interceptores-axios/806909494/
*/
</script>
