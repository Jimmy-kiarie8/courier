<template>
  <div>
    <v-content>
      <div v-show="loader" style="text-align: center; width: 100%;">
        <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
      </div>
      <v-container fluid fill-height v-show="!loader">
        <v-layout justify-center align-center>

          <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
            <v-card>
              <v-toolbar dark color="primary">
                <v-btn icon dark @click.native="dialog = false">
                  <v-icon>close</v-icon>
                </v-btn>
                <v-toolbar-title>Drivers</v-toolbar-title>
                <v-spacer></v-spacer>
              </v-toolbar>
              <v-card-text v-show="!Editloader">
                <v-container grid-list-md>
                  <v-layout>
                    <v-flex xs12 sm12>
                      <v-card>
                        <v-layout row wrap>
                          <v-flex sm4>
                            <v-card-media :src="driverDetails.profile" height="200px">
                            </v-card-media>
                            <v-card-title primary-title>
                              <div class="text-center">
                                <strong>{{ driverDetails.name }}</strong><br>
                                <small>{{ driverDetails.email }}</small><br>
                                <v-btn raised color="primary">Driver</v-btn>
                              </div>
                            </v-card-title>
                          </v-flex>
                          <v-flex sm7 offset-sm1>
                            <v-layout row wrap>
                              <v-flex sm6>
                                <v-text-field
                                v-model="driverDetails.phone"
                                color="blue darken-2"
                                label="Phone"
                                required
                                ></v-text-field>
                              </v-flex>
                              <v-flex sm6>
                                <v-text-field
                                v-model="driverDetails.city"
                                color="blue darken-2"
                                label="City"
                                required
                                ></v-text-field>
                              </v-flex>
                              <v-flex sm6>
                                <v-text-field
                                v-model="driverDetails.country"
                                color="blue darken-2"
                                label="Country"
                                required
                                ></v-text-field>
                              </v-flex>
                              <v-flex sm6>
                                <v-text-field
                                v-model="driverDetails.branch"
                                color="blue darken-2"
                                label="Branch"
                                required
                                ></v-text-field>
                              </v-flex>
                              <v-flex sm6>
                                <v-text-field
                                v-model="driverDetails.created_at"
                                color="blue darken-2"
                                label="Created on"
                                required
                                ></v-text-field>
                              </v-flex>
                            </v-layout>
                          </v-flex>
                        </v-layout>
                      </v-card>
                    </v-flex>
                  </v-layout>
                  <v-divider></v-divider>
                  <v-divider></v-divider>
                  <v-flex xs12 sm10 offset-sm1>
                    <!-- Shipments -->
                    <div v-show="!loader">
                     <v-card-title>
                      <v-spacer></v-spacer>
                      <v-text-field
                      v-model="Shipsearch"
                      append-icon="search"
                      label="Search"
                      single-line
                      hide-details
                      ></v-text-field>
                    </v-card-title>
                    <v-data-table
                    :headers="Shipheaders"
                    :items="AllShipments"
                    :search="search"
                    counter
                    class="elevation-1"
                    >
                    <template slot="items" slot-scope="props">
                     <td>
                       {{ props.item.bar_code }}
                     </td>
                     <td class="text-xs-right"> 
                      <barcode v-bind:value="props.item.bar_code" style="height: 30px;">
                        No barcode
                      </barcode>
                    </td>
                    <td class="text-xs-right">{{ props.item.client_name }}</td>
                    <td class="text-xs-right">{{ props.item.sender_city }}</td>
                    <td class="text-xs-right">{{ props.item.client_city }}</td>
                    <td class="text-xs-right">{{ props.item.booking_date }}</td>
                    <td class="text-xs-right">{{ props.item.status }}</td> 
                    </template>
                    <v-alert slot="no-results" :value="true" color="error" icon="warning">
                      Your search for "{{ Shipsearch }}" found no results.
                    </v-alert>
                    <template slot="pageText" slot-scope="{ pageStart, pageStop }">
                      From {{ pageStart }} to {{ pageStop }}
                    </template>
                    </v-data-table>
                    </div>
                    <!-- Shipments -->
                  </v-flex>
                </v-container>
              </v-card-text>
            </v-card>
          </v-dialog>
          <div>
            <v-card-title>
              Drivers
              <v-spacer></v-spacer>
              <!-- <v-btn>Driver P</v-btn> -->
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
            :items="Alldrivers"
            :search="search"
            class="elevation-1"
            >
            <template slot="items" slot-scope="props">
              <td>{{ props.item.name }}</td>
              <td class="text-xs-right">{{ props.item.email }}</td>
              <td class="text-xs-right">{{ props.item.phone }}</td>
              <td class="text-xs-right">{{ props.item.address }}</td>
              <td class="text-xs-right">{{ props.item.role }}</td>
              <td class="justify-center layout px-0">
                <v-btn icon class="mx-0" @click="editItem(props.item)">
                  <v-icon color="teal" @click="driverDetails">visibility</v-icon>
                </v-btn>
              </td>
            </template>
          </v-data-table>
        </div>
      </v-layout>
    </v-container>
  </v-content>
  <v-snackbar
  :timeout="timeout"
  :color="color"
  bottom
  left
  v-model="snackbar"
  >
  {{ message }}
  <v-btn flat color="white">Close</v-btn>
</v-snackbar>
</div>
</template>

<script>
import VueBarcode from 'vue-barcode';
export default {
  components: {
    'barcode': VueBarcode,
  },
  data () {
    const defaultForm = Object.freeze({
      role: '',
    })
    return{
      search: '',
      Shipsearch: '',
      snackbar: false,
      timeout: 5000,
      message: 'Success',
      color: 'black',
      y: 'bottom',
      x: 'left',
      dialog: false,
      AllShipments: [],
      form: Object.assign({}, defaultForm),
      headers: [
      {
        text: 'User Name',
        align: 'left',
        value: 'name'
      },
      { text: 'Email', value: 'email' },
      { text: 'phone Number', value: 'phone' },
      { text: 'Address', value: 'address' },
      { text: 'Role', value: 'role' },
      { text: 'Actions', value: 'name', sortable: false }
      ],

      Shipheaders: [
      { text: 'Airwaybill', value: 'airway_bill_no' },
      { text: 'Barcode', value: 'bar_code' },
      { text: 'Client', value: 'client_name' },
      { text: 'From', value: 'sender_name' },
      { text: 'To', value: 'client_city' },
      { text: 'Booked on', value: 'booking_date' },
      { text: 'Status', value: 'status' },
      ],
      Alldrivers: [],
      editedIndex: -1,
      loader: false,
      Editloader: false,
      driverDetails: {},
    }
  },


  watch: {
    dialog (val) {
      val || this.close()
    }
  },


  methods: { 
    editItem (item) {
      this.editedIndex = this.Alldrivers.indexOf(item)
      this.driverDetails = Object.assign({}, item)
      this.dialog = true
    },
    save () {
      this.Editloader = true
      axios.patch(`/roles/${this.driverDetails.id}`, this.$data.form)
      .then((response) => {
        this.Editloader = false
        this.close()
        this.snackbar=true
        this.color = 'black'
        this.message = 'Role edited'
      })
      .catch((error) => {
        this.errors = error.response.data.errors
        this.Editloader = false
        this.close()
        this.snackbar=true
        this.color = 'red'
        this.message = 'Something went wrong'
      })
    },
/*
      deleteItem (item) {
        const index = this.desserts.indexOf(item)
        confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
      },*/

      close () {
        this.dialog = false
        setTimeout(() => {
          this.driverDetails = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },
    },
    mounted() {
      this.loader=true

      axios.post('/getShipments')
      .then((response) => {
        this.AllShipments = response.data
      })
      .catch((error) => {
        this.errors = error.response.data.errors
      })

      axios.post('getDrivers')
      .then((response) => {
        this.Alldrivers = response.data
        this.loader=false
      })
      .catch((error) => {
        this.errors = error.response.data.errors
        this.loader=false
      })
    }
  }
  </script>