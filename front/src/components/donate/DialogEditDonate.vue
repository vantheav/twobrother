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
                <v-btn color="error" @click="cancel"> Cancel</v-btn>
            <v-btn color="primary" @click="edit">Update</v-btn>
            </v-card-actions> 
        </form>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
    export default {
        props: ['data'],
        emits:['update', 'cancel'],
        data: () =>({
            dialog : false,
            first_name: null,
            last_name: null,
            email: null,
            phone: null,
            city: null,
            aba_number: null,
            donate: null,
            donateId: null,
        }),
        methods:{
          cancel(){
            this.$emit('cancel', false);
          },
          edit(){
            let editDonate = {
              'first_name': this.first_name,
              'last_name': this.last_name,
              'email': this.email,
              'phone': this.phone,
              'city': this.city,
              'aba_number': this.aba_number,
              'donate': this.donate
            }
            this.$emit('update', this.donateId, editDonate, false);
          }
        },
        mounted(){
          this.first_name = this.data.first_name;
          this.last_name = this.data.last_name;
          this.email = this.data.email;
          this.phone = this.data.phone;
          this.city = this.data.city;
          this.aba_number = this.data.aba_number;
          this.donate = this.data.donate;
        }
    }
</script>
<style scoped>
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