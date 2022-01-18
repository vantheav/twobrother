<template>
  <div class="">
    <v-dialog v-model="dialog" width="400">
      <template v-slot:activator="{ on, attrs }" class="create-user-btn">
        <v-btn color="red darken-1" dark class="mb-2" v-bind="attrs" v-on="on" bottom fab fixed right> + </v-btn>
      </template>
      <v-card>
        <form>
          <h1>Students Score</h1> <br>
          <label for="cars">Choose student</label>
            <select class="selected" id="cars" v-model="studentSelected">
              <option v-for="student of studentsList" :key="student.id" :value=student.id>{{student.first_name}} {{student.last_name}}</option>
            </select>
          <label for="cars">Java</label>
            <input type="number" name="" id="" min="0" max="100" v-model="java">
          <label for="cars">JavaScript</label>
            <input type="number" name="" id="" min="0" max="100" v-model="javascript">
          <label for="cars">Python</label>
            <input type="number" name="" id="" min="0" max="100" v-model="python">
          <label for="cars">Htmlcss</label>
            <input type="number" name="" id="" min="0" max="100" v-model="htmlcss">
          <label for="cars">PL</label>
            <input type="number" name="" id="" min="0" max="50" v-model="pl">
          <label for="cars">English</label>
            <input type="number" name="" id="" min="0" max="50" v-model="english">
          <v-card-actions>
            <v-btn color="error" @click="cancel"> Cancel</v-btn>
            <v-btn color="primary" @click="updateScore">Edit</v-btn>
          </v-card-actions> 
        </form>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
  import axios from '../../axios-request.js'
  export default {
    props: ['data'],
    emits:['edit-score', 'cancel'],
    data: () => ({
      studentSelected:null,
      java: 0,
      javascript: 0,
      python: 0,
      studentsList: [],
      dialog : true,
      htmlcss: 0,
      pl: 0,
      english: 0,
      scoreID: '',
    }),
    methods: {
      getAllStudent(){
        axios.get('/students').then(res =>{
          this.studentsList = res.data;
        })
      },
      updateScore(){
        let editScore = {
          'student_id': this.studentSelected,
          'java': this.java,
          'javascript': this.javascript,
          'python': this.python,
          'htmlcss': this.htmlcss,
          'pl': this.pl,
          'english': this.english,
        }
         if(this.studentSelected != null){
            this.$emit('edit-score',this.scoreID, editScore, false);
        }
      },
      cancel(){
          this.$emit('cancel',false);
      }
    },
    mounted() {
        this.studentSelected = this.data.student_id
        this.java = this.data.java;
        this.javascript = this.data.javascript;
        this.python = this.data.python;
        this.htmlcss = this.data.htmlcss;
        this.pl = this.data.pl;
        this.english = this.data.english;
        this.scoreID = this.data.id;
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