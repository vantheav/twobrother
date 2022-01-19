
<template>
    <section>
        <donate-form @add-donate="getDonate"></donate-form>
        <donateform-edit v-if="update_donate" :data="donate_info" @update="EditDonate"></donateform-edit>
        <v-container class="card" v-for="(sponsor, i) in donateList" :key="i">
            <div v-if="donateList==0">
                <br><br>
                <h2 class="grey--text" >{{noData}}</h2>
            </div>
            <v-dialog v-model="dialogDelete" max-width="500px">
                <v-card >
                    <br>
                    <v-card-title class="red--text">Are you sure you want to delete this donation?</v-card-title><br>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn id="action-btn" color="white" style="background: #039BE5;" text @click="closeDelete">Cancel</v-btn>
                        <v-btn id="action-btn" color="white" style="background: #E53935;" text @click="deleteItemConfirm">YES</v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <div class="i">
                <h3>First name: <span>{{sponsor.first_name}}</span> </h3>
                <h3>Last name: <span>{{sponsor.last_name}}</span> </h3>
                <h3>ABA number: <span>{{sponsor.aba_number}}</span> </h3>
                <h3>Donate amount: <span>$ {{sponsor.donate}}</span> </h3>
            </div>
            <div class="action">                    
                <v-icon mediem id="edit" @click="updateDonation(sponsor)" class="mr-2">mdi-pencil</v-icon>
                <v-icon mediem id="delete" @click="deleteItem(sponsor.id)" v-if="role != 'STUDENT'">mdi-delete</v-icon>
            </div>
        </v-container>
    </section>
</template>
<script>
import axios from '../../axios-request.js'
import DonateForm from '../donate/DonateForm.vue'
import DonateFormEdit from '../donate/DialogEditDonate.vue'
export default {
    components:{
        'donate-form': DonateForm,
        'donateform-edit': DonateFormEdit
    },
    data: () =>({
        donateList: [],
        first_name: null,
        last_name: null,
        email: null,
        phone: null,
        city: null,
        aba_number: null,
        donate: null,
        dialogDelete: false,
        donateId: null,
        noData: "No data on Donation",
        update_donate: false,
        donate_info: "",
    }),
    methods:{
        getDonate(){
            axios.get('/sponsors').then(res=>{
                this.donateList = res.data;
            })
        },
        cancel(isFalse){
            this.update_donate = isFalse;
        },
        updateDonation(sponsor){
            this.update_donate = true;
            this.donate_info = sponsor;
        },
        EditDonate(id, donateData, isFalse){
            axios.put('/sponsors/'+ id , donateData).then(res=>{
            console.log(res.data);
            this.update_donate = isFalse;
            this.getDonate();
            })
        },
        deleteItem(id){
            this.dialogDelete = true;
            this.donateId = id;
        },
        closeDelete(){
            this.dialogDelete = false;
        },
        deleteItemConfirm(){
            axios.delete('/sponsors/'+ this.donateId).then(res=>{
            console.log(res.data);
            this.closeDelete();
            this.getDonate();
            })
        },
    },
    mounted() {
        this.getDonate();
    }
}
</script>

<style scoped>
    section{
        margin-top: 13vh;
    }
    .card{
        width: 40%;
        height: 15vh;
        background: rgb(213, 213, 213);
        border-radius: 5px;
        margin-top: 15px;
        display: flex;
    }

    .action{
        display: flex;
        margin-right: 5%;
        align-items: center;
        justify-content: center;
    }

    .i{
        width: 100%;
       
    }
    #action-btn{
        margin-bottom: 20px;
    }

    #edit{
        color: rgb(59, 114, 252);
        cursor: pointer;
    }

    #delete{
        color: rgb(250, 56, 59);
        cursor: pointer;
    }
</style>