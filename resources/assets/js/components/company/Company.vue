<template>
  <div>
    <v-content>
      <div v-show="loader" style="text-align: center; width: 100%;">
        <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
      </div>

      <!-- Edit dialog -->
      <v-dialog v-model="editModal" persistent max-width="700px">
        <v-card>
          <v-card-title fixed>
            <span class="headline">Add A Company</span>
          </v-card-title>
          <v-card-text>
            <v-container grid-list-md>
              <div v-show="Editloader" style="text-align: center; width: 100%;">
                <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
              </div>
              <v-layout wrap v-show="!Editloader">
                <v-form ref="form" @submit.prevent="submit">
                  <v-container grid-list-xl fluid>
                    <v-layout wrap>
                      <v-flex xs12 sm6>
                        <v-text-field
                          v-model="editedItem.company_name"
                          :rules="rules.name"
                          color="blue darken-2"
                          label="Company name"
                          required
                        ></v-text-field>
                      </v-flex>
                      <!-- <v-flex xs12 sm6>
                        <v-text-field
                        v-model="editedItem.admin"
                        :rules="rules.name"
                        color="blue darken-2"
                        label="Branch name"
                        required
                        ></v-text-field>
                      </v-flex> -->
                      <v-flex xs12 sm6>
                        <v-text-field
                        v-model="editedItem.address"
                        :rules="rules.name"
                        color="blue darken-2"
                        label="Company Address"
                        required
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12 sm6>
                        <v-text-field
                        v-model="editedItem.phone"
                        color="blue darken-2"
                        label="Telephone Number"
                        required
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12 sm6>
                        <v-text-field
                        v-model="editedItem.email"
                        :rules="emailRules"
                        color="blue darken-2"
                        label="Branch Email"
                        required
                        ></v-text-field>
                      </v-flex>

                    <!-- Location -->
                    <div class="flex xs12 sm6">
                      <div class="input-group input-group--required input-group--text-field blue--text text--darken-2">
                        <div class="input-group__input">
                          <vue-google-autocomplete
                          ref="address"
                          id="map"
                          placeholder="Company Location"
                          v-on:placechanged="getAddressData"
                          country="ke"
                          aria-label="Company Address"
                          tabindex="0"
                          ></vue-google-autocomplete>
                        </div>
                        <div class="input-group__details"><!----></div>
                      </div>
                    </div>
                    <!-- Location -->


                       <v-flex xs4 sm3>
                         <v-select
                          :items="Allusers"
                          v-model="editedItem.admin"
                          label="Select"
                          single-line
                          item-text="name"
                          item-value="id"
                          return-object
                          persistent-hint
                        ></v-select>
                      </v-flex>

                    </v-layout>
                  </v-container>
                  <v-card-actions>
                    <v-btn flat @click="resetForm">reset</v-btn>
                    <v-btn flat @click="close">Close</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn
                    :disabled="!formIsValid"
                    flat
                    color="primary"
                    @click="save"
                    >Submit</v-btn>
                  </v-card-actions>
                </v-form>
              </v-layout>
            </v-container>
          </v-card-text>
        </v-card>
      </v-dialog>
      <!-- Edit dialog -->

      <v-container fluid fill-height v-show="!loader">
        <v-layout justify-center align-center>
          <!-- <v-btn @click="openAdd" color="primary">Add A Branch</v-btn> -->
          <div v-show="!loader">
           <v-card-title>
            <v-btn color="primary" raised @click="openAdd">Add Company</v-btn>
            Companies
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
            :items="AllCompanies"
            :search="search"
            counter
            class="elevation-1"
          >
          <template slot="items" slot-scope="props">
          <td>{{ props.item.company_name }}</td>
          <td class="text-xs-right">{{ props.item.phone }}</td>
          <td class="text-xs-right">{{ props.item.email }}</td>
          <td class="text-xs-right">{{ props.item.address }}</td>
          <td class="justify-center layout px-0">
           <v-btn icon class="mx-0" @click="editItem(props.item)">
             <v-icon color="blue darken-2">edit</v-icon>
           </v-btn>
           <v-btn icon class="mx-0" @click="deleteItem(props.item)">
             <v-icon color="pink darken-2">delete</v-icon>
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
</v-content>
<AddCompany :openAddRequest="OpenAdd" :compAdmin='Allusers' @closeRequest="close" @alertRequest="alert"></AddCompany>
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
</div>
</template>

<script>
let AddCompany = require('./AddCompany')
import VueGoogleAutocomplete from 'vue-google-autocomplete'
export default {
  props: ['user', 'role'],
  components: {
    AddCompany, VueGoogleAutocomplete
  },
  data () {
    return{
      select: {},
      /*items: [
        { state: 'Admin', abbr: 'Admin' },
        { state: 'company Admin', abbr: 'companyAdmin' },
        { state: 'Customers', abbr: 'Customer' },
        { state: 'Drivers', abbr: 'Driver' },
      ],*/
      OpenAdd: false,
      search: '',
      snackbar: false,
      timeout: 5000,
      message: 'Success',
      color: 'black',
      y: 'bottom',
      x: 'left',
      dialog: false,
      headers: [
      {
        text: 'Company Name',
        align: 'left',
        value: 'company_name'
      },
      { text: 'Telephone Number', value: 'phone' },
      { text: 'Email', value: 'email' },
      { text: 'Address', value: 'address' },
      { text: 'Actions', value: 'name', sortable: false }
      ],
      Allusers: [],
      editedIndex: -1,
      loader: false,
      Editloader: false,
      editModal: false,
      AllCompanies: [],
      address: '',
      editedItem: {
        company_name: '',
        email: '',
        phone: '',
        address: '',
        admin: '',
      },
      emailRules: [
        v => {
          return !!v || 'E-mail is required'
        },
        v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
      ],
      rules: {
        name: [val => (val || '').length > 0 || 'This field is required']
      },
    }
  },

  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'Edit User' : 'Edit User'
    }
  },

  watch: {
    dialog (val) {
      val || this.close()
    }
  },


  methods: { 
    editItem (item) {
      this.editModal = true
      this.editedIndex = this.AllCompanies.indexOf(item)
      this.editedItem = Object.assign({}, item)
    },
    save () {
      this.Editloader = true
      axios.patch(`/companies/${this.editedItem.id}`, {data: this.$data.editedItem, location: this.address})
      .then((response) => {
        console.log(response);
        // this.AllCompanies.push(this.editedItem)
        Object.assign(this.AllCompanies[this.editedIndex], this.editedItem)
        this.Editloader = false
        // this.close()
        this.color = 'black'
        this.message = 'Branch Updated'
        this.snackbar = true
      })
      .catch((error) => {
        this.errors = error.response.data.errors
        this.Editloader = false
        // this.close()
        this.color = 'red'
        this.message = 'Something went wrong'
        this.snackbar = true
      })
    },
    openAdd() {
      this.OpenAdd = true
    },

      deleteItem (item) {
        const index = this.AllCompanies.indexOf(item)
        confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
      },

      alert() {
        this.message = 'Branch added'
        this.color = 'black'
        this.snackbar = true
      },
      close () {
        this.OpenAdd = this.editModal = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      }, 
      resetForm () {
        this.form = Object.assign({}, this.defaultForm)
        this.$refs.form.reset()
      },

      getAddressData: function (addressData, placeResultData, id) {
        this.address = addressData;
      }
    },
    mounted() {
    this.$refs.address.focus();
    this.loader=true
    axios.post('getCompanyAdmin')
    .then((response) => {
      this.Allusers = response.data
    })
    .catch((error) => {
        this.errors = error.response.data.errors
      })


      axios.post('getCompanies')
      .then((response) => {
        this.AllCompanies = response.data
        this.loader=false
      })
      .catch((error) => {
        this.errors = error.response.data.errors
        this.loader=false
      })
    },
    computed: {
     formIsValid () {
       return (
         this.editedItem.company_name &&
         this.editedItem.email &&
         this.editedItem.phone &&
         this.editedItem.address
         )
    },
 },

 beforeRouteEnter(to, from, next) {
   next(vm => {
    if (vm.role === 'Admin') {
      next(); 
    } else {
      next('/');
    }
  })
 }
  }
  </script>