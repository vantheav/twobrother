<template>
  <div class="">
    <v-dialog v-model="dialog" width="400" transition="dialog-top-transition">
      <template v-slot:activator="{ on, attrs }" class="create-user-btn">
        <v-btn color="red darken-1" dark class="mb-2" v-bind="attrs" v-on="on" bottom fab fixed right> + </v-btn>
      </template>
      <v-card>
        <form>
          <h1>Students Score</h1> <br>
          <div class="s-student">
            <label for="cars">Choose student</label>
            <select class="selected" id="cars" v-model="studentSelected">
              <option v-for="student of studentsList" :key="student.id" :value=student.id>{{student.first_name}} {{student.last_name}}</option>
            </select>
          </div>
          <div class="t-input">
            <div class="left">
              <label for="cars">Java</label>
                <input type="number" name="" id="" min="0" max="100" v-model="java">
              <label for="cars">JavaScript</label>
                <input type="number" name="" id="" min="0" max="100" v-model="javascript">
              <label for="cars">Python</label>
                <input type="number" name="" id="" min="0" max="100" v-model="python">
            </div>
            <div class="right">
              <label for="cars">Html / css</label>
                <input type="number" name="" id="" min="0" max="100" v-model="htmlcss">
              <label for="cars">PL</label>
                <input type="number" name="" id="" min="0" max="50" v-model="pl">
              <label for="cars">English</label>
                <input type="number" name="" id="" min="0" max="50" v-model="english">
            </div>
          </div>
          <small>{{ errorMessage }}</small>
          <v-card-actions>
            <v-btn color="error" @click="dialog = false"> Cancel</v-btn>
            <v-btn color="primary" @click="createStudentScore">Create</v-btn>
          </v-card-actions> 
        </form>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
  import axios from '../../axios-request.js'
  export default {
    emits:['add-score'],
    data: () => ({
      studentSelected:null,
      java: null,
      javascript: null,
      python: null,
      studentsList: [],
      dialog : false,
      htmlcss: null,
      pl: null,
      english: null,
      errorMessage: "",
    }),
    methods: {
      getAllStudent(){
        axios.get('/students').then(res =>{
          this.studentsList = res.data;
        })
      },
      createStudentScore(){
        let newScore = {
          'student_id': this.studentSelected,
          'java': this.java,
          'javascript': this.javascript,
          'python': this.python,
          'htmlcss': this.htmlcss,
          'pl': this.pl,
          'english': this.english,
        }
        axios.post('/score', newScore).then(res=>{
          this.$emit("add-score", res.data);
          this.dialog = false;
        }).catch((error) => {
          console.log(error);
          this.errorMessage = "Oops! អ្នកត្រូវតែបំពេញគ្រប់ Field ទាំងអស់";
        });
        this.java = "";
        this.javascript = "";
        this.pl = "";
        this.python = "";
        this.english = "";
        this.htmlcss = "";
        this.studentSelected = "";
      },
      cancelCreate(){
        this.dialog = false;
        this.errorMessage = "";
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
    width: 100%;
  }

  small{
    color: red;
    margin-top: 10px;
    margin-left: 20%;
  }

  .selected,input[type=number]{
    width: 100%;
    background: rgba(191, 190, 190, 0.809);
    border-radius: 2px;
    height: 35px;
    padding: 0 5px;
    color: rgb(49, 47, 47);
    margin-bottom: 10px;
    border: none;
  }

  .s-student{
    padding: 10px;
  }

  .t-input{
    display: flex;
  }

  .left,
  .right{
    padding: 10px;
    width: 50%;
  }

</style>