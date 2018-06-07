<template>
  <v-layout row justify-center>
    <v-dialog v-model="addShipment" fullscreen hide-overlay transition="dialog-bottom-transition">
      <v-card>
        <v-toolbar dark color="primary">
          <v-btn icon dark @click="close">
            <v-icon>close</v-icon>
          </v-btn>
          <v-toolbar-title>Add Shipment</v-toolbar-title>
          <v-spacer></v-spacer>
          <!-- <v-toolbar-items>
            <v-btn dark flat @click="save">Save</v-btn>
          </v-toolbar-items> -->
        </v-toolbar>
        <v-container grid-list-md v-show="!loader">
          <v-layout wrap>
            <v-form ref="form" @submit.prevent="submit">
              <v-container grid-list-xl fluid>
                <v-layout wrap>
                  <v-flex xs4 sm3>
                    <v-text-field
                    v-model="form.client_name"
                    :rules="rules.name"
                    color="blue darken-2"
                    label="Client name"
                    required
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs4 sm3>
                    <v-text-field
                    v-model="form.client_email"
                    :rules="emailRules"
                    color="blue darken-2"
                    label="Client Email"
                    required
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs4 sm3>
                    <v-text-field
                    v-model="form.client_address"
                    :rules="rules.name"
                    color="blue darken-2"
                    label="Client Address"
                    required
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs4 sm3>
                    <v-text-field
                    v-model="form.client_city"
                    :rules="rules.name"
                    color="blue darken-2"
                    label="Client City"
                    required
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs4 sm3>
                    <v-text-field
                    v-model="form.client_phone"
                    color="blue darken-2"
                    label="Client Phone"
                    required
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs4 sm3>
                    <v-text-field
                    v-model="form.assign_staff"
                    :rules="rules.name"
                    color="blue darken-2"
                    label="Assigned Staff"
                    required
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs4 sm3>
                    <v-text-field
                    v-model="form.airway_bill_no"
                    color="blue darken-2"
                    label="Zip Code"
                    required
                    ></v-text-field>
                  </v-flex>
                  <v-divider></v-divider>
                  <v-flex xs4 sm3>
                    <v-text-field
                    v-model="form.shipment_type"
                    :rules="rules.name"
                    color="blue darken-2"
                    label="Shipment Type"
                    required
                    ></v-text-field>
                  </v-flex>

                  <v-spacer></v-spacer>
                  <!-- date picker -->
                  <v-flex xs6 sm3 md3>
                    <v-dialog
                    ref="dialog1"
                    v-model="dmodal1"
                    :return-value.sync="form.booking_date"
                    persistent
                    lazy
                    full-width
                    width="290px"
                    >
                    <v-text-field
                    slot="activator"
                    v-model="form.booking_date"
                    label="Booking Date"
                    prepend-icon="event"
                    readonly
                    ></v-text-field>
                    <v-date-picker v-model="form.booking_date" scrollable>
                      <v-spacer></v-spacer>
                      <v-btn flat color="primary" @click="dmodal1 = false">Cancel</v-btn>
                      <v-btn flat color="primary" @click="$refs.dialog1.save(form.booking_date)">OK</v-btn>
                    </v-date-picker>
                  </v-dialog>
                </v-flex>

                <v-flex xs6 sm3 md3>
                  <v-dialog
                  ref="dialog2"
                  v-model="dmodal2"
                  :return-value.sync="form.derivery_date"
                  persistent
                  lazy
                  full-width
                  width="290px"
                  >
                  <v-text-field
                  slot="activator"
                  v-model="form.derivery_date"
                  label="Derivery Date"
                  prepend-icon="event"
                  readonly
                  ></v-text-field>
                  <v-date-picker v-model="form.derivery_date" scrollable>
                    <v-spacer></v-spacer>
                    <v-btn flat color="primary" @click="dmodal2 = false">Cancel</v-btn>
                    <v-btn flat color="primary" @click="$refs.dialog2.save(form.derivery_date)">OK</v-btn>
                  </v-date-picker>
                </v-dialog>
              </v-flex>
              <!-- date picker -->

              <v-flex xs4 sm3>
                <v-text-field
                v-model="form.derivery_time"
                :rules="rules.name"
                :type="'time'"
                color="blue darken-2"
                label="Derivery Time"
                required
                ></v-text-field>
              </v-flex>
              <select class="custom-select col-md-3" v-model="form.insuarance_status">
                <option value="0" selected="">Insuarance</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
              <select class="custom-select custom-select-sm col-md-3" v-model="form.payment">
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
              <select class="custom-select custom-select-sm col-md-3" v-model="form.customer_id">
                <option v-for="customers in Allcustomer" :value="customers.id">{{customers.name}}</option>
              </select>

              <v-flex xs4 sm3>
                <v-text-field
                v-model="form.bar_code"
                color="blue darken-2"
                label="Barcode"
                required
                ></v-text-field>
              </v-flex>
              <barcode v-bind:value="form.bar_code"></barcode>

              
            </v-layout>
          </v-container>
          <v-card-actions>
            <v-btn flat @click="resetForm">reset</v-btn>
            <v-btn flat @click="close">Close</v-btn>
            <v-spacer></v-spacer>
            <v-btn
            flat
            color="primary"
            @click="save"
            >Add Shipment</v-btn>
          </v-card-actions>
        </v-form>
      </v-layout>
    </v-container>
    <div v-show="loader" style="text-align: center">
        <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
    </div>
  </v-card>
</v-dialog>


</v-layout>
</template>

<script>
import VueBarcode from 'vue-barcode';
export default {
  components: {
    'barcode': VueBarcode
  },
  props: ['addShipment', 'Allcustomer'],
  data () {
    const defaultForm = Object.freeze({
      client_name: '',
      client_phone: '',
      client_email: '',
      client_address: '',
      client_city: '',
      assign_staff: '',
      airway_bill_no: '',
      shipment_type: '',
      payment: '',
      total_freight: '',
      insuarance_status: '',
      booking_date: null,
      derivery_date: null,
      derivery_time: null,
      bar_code: '',
      // products: [],
    })
    return {
      notifications: false,
      list: {},
      loader: false,
      dmodal1: false,
      pdialog2: false,
      dmodal2: false,
      tmodal: false,
      sound: true,
      widgets: false,form: Object.assign({}, defaultForm),

      emailRules: [
      v => {
        return !!v || 'E-mail is required'
      },
      v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
      ],
      rules: {
        name: [val => (val || '').length > 0 || 'This field is required']
      },
      items: [
      { state: 'Yes', abbr: 'yes' },
      { state: 'No', abbr: 'no' },
      ], 
    }
  },
  methods: {
    save() {
      this.loader = true
      axios.post('/shipment', this.$data.form)
      .then((response) => {
        this.loader = false
        // console.log(response);
        this.$parent.AllShipments.push(response.data) 
        // this.$emit('closeRequest');
        this.resetForm;
      })
      .catch((error) => {
        console.log(error);
        this.errors = error.response.data.errors
        this.loader=false
  })
    },
    /*remove(key) {
      this.form.products.splice(key);
    },
    add() {
      axios.post('/shipment', this.$data.form)
      .then((response) => {
        // console.log(this.products_ob); 
        this.form.products.push(this.products_ob) ;
      })
    },*/
    close() {
      this.$emit('closeRequest');
    },
    resetForm () {
      this.form = Object.assign({}, this.defaultForm)
      this.$refs.form.reset()
    },
  },

  computed: {
    formIsValid () {
      return (
        this.form.client_name &&
        this.form.client_phone &&
        this.form.client_email &&
        this.form.client_address &&
        this.form.client_city &&
        this.form.assign_staff &&
        this.form.airway_bill_no &&
        this.form.total_weight &&
        this.form.shipment_type &&
        this.form.payment &&
        this.form.total_freight &&
        this.form.insuarance_status &&
        this.form.booking_date &&
        this.form.derivery_date
        )
    },
  },
  mounted() {
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

