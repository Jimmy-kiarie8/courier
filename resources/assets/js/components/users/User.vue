<template>
 <div>
  <v-content>
   <v-container fluid fill-height v-show="!loader">
    <v-layout justify-center align-center>
     <div class="container">
      <div class="row justify-content-center">
       <div class="col-md-12">
        <v-container fluid>
         <v-layout row wrap>
                  <!-- <v-flex xs4 sm3>
                    <v-subheader v-text="'Autocomplete'"></v-subheader>
                 </v-flex> -->
                 <v-flex xs4 sm3>
                   <v-select
                   :items="states"
                   v-model="a1"
                   label="Select"
                   autocomplete
                   ></v-select>
                </v-flex>

                <v-flex xs4 sm3>
                   <v-text-field
                   v-model="search"
                   color="blue darken-2"
                   label="Search Users"
                   required
                   ></v-text-field>
                </v-flex>
                <v-divider></v-divider>
                <v-btn slot="activator" color="primary" dark @click="openAdd">Add User</v-btn>
             </v-layout>
          </v-container>
                <!-- <select class="custom-select">
                  <option selected>Open this select menu</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
               </select> -->
            </div>
         </div>
         <!-- users display -->
         <div class="row">
          <div class="col-md-3" v-for="Alluser, key in temp" :key="Alluser.id">
           <div class="card border-primary mb-3" style="max-width: 18rem;">
            <div class="card-header">
              {{Alluser.name}}'s Details
              <v-btn color="danger" style="float: right;" @click="del(key, Alluser.id)">Delete</v-btn>
            </div>
            <div class="card-body text-primary">
             <img src="/storage/profile/land.jpg" alt="Profile image" class="img-responsive" style="width:100%; height: 100px;">
             <img id="profile" src="/storage/profile/noimage.png" alt="Profile image" class="img-responsive text-center"><br>
             <small><i class="fa fa-user"></i>Name: {{Alluser.name}}</small><br>
             <small><i class="fa fa-envelope"></i>Email: {{Alluser.email}}</small>
                    <!-- <small><i class="fa fa-phone"></i>Phone Number: {{Alluser.phone}}</small><br>
                       <small><i class="fa fa-envelope"></i>Address: {{Alluser.address}}</small><br>  -->                 
                    </div>
                    <div class="card-footer text-primary">
                       <v-btn slot="activator" color="default" dark @click="openShow(key)"  xs4 sm3 class="col-md-5">More</v-btn>
                       <v-btn slot="activator" color="default" dark @click="openEdit(key)"  xs4 sm3>Edit</v-btn>
                    </div>
                 </div>
              </div>
           </div>
           <!-- users display -->


        </div>
     </v-layout>
  </v-container>
   <div v-show="loader" style="text-align: center; width: 100%;">
       <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
   </div>
  <v-snackbar
  :timeout="timeout"
  :bottom="y === 'bottom'"
  :color="color"
  :left="x === 'left'"
  v-model="snackbar"
  >
  {{ message }}
  <v-btn flat color="white">Close</v-btn>
</v-snackbar>
</v-content>
<AddUser @closeRequest="close" :openAddRequest="dispAdd" @alertRequest="showAlert"></AddUser>
<ShowUser @closeRequest="close" :openShowRequest="dispShow"></ShowUser>
<EditUser @closeRequest="close" :openEditRequest="dispEdit" @alertRequest="showAlert"></EditUser>
</div>
</template>

<script>
let AddUser = require('./AddUser.vue')
let ShowUser = require('./ShowUser.vue')
let EditUser = require('./EditUser.vue')
export default {
  props: ['user', 'role'],
 components: {
  AddUser, ShowUser, EditUser
}, 
data() {
  return{
   search: '',
   loader: false,
   a1: null,
   dispAdd: false,
   dispShow: false,
   dispEdit: false,
   snackbar: false,
   timeout: 5000,
   color: 'black',
   message: 'Success',
   y: 'bottom',
   x: 'left',
   Allusers: {},
   temp: '',
   states: [
   'Virgin Island', 'Virginia',
   'Washington', 'West Virginia', 
   'Wisconsin', 'Wyoming'
   ]
}
},
watch: {
  search() {
   if (this.search.length > 0) {
    this.temp = this.Allusers.filter((item) => {
     return item.name.toLowerCase().indexOf(this.search.toLowerCase())>-1
  });
 }else{
    this.temp = this.Allusers
 }
}
},
methods: {
  openShow(key) {
      // this.$children[4].list = this.company[key]
      this.$children[2].list = this.Allusers[key]
      this.dispShow  = true
   },
   openAdd(){
      this.dispAdd  = true
   },
   openEdit(key) {
      // this.$children[4].list = this.company[key]
      this.$children[3].form = this.Allusers[key]
      this.dispEdit  = true
   },

   showAlert(){
      this.message = 'Successifully Added';
      this.snackbar = true;
      this.color = black;
   },
   del(key, id) {
      if (confirm('Are you sure you want to delete this item?')) {
        this.loader = true
        axios.delete(`/users/${id}`)
        .then((response) => {
          this.Allusers.splice(index, 1)
          this.loader = false
          this.message = 'deleted successifully'
          this.color = 'red'
          this.snackbar = true
        })
        .catch((error) => {
          this.errors = error.response.data.errors
          this.loader = false
          this.message = 'something went wrong'
          this.color = 'red'
          this.snackbar = true
        })
      }
   },
   close() {
      this.dispAdd= this.dispShow = this.dispEdit  =  false
   },
},
mounted() {
  this.loader=true
  axios.post('getUsers')
  .then((response) => {
    this.Allusers = this.temp = response.data
    this.loader=false
  })
  .catch((error) => {
      this.errors = error.response.data.errors
      this.loader=false
    })
}
}
</script>


<style scoped>
.content--wrap{
 margin-top: -100px
}
#profile { 
 width: 70px;
 height: 60px;
 border-radius: 50%;
 margin-left: 80px;
 margin-top: -30px;
}
i{
 padding: 7px;
 background: #f0f0f0;
 border-radius: 50%;
}
.list-group-item:hover, .list-group-item:focus {
 z-index: 1;
 background: #f9f9f9;
 text-decoration: none;
}
</style>