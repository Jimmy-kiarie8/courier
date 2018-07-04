<template>
   <v-content>
      <v-container fluid fill-height v-show="!loader">
         <v-layout justify-center align-center>
            <v-snackbar
            v-model="snackbar"
            absolute
            bottom
            left
            dark
            :color="color"
            >
            <span>{{message}}</span>
            <v-icon dark>{{icon}}</v-icon>
         </v-snackbar>
         <v-card>
            <v-flex sm8 offset-sm2>
               <v-form ref="form" @submit.prevent="submit" style="width: 100%;">
                  <v-container grid-list-md text-xs-center>
                     <v-layout row wrap>
                        <v-flex xs12 sm6 offset-sm2>
                           <v-layout row wrap>
                              <v-flex xs12 sm6>
                                 <v-text-field
                                 v-model="form.bar_code"
                                 color="blue darken-2"
                                 label="Outscan"
                                 required
                                 style="margin-top: 40px;"
                                 ></v-text-field>
                                 <v-btn 
                                 color="primary" 
                                 flat
                                 @click="Outscan"
                                 >Outscan
                              </v-btn>
                           </v-flex>
                           <v-flex xs12 sm6>
                              <barcode :value="form.bar_code" style="height: 30px;"></barcode> 
                           </v-flex>
                        </v-layout>
                     </v-flex> 
                     <v-divider></v-divider>
                     <v-divider></v-divider>
                     <v-flex xs12 sm6 offset-sm2>
                        <v-layout row wrap>
                           <v-flex xs12 sm6>
                              <v-text-field
                              v-model="form.bar_code_in"
                              color="blue darken-2"
                              label="Inscan"
                              required
                              style="margin-top: 40px;"
                              ></v-text-field>
                              <v-btn 
                              color="primary" 
                              flat
                              @click="Inscan"
                              >Inscan
                           </v-btn>
                        </v-flex> 
                        <v-flex xs12 sm6>
                           <barcode :value="form.bar_code_in" style="height: 30px;"></barcode> 
                        </v-flex>
                     </v-layout>
                  </v-flex>  
               </v-layout> 
            </v-container>
         </v-form> 
      </v-flex>
   </v-card>  
</v-layout>
</v-container>

<div v-show="loader" style="text-align: center; width: 100%;">
  <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
</div>
</v-content>
</template>

<script>
import VueBarcode from 'vue-barcode';
export default {
 props: ['user', 'role'],
 components: {
  'barcode': VueBarcode
     // , UpdateShipment
  },
  data() {
   const defaultForm = Object.freeze({
      bar_code: ''
   })
   return{
      message: 'test',
      AllShipments: {},
      form: Object.assign({}, defaultForm),
      snackbar: false,
      errors: {},
      icon: 'check_circle',
      color: 'black',
      loader: false,
   }
},
methods: {
   resetForm () {
      this.form = Object.assign({}, this.defaultForm)
      this.$refs.form.reset()
   },
   Outscan () {
     var length = this.AllShipments.length;
     for(var i = 0; i < length; i++) {
      if(this.AllShipments[i].bar_code == this.form.bar_code) {
               // alert('success')
               this.loader=true
               axios.post(`/barcodeUpdate/${this.form.bar_code}`, this.$data.form)
               .then((response) => {
                  this.loader = false
                  console.log(response);
                  this.snackbar = true
                  this.message = 'successifully scanned'
                  this.icon = 'check_circle'
                  this.color = 'indigo'
                  this.resetForm()
               })
               .catch((error) => {
                  this.errors = error.response.data.errors
                  this.loader = false
               })  
                  // return true;
                  // die();
                  return;
               }else{
                  this.snackbar = true
                  this.message = "barcode doesn'/t exist... Please try again";
                  this.icon = 'block'
                  this.color = 'red'
               }
            }
         },
         Inscan () {
           var length = this.AllShipments.length;
           for(var i = 0; i < length; i++) {
            if(this.AllShipments[i].bar_code == this.form.bar_code_in) {
               // alert('success')
               this.loader=true
               axios.post(`/barcodeIn/${this.form.bar_code_in}`, this.$data.form)
               .then((response) => {
                  this.loader = false
                  console.log(response);
                  this.snackbar = true
                  this.message = 'successifully scanned'
                  this.icon = 'check_circle'
                  this.color = 'indigo'
                  this.resetForm()
               })
               .catch((error) => {
                  this.errors = error.response.data.errors
                  this.loader = false
               })  
                  // return true;
                  // die();
                  return;
               }else{
                  this.snackbar = true
                  this.message = "barcode doesn'/t exist... Please try again";
                  this.icon = 'block'
                  this.color = 'red'
               }
            }
         },
      },
      mounted() {
         this.loader = true
         axios.post('/getShipments')
         .then((response) => {
            this.AllShipments = response.data
            this.loader = false
         })
         .catch((error) => {
            this.errors = error.response.data.errors
            this.loader = false
         })
      },
      computed: {
         formIsValid () {
           return (
             this.form.bar_code
             )
        }
     },
  }
  </script>


  <style scoped>

  </style>
// 0000002