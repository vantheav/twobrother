
<template>
    <section>
        <donate-form></donate-form>
        <donateform-edit></donateform-edit>
        <div>
            <v-container class="card">
                
            </v-container>
        </div>
    </section>
</template>
<script>
import DonateForm from '../donate/DonateForm.vue'
import DonateFormEdit from '../donate/DialogEditDonate.vue'
export default {
    components:{
        'donate-form': DonateForm,
        'donateform-edit': DonateFormEdit
    },
    data: () =>({
        
    }),
}
</script>

<style>
    section{
        margin-top: 13vh;
    }
    .card{
        width: 40%;
        height: 15vh;
        background: rgb(105, 199, 250);
        border-radius: 5px;
    }

</style>