<template>
  <div>
    <v-content>
      <v-container fluid fill-height v-show="!loader">
        <v-layout justify-center align-center>
         <div v-show="loader" style="text-align: center">
           <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
        </div> 

      <v-dialog v-model="Customerdialog" fullscreen hide-overlay transition="dialog-bottom-transition">
          <!-- <v-btn slot="activator" color="primary" dark>Open Dialog</v-btn> -->
          <v-card>
            <v-toolbar dark color="primary">
              <v-btn icon dark @click.native="Customerdialog = false">
                <v-icon>close</v-icon>
              </v-btn>
              <v-toolbar-title>Customer Profile</v-toolbar-title>
              <v-spacer></v-spacer>
              <!-- <v-toolbar-items>
                <v-btn dark flat @click.prevent="dialog = false">Save</v-btn>
              </v-toolbar-items> -->
            </v-toolbar>
            <v-flex xs12 sm10 offset-sm1>
               <v-card>
                 <v-card-title primary-title>
                   <div>
                     <h3 class="headline mb-0">All Booking</h3>
                     <table class="table table-hoover table-stripped col-md-8 col-md-offset-2">
                        <thead>
                           <th>Booking date</th>
                           <th>From</th>
                           <th>To</th>
                           <th>Information</th>
                           <th>Status</th>
                        </thead>
                        <tbody v-for="shipment in AllShipments" :key="shipment.id">
                           <tr v-if="CustomerInfo.id === shipment.customer_id">
                              <td>{{shipment.booking_date}}</td>
                              <td>{{shipment.client_name}}</td>
                              <td>{{shipment.sender_name}}</td>
                              <td>{{shipment.client_email}}</td>
                              <td>{{shipment.status}}</td>
                           </tr>
                        </tbody>
                     </table>
                   </div>
                 </v-card-title>
                 <v-divider></v-divider>
                 <v-divider></v-divider>

                 <v-card-title primary-title>
                   <div>
                     <h3 class="headline mb-0">Approved Shipments</h3>
                     <table class="table table-hoover table-stripped col-md-8 col-md-offset-2">
                        <thead>
                           <th>Booking date</th>
                           <th>From</th>
                           <th>To</th>
                           <th>Email</th>
                           <th>Scheduled derivery</th>
                           <th>Status</th>
                        </thead>
                        <tbody v-for="shipment in AllShipments" :key="shipment.id">
                           <tr 
                              v-for="customer in CustomerInfo" 
                              v-if="customer.id === shipment.customer_id && shipment.status === 'Approved'">
                              <td>{{shipment.booking_date}}</td>
                              <td>{{shipment.client_name}}</td>
                              <td>{{shipment.sender_name}}</td>
                              <td>{{shipment.client_email}}</td>
                              <td>{{shipment.derivery_date}}</td>
                              <td>{{shipment.status}}</td>
                           </tr>
                        </tbody>
                     </table>
                   </div>
                 </v-card-title>
               </v-card>
             </v-flex>
          </v-card>
      </v-dialog>

        <div v-show="!loader">
           <v-card-title>
            <!-- <v-btn color="primary" flat @click="openContainer">Customer</v-btn> -->
             Containers
             <v-spacer></v-spacer>
             <v-text-field
             v-model="search"
             append-icon="search"
             label="Search"
             single-line
             hide-details
             ></v-text-field>
          </v-card-title>
          <v-data-table
          :headers="headers"
          :items="Allcustomers"
          :search="search"
          counter
          class="elevation-1"
          >
          <template slot="items" slot-scope="props">
           <td>
            {{ props.item.name }}
         </td>
     <td class="text-xs-right">{{ props.item.email }}</td>
     <td class="text-xs-right">{{ props.item.phone }}</td>
     <td class="text-xs-right">{{ props.item.address }}</td>
     <td class="text-xs-right">{{ props.item.created_at }}</td>
     <td class="text-xs-right">{{ props.item.status }}</td>
     <td class="justify-center layout px-0">
         <v-btn icon class="mx-0" @click="showDetails(props.item)">
            <v-icon color="blue darken-2">visibility</v-icon>
         </v-btn>
      </td> 
</template>
<v-alert slot="no-results" :value="true" color="error" icon="warning">
 Your search for "{{ search }}" found no results.
</v-alert>
<template slot="pageText" slot-scope="{ pageStart, pageStop }">
 From {{ pageStart }} to {{ pageStop }}
</template>
</v-data-table>
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
<AddCustomer @closeRequest="close" :openAddRequest="dispAdd" @alertRequest="showAlert"></AddCustomer>
<ShowCustomer @closeRequest="close" :openShowRequest="dispShow"></ShowCustomer>
<EditCustomer @closeRequest="close" :openEditRequest="dispEdit" @alertRequest="showAlert"></EditCustomer>
</div>
</template>

<script>
let AddCustomer = require('./AddCustomer.vue')
let ShowCustomer = require('./ShowCustomer.vue')
let EditCustomer = require('./EditCustomer.vue')
export default {
 props: ['user', 'role'],
 components: {
  AddCustomer, ShowCustomer, EditCustomer
}, 
data() {
  return{
   select: { state: 'All', abbr: 'all' },
   items: [
   { state: 'All', abbr: 'all' },
   { state: 'Admin', abbr: 'Admin' },
   { state: 'company Admin', abbr: 'companyAdmin' },
   { state: 'Customers', abbr: 'Customer' },
   { state: 'Drivers', abbr: 'Driver' },
   ],

   headers: [
     {
         text: 'Customer Name',
         align: 'left',
         value: 'name'
      },
    { text: 'Email', value: 'email' },
    { text: 'Phone Number', value: 'phone' },
    { text: 'Address', value: 'address' },
    { text: 'Registed On', value: 'created_at' },
    { text: 'Status', value: 'status' },
    { text: 'Actions', value: 'name', sortable: false }
    ],
   search: '',
   loader: false,
   a1: null,
   Customerdialog: false,
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
   Allcustomers: [],
   temp: '',
   editedItem: {},
   CustomerInfo: {},
   AllShipments: {},
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

   editItem (item) {
     /*this.editedItem = Object.assign({}, item)
     this.editedIndex = this.Allcustomers.indexOf(item)
     // console.log(this.editedItem);
     this.dialog1 = true*/
   },

   showDetails (item) {
     this.CustomerInfo = Object.assign({}, item)
     this.editedIndex = this.Allcustomers.indexOf(item)
     this.Customerdialog = true
   },


      deleteItem (item) {
        const index = this.Allcustomers.indexOf(item)
        if (confirm('Are you sure you want to delete this container?')) {
         axios.delete(`/customers/${item.id}`)
         .then((response) => {
             // this.snackbar = true
             this.text = 'deleted Success'
             this.Allcustomers.splice(index, 1)
             console.log(response);
           })
         .catch((error) => this.errors = error.response.data.errors)
       }       
       this.snackbar = false    
       this.color = 'red'    
       this.message = 'Something went wrong' 
     },       



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
})
  .catch((error) => {
   this.errors = error.response.data.errors
})

  axios.post('getCustomer')
  .then((response) => {
   this.Allcustomers = response.data
   this.loader=false
})
  .catch((error) => {
   this.errors = error.response.data.errors
   this.loader=false
})


      axios.post('/getShipments')
      .then((response) => {
        this.AllShipments = response.data
        this.loader=false
      })
      .catch((error) => {
        this.errors = error.response.data.errors
        this.loader=false
      })
},
beforeRouteEnter(to, from, next) {
   next(vm => {
     if (vm.role === 'Admin' || vm.role === 'companyAdmin') {
      next(); 
   } else {
      next('/');
   }
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