<template>
    <div class="demo-tab">
        <ShowFormButton
            @click="isShowingPanel=!isShowingPanel"
            :class="!isShowingPanel ? 'btn-primary' : 'btn-default'" 
        >
            {{ !isShowingPanel ? "Mostrar Panel": "Ocultar Panel" }}
        </ShowFormButton>
        <DetailsForm v-if="isShowingPanel"/>
        <DetailsTable :details="details" />        
    </div>
</template>

<script>
import DetailsForm from './Details/DetailsForm.vue';
import DetailsTable from './Details/DetailsTable.vue';
import ShowFormButton from './Details/ShowFormButton.vue';

export default {
    components: {        
        DetailsForm,
        DetailsTable,
        ShowFormButton
    },
    props: {
        monthlyMovement: Array,
    },
    data() {
        return {
            isShowingPanel: false,
            form: {                
                description: '',
                amount: 0,
                is_expense: true,
                is_ordinal: true,
                is_general: true
            },
            details: [],
            errors: {}
        }
    },
    mounted() {       
       this.details = this.monthlyMovement[0].length ? this.monthlyMovement[0] : this.details;
       this.erros = this.monthlyMovement[1]
    }
};
</script>
