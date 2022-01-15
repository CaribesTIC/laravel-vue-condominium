<template>
    <div class="demo-tab">
        <ShowFormButton
            @click="isShowingPanel=!isShowingPanel"
            :class="!isShowingPanel ? 'btn-primary' : 'btn-default'" 
        >
            {{ !isShowingPanel ? "Mostrar Panel": "Ocultar Panel" }}
        </ShowFormButton>
        <DetailsForm v-if="isShowingPanel"/>
        <DetailsTable /> 
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
    data() {
        return {
            isShowingPanel: false,
        }
    }
};
</script>
