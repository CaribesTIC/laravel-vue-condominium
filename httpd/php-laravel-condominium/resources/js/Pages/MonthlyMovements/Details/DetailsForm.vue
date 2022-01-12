<template>
    <div class="panel my-6 md:ml-60 md:mr-60  border-r-2 border-b-2 bg-gray-100">
        <form method="post" @submit.prevent="submit" class="p-0">
            <div class="grid">
                <label class="block">
                    <span class="text-gray-700">Descripción</span>
                    <textarea v-model="form.description"></textarea>
                    <div v-if="errors.description" class="form-error">
                        {{ errors.description }}
                    </div>
                </label>
            </div>
            <div class="grid">
                <label class="block">
                    <span class="text-gray-700">Monto</span>
                    <input v-model="form.amount" type="number" class="" step=".01" required/>
                    <div v-if="errors.amount" class="form-error">
                        {{ errors.amount }}
                    </div>
                </label>
            </div>

            <div class="grid">
                <!-- fund -->
                <label class="block">
                    <span class="text-gray-700">Tipo de movimiento</span>
                    <div>
                        <input type="radio" v-model="form.is_expense" value="true" /><label> Gasto </label>
                        <input type="radio" v-model="form.is_expense" value="false" /><label> Igreso </label>
                    </div>
                    <div v-if="errors.is_expense" class="form-error">
                        {{ errors.is_expense }}
                    </div>
                </label>
            </div>
            <div class="grid">
                <label class="block">
                    <span class="text-gray-700">Clasificación del movimiento</span>
                    <div>
                        <input type="radio" v-model="form.is_ordinal" value="true" /><label> Ordinario </label>
                        <input type="radio" v-model="form.is_ordinal" value="false" /><label> Extraordinbario </label>
                    </div>
                    <div v-if="errors.is_ordinal" class="form-error">
                        {{ errors.is_ordinal }}
                    </div>
                </label>
            </div>

            <div class="grid">
                <label class="block">
                    <span class="text-gray-700">Alcance del movimiento</span>
                    <div>
                        <input type="radio" v-model="form.is_general" value="true" /><label> General </label>
                        <input type="radio" v-model="form.is_general" value="false" /><label> Específico </label>
                    </div>
                        <div v-if="errors.is_general" class="form-error">
                            {{ errors.is_general }}
                    </div>
                </label>

            </div>
            <div class="grid">
                <label class="block" v-if="form.is_general=='false'" >
                    <span class="text-gray-700">Especifique la Vivienda</span>
                    <select v-model="form.dwelling_id" class="">
                        <!--option 
                            v-for="(dwelling, index) in monthlyMovement[0].dwellings" 
                            :value="dwelling_id" :key="dwelling.index" required>
                            {{ dwelling.name }}
                        </option-->
                    </select>
                    <div v-if="errors.dwelling_id" class="form-error">
                         {{ errors.dwelling_id }}
                    </div>
                </label>
            </div>
                
            <div class="mt-4 px-2 border-gray-100 flex justify-end space-x-2">
                <input
                    :disabled="sending"
                    type="submit"
                    class="btn btn-primary"
                    :value="sending ? 'Guardando...' : 'Guardar'"
                />
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {                
                description: '',
                amount: 0,
                is_expense: true,
                is_ordinal: true,
                is_general: true
            },
            errors: {
                description: '',
                amount: '',
                is_expense: '',
                is_ordinal: '',
                is_general: ''
            },
            sending: false
        }
    }

};
</script>
