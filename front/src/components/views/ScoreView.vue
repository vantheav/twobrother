<template>
  <section>
    <br>
    <score-form @add-score="getAllScores"></score-form>
    <edit-score v-if="show_update" :data="scoreInfo" @edit-score="UpdateScore" @cancel="cancel"></edit-score>
    <div>
      <v-container>
        <template>
          <v-dialog v-model="dialogDelete" max-width="450px">
            <v-card>
              <br>
              <v-card-title class="red--text">Are you sure you want to remove this Score?</v-card-title><br>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn id="action-btn" depressed color="primary" @click="dialogDelete = false">Cancel</v-btn>
                <v-btn id="action-btn" depressed color="error" @click="deleteItemConfirm">YES</v-btn>
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <v-card-title class="title">
            <strong class="t">Scores</strong>
          </v-card-title>
          <div v-if="scoreList == ''" class="ms">
              <br>
              <h2 >{{noData}}</h2>
          </div>
          <v-card v-else color="" green>
            <v-simple-table>
              <template v-slot:default>
                <thead class="blue-grey darken-3">
                  <th scope="col">Profile</th>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Java</th>
                  <th scope="col">JavaScript</th>
                  <th scope="col">Python</th>
                  <th scope="col">Html Css</th>
                  <th scope="col">PL</th>
                  <th scope="col">English</th>
                  <th scope="col">AVG</th>
                  <th scope="col">Grade</th>
                  <th scope="col">Action</th>
                </thead>
                <tbody class="text-center" style="text-align: center; align-items: center;justify-content: center; height:8vh;">
                  <tr class="data" v-for="(score, index) in scoreList" :key="index">
                    <td class="img">
                      <v-img height="50" width="50" :src="imgUrl + score.student.image" class="pa-7 secondary rounded-circle d-inline-block"></v-img>
                    </td>
                    <td>{{ score.student.first_name }}</td>
                    <td>{{ score.student.last_name }}</td>
                    <td>{{ score.java }}pts</td>
                    <td>{{ score.javascript }}pts</td>
                    <td>{{ score.python }}pts</td>
                    <td>{{ score.htmlcss }}pts</td>
                    <td>{{ score.pl }}pts</td>
                    <td>{{ score.english }}pts</td>
                    <td>{{ ((score.english + score.pl+ score.htmlcss + score.python + score.javascript + score.java) / 10) }}</td>
                    <td v-if="((score.english + score.pl+ score.htmlcss + score.python + score.javascript + score.java) / 10) == 50">A+</td>
                    <td v-else-if="((score.english + score.pl+ score.htmlcss + score.python + score.javascript + score.java) /10) > 44">A</td>
                    <td v-else-if="((score.english + score.pl+ score.htmlcss + score.python + score.javascript + score.java) /10) > 39">B</td>
                    <td v-else-if="((score.english + score.pl+ score.htmlcss + score.python + score.javascript + score.java) / 10) > 34">C</td>
                    <td v-else-if="((score.english + score.pl+ score.htmlcss + score.python + score.javascript + score.java) / 10) > 29">D</td>
                    <td v-else-if="((score.english + score.pl+ score.htmlcss + score.python + score.javascript + score.java) / 10) > 24">E</td>
                    <td  v-else>F</td>
                    <td>
                      <v-icon mediem id="edit" class="mr-2" @click="editItem(score)">mdi-pencil</v-icon>
                      <v-icon mediem id="delete" @click="deleteItem(score)">mdi-delete</v-icon>
                    </td>
                  </tr>
                </tbody>
              </template>
            </v-simple-table>
          </v-card>
        </template>
      </v-container>
    </div>
  </section>
</template>

<script>
  import axios from "../../axios-request.js";
  import ScoreForm from "../score/scoreForm.vue";
  import EditScore from '../score/scoreDialog.vue';
  export default {
    components:{
      'score-form': ScoreForm,
      'edit-score': EditScore
    },
    data: () => ({
      emits: ["edit-score"],
      scoreList: [],
      imgUrl: "http://127.0.0.1:8000/storage/images/",
      dialog: false,
      dataStudent: "",
      dialogDelete: false,
      searchUsername:'',
      show_update: false,
      noData: "No data available",
      scoreID : '',
      scoreInfo: ''
    }),
    methods: {
      editItem(score){
        this.scoreInfo = score;
        this.show_update = true;
      },
      UpdateScore(id, edited, isFalse){
        axios.put('/score/'+ id, edited).then(res=>{
          console.log(res.data);
          this.show_update = isFalse;
          this.getAllScores();
        })
      },
      cancel(isFalse){
        this.show_update = isFalse;
      },
      getAllScores(){
        axios.get('/score').then(res=>{
          this.scoreList = res.data;
        })
      },
      deleteItem(score){
        this.dialogDelete = true;
        this.scoreID = score.id;
        console.log(this.scoreID);
      },
      deleteItemConfirm(){
        axios.delete('/score/'+ this.scoreID).then(res=>{
          console.log(res.data);
          this.dialogDelete = false;
          this.getAllScores();
        })
      }
    },
    mounted() {
      this.getAllScores();
    }
  }
</script>

<style scoped>

  .ms{
    text-align: center;
    justify-content: center;
    align-items: center;
    display: flex;
    color: grey;
  }

  body{
    background: #CFD8DC;
  }
  section{
    margin-top: 2.5vh;
  }

  .title{
    margin-left: -1.5%;
  }

  .search{
    margin-right: -1.5%;
    width: 9%;
  }

  .t{
    margin-top: 3%;
  }
  
  .text-h5 {
    color: white;
  }

  .btn-create {
    margin: 10px;
  }

  v-radio {
    display: flex;
  }

  thead {
    height: 7vh;
    font-size: 18px;
  }

  thead th {
    color: #fff;
    font-size: 15px;
  }

  tbody tr{
    height: 12vh;
  }

  #action-btn{
    margin-bottom: 20px;
  }

  #edit{
    color: rgb(59, 114, 252);
  }

  #delete{
    color: rgb(250, 56, 59);
  }
</style>