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
             <v-text-field prepend-icon="mdi-account" ref="first name" label="First Name" required></v-text-field>
            <v-text-field prepend-icon="mdi-account" ref="last name" label="Last Name" required></v-text-field>
            <v-text-field prepend-icon="mdi-email" ref="last name" label="Email" required></v-text-field>
            <v-text-field prepend-icon="mdi-phone-in-talk" ref="last name" label="Phone" required></v-text-field>
            <v-text-field prepend-icon="mdi-console" ref="last name" label="ABA account" required></v-text-field>
            <v-text-field prepend-icon="mdi-currency-usd" ref="last name" label="Donate" required></v-text-field>
            <v-card-actions>
                <v-btn color="error" > Cancel</v-btn>
                <v-btn color="primary" > Create</v-btn>
            </v-card-actions> 
        </form>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
    // import axios from '../../axios-request.js'
    export default {
        data: () =>({
            dialog : false,
        }),
        methods:{

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

  .selected, input[type=date], input[type=number]{
    width: 100%;
    background: rgba(191, 190, 190, 0.809);
    border-radius: 2px;
    height: 35px;
    padding: 0 5px;
    color: rgb(49, 47, 47);
    margin-bottom: 10px;
    border: none;
  }

</style>