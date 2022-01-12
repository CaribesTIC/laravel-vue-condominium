<template>
    <div class="demo-tab">

       <div class="panel mt-6 ml-20 mr-20">
            <form method="post" @submit.prevent="submit" class="p-0">
                <div class="grid lg:grid-cols-2 gap-4 mb-2">
                    <!-- year -->
                    <label class="block">
                        <span class="text-gray-700">Descripción</span>
                        <textarea v-model="form.description"></textarea>
                        <div v-if="errors.description" class="form-error">
                            {{ errors.description[0] }}
                        </div>
                    </label>
                    <!-- month -->
                    <label class="block">
                        <span class="text-gray-700">Monto</span>
                        <input v-model="form.amount" type="number" class="" step=".01" required/>
                        <div v-if="errors.amount" class="form-error">
                            {{ errors.amount[0] }}
                        </div>
                    </label>
                </div>

                <div class="grid lg:grid-cols-2 gap-4 mb-2">
                    <!-- fund -->
                    <label class="block">
                        <span class="text-gray-700">Tipo de movimiento</span>
                        <div>
                          <input type="radio" v-model="form.is_expense" value="true" /><label> Gasto </label>
                          <input type="radio" v-model="form.is_expense" value="false" /><label> Igreso </label>
                        </div>
                        <div v-if="errors.is_expense" class="form-error">
                            {{ errors.is_expense[0] }}
                        </div>
                    </label>

                    <!-- fund -->
                    <label class="block">
                        <span class="text-gray-700">Clasificación del movimiento</span>
                        <div>
                          <input type="radio" v-model="form.is_ordinal" value="true" /><label> Ordinario </label>
                          <input type="radio" v-model="form.is_ordinal" value="false" /><label> Extraordinbario </label>
                        </div>
                        <div v-if="errors.is_ordinal" class="form-error">
                            {{ errors.is_ordinal[0] }}
                        </div>
                    </label>
                </div>

                <div class="grid lg:grid-cols-2 gap-4">
                    <!-- fund -->
                    <label class="block">
                        <span class="text-gray-700">Alcance del movimiento</span>
                        <div>
                          <input type="radio" v-model="form.is_general" value="true" /><label> General </label>
                          <input type="radio" v-model="form.is_general" value="false" /><label> Específico </label>
                        </div>
                        <div v-if="errors.is_general" class="form-error">
                            {{ errors.is_general[0] }}
                        </div>
                    </label>

                    <!-- month -->
                    <label class="block" v-if="form.is_general=='false'" >
                        <span class="text-gray-700">Especifique la Vivienda</span>
                        <select v-model="form.dwelling_id" class="">
                            <option 
                                v-for="(dwelling, index) in monthlyMovement[0].dwellings" 
                                :value="dwelling_id" :key="dwelling.index" required>
                              {{ dwelling.name }}
                            </option>
                        </select>
                        <div v-if="errors.dwelling_id" class="form-error">
                            {{ errors.dwelling_id[0] }}
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




        <!--span>{{ monthlyMovement }}</span-->
    </div>
</template>

<script>
export default {
    props: {
        monthlyMovement: Array,
    },
    data() {
        return {
            form: {                
                description: '',
                amount: 0,
                is_expense: true,
                is_ordinal: true,
                is_general: true
            },
            errors: {}
        }
    },
    mounted() {
       this.form = this.monthlyMovement[0].length ? this.monthlyMovement[0] : this.form;
       this.erros = this.monthlyMovement[1]
    }
};
</script>
