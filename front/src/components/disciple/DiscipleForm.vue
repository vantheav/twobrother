<template>
  <div class="">
    <v-dialog v-model="dialog" width="400" transition="dialog-top-transition">
      <template v-slot:activator="{ on, attrs }" class="create-user-btn">
        <v-btn color="red darken-1" dark class="mb-2" v-bind="attrs" v-on="on" bottom fab fixed right> + </v-btn>
      </template>
      <v-card>
        <form>
          <h1>Disciple notice</h1> <br>
          <label for="cars">Choose student</label>
            <select class="selected" id="cars" v-model="studentSelected">
              <option v-for="student of studentsList" :key="student.id" :value=student.id>{{student.first_name}} {{student.last_name}}</option>
            </select>
          <label for="cars">Choose discipline notice type</label>
            <select class="selected" id="cars" v-model="type">
              <option v-for="leave of leavetype" :key="leave" :value=leave>{{leave}}</option>
            </select>
          <label for="cars">Start Date: </label><br>
          <input type="date" name="" id="" v-model="date"><br>
          <v-textarea label="Description" auto-grow outlined row-height="15" v-model="description"></v-textarea>
          <small>{{ errorMessage }}</small>
          <v-card-actions>
            <v-btn color="error" @click="cancelCreate"> Cancel</v-btn>
            <v-btn color="primary" @click="CreateDisciple"> Create</v-btn>
          </v-card-actions> 
        </form>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
  import axios from '../../axios-request.js'
  export default {
    emits:['add-disciple'],
    data: () => ({
      studentSelected:null,
      date:null,
      type: null,
      description: null,
      leavetype: ["Notation", "Oral warning", "Warning letter", "Termination"],
      studentsList: [],
      dialog : false,
      errorMessage: "",
    }),
    methods: {
      CreateDisciple(){
        let newDisciple = {
          'student_id': this.studentSelected,
          'dateWn': this.date,
          'type': this.type,
          'description': this.description,
        }
        if(this.studentSelected != null){
          axios.post('/disciple', newDisciple).then(res=>{
            console.log(res.data);
            this.dialog = false;
            this.$emit('add-disciple', res.data);
          }).catch((error) => {
            console.log(error);
            this.errorMessage = "Oops! អ្នកត្រូវតែបំពេញគ្រប់ Field ទាំងអស់";
          });
        }
        this.studentSelected = "";
        this.date = "";
        this.type = "";
        this.description = "";
        this.errorMessage = "";
      },
      cancelCreate(){
        this.dialog = false;
        this.errorMessage = "";
      },
      getAllStudent(){
        axios.get('/students').then(res =>{
          this.studentsList = res.data;
        })
      },
    },
    mounted() {
      this.getAllStudent();
    },
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

  .selected, input[type=date]{
    width: 100%;
    background: rgba(191, 190, 190, 0.809);
    border-radius: 2px;
    height: 35px;
    padding: 0 5px;
    color: rgb(49, 47, 47);
    margin-bottom: 10px;
    border: none;
  }

  small{
    color: red;
    margin-top: 10px;
    margin-left: 20%;
  }
</style>