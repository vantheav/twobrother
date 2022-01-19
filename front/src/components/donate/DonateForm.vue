<template>
  <div class="">
    <v-dialog v-model="dialog" width="500" transition="dialog-top-transition">
      <template v-slot:activator="{ on, attrs }" class="create-user-btn">
        <v-btn color="red darken-1" dark class="mb-2" v-bind="attrs" v-on="on" bottom fab fixed right> + </v-btn>
      </template>
      <v-card>
        <br>
        <h2 class="d-t">Donate</h2>
        <form>
            <div class="input">
              <div class="left"> 
                <v-text-field outlined dense :append-icon="'mdi-account'" ref="first name" label="First Name" v-model="first_name" required></v-text-field>
                <v-text-field outlined dense :append-icon="'mdi-account'" ref="last name" label="Last Name" v-model="last_name" required></v-text-field>
                <v-text-field outlined dense :append-icon="'mdi-email'" ref="email" label="Email" v-model="email" required></v-text-field>
              </div>
              <div class="right">
                <v-text-field outlined dense :append-icon="'mdi-phone-in-talk'" ref="phone" label="Phone" v-model="phone" required></v-text-field>
                <v-text-field outlined dense :append-icon="'mdi-flag'" ref="phone" label="City" v-model="city" required></v-text-field>
                <v-text-field outlined dense :append-icon="'mdi-console'" ref="card" label="ABA number" v-model="aba_number" required></v-text-field>
              </div> 
            </div>
            <v-text-field outlined dense :append-icon="'mdi-currency-usd'" ref="money" label="Donate" v-model="donate" required></v-text-field>
            <v-card-actions>
                <v-btn color="error" @click="cancelCreate"> Cancel</v-btn>
                <v-btn color="primary" @click="createDonate"> Create</v-btn>
            </v-card-actions> 
        </form>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
    import axios from '../../axios-request.js'
    export default {
      emits:['add-donate'],
      data: () =>({
          dialog : false,
          first_name: null,
          last_name: null,
          email: null,
          phone: null,
          city: null,
          aba_numbe: null,
          donate: null
      }),
      methods:{
        createDonate(){
          let donate = {
            'first_name': this.first_name,
            'last_name': this.last_name,
            'email': this.email,
            'phone': this.phone,
            'city': this.city,
            'aba_number': this.aba_number,
            'donate': this.donate,
          }
          if(this.donate != null){
            axios.post('/sponsors', donate).then(res=>{
              this.dialog = false;
              this.$emit('add-donate', res.data);
              console.log(res.data);
            })
          }
          this.first_name = "";
          this.last_name = "";
          this.email = "";
          this.phone = "";
          this.city = "";
          this.aba_number = "";
          this.donate = "";
        },
        cancelCreate(){
          this.dialog = false;
        },
      },
      mounted(){
        this.createDonate();
      }
    }
</script>
<style scoped>

  h1{
      margin-left: 18%;
  }
  
  .create-user-btn {
    top: 85vh;
    float: right;
    position: fixed;
  }

  form{
    padding: 15px;
  }
  .d-t{
      text-align: center;
  }

  .input{
    display: flex;
  }

  .right{
    margin-left: 9%;
  }


</style>