<template>
    <section>
        <donate-form @add-donate="getDonate"></donate-form>
        <donateform-edit v-if="update_donate" :data="donate_info" @update="EditDonate"></donateform-edit>
        <div class="container">
            <div class="left">
                <h1>hh</h1>
            </div>
            <div class="right">
                <div id="card" v-for="(sponsor, i) in donateList" :key="i">
                    <div v-if="donateList==0">
                        <br><br>
                        <h2 class="grey--text" >{{noData}}</h2>
                    </div>
                    <v-dialog v-model="dialogDelete" max-width="500px" transition="dialog-top-transition">
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
                    <div id="i">
                        <div id="text">
                            <h4>First name:</h4><span> {{ sponsor.first_name}}</span>
                        </div>
                        <div id="text">
                            <h4>Last name:</h4><span> {{ sponsor.last_name}}</span>
                        </div>
                        <div id="text">
                            <h4>ABA number:</h4><span> {{ sponsor.aba_number}}</span></div>
                        <div id="text">
                            <h4>Donate amount:</h4><span> $ {{ sponsor.donate}}</span>
                        </div>  
                    </div>
                    <div class="action">                    
                        <v-icon mediem id="delete" @click="deleteItem(sponsor.id)">mdi-delete</v-icon>
                    </div>
                </div>
            </div>
        </div>
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
        donate_info: "",
    }),
    methods:{
        getDonate(){
            axios.get('/sponsors').then(res=>{
                this.donateList = res.data;
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
    .container{
        display: flex;
        width: 100%;
        /* background: #000; */
    }

    .left{
        width: 40%;
        height: 100%;
        margin: 10px;
        background: cornflowerblue;
    }

    .right{
        width: 60%;
        height: 100%;
        background: #fff;
        margin: 5px;
    }
    #card{
        width: 100%;
        height: 15vh;
        background: rgb(240, 240, 240);
        border-radius: 5px;
        display: flex;
        padding: 15px;
        margin: 5px;
    }

    #text{
        display: flex;
    }

    .action{
        display: flex;
        margin-right: 5%;
        align-items: center;
        justify-content: center;
    }

    #i{
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