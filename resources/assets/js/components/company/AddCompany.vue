<template>
  <v-layout row justify-center>
    <v-dialog v-model="openAddRequest" persistent max-width="700px">
      <v-card>
        <v-card-title fixed>
          <span class="headline">Add Company</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-form ref="form" @submit.prevent="submit">
                <v-container grid-list-xl fluid>
                  <v-layout wrap>
                    <v-flex xs12 sm6>
                      <v-text-field
                      v-model="form.company_name"
                      :rules="rules.name"
                      color="blue darken-2"
                      label="Company name"
                      required
                      ></v-text-field>
                      <small class="has-text-danger" v-if="errors.company_name">{{ errors.company_name[0] }}</small>
                    </v-flex>
                    <v-flex xs12 sm6>
                      <v-text-field
                      v-model="form.address"
                      :rules="rules.name"
                      color="blue darken-2"
                      label="Company Address"
                      required
                      ></v-text-field>
                      <small class="has-text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                    </v-flex>
                    <v-flex xs12 sm6>
                      <v-text-field
                      v-model="form.phone"
                      :rules="rules.name"
                      color="blue darken-2"
                      label="Telephone Number"
                      required
                      ></v-text-field>
                      <small class="has-text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                    </v-flex>
                    <v-flex xs12 sm6>
                      <v-text-field
                      v-model="form.email"
                      :rules="rules.name"
                      color="blue darken-2"
                      label="Company Email"
                      required
                      ></v-text-field>
                      <small class="has-text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
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
                          :items="compAdmin"
                          v-model="form.admin"
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
  </v-layout>
</template>

<script>
import VueGoogleAutocomplete from 'vue-google-autocomplete'
export default {
  props: ['openAddRequest', 'compAdmin'],
  components: {
    VueGoogleAutocomplete
  },
  data() {
    const defaultForm = Object.freeze({
      company_name: '',
      email: '',
      phone: '',
      address: '',
      admin: '',
    })
    return{
      defaultForm,
      e1: false,
      address: '',
      errors: {},
      form: Object.assign({}, defaultForm),
      rules: {
        name: [val => (val || '').length > 0 || 'This field is required']
      },
    }
  },
  methods: {
    save() {
      axios.post('/companies', {data: this.$data.form, location: this.address}).
      then((response) => {
        console.log(response);
        // this.$parent.AllCompanies.push(response.data) 
        // this.close;
        // this.resetForm();
        // this.$emit('closeRequest');
        this.$emit('alertRequest');

      })
      .catch((error) => this.errors = error.response.data.errors)
    },
    resetForm () {
      this.form = Object.assign({}, this.defaultForm)
      this.$refs.form.reset()
    },
    alert() {
      this.$emit('alertRequest')
    },
    close() {
      this.$emit('closeRequest')
    },

    getAddressData: function (addressData, placeResultData, id) {
      this.address = addressData;
    }
  },
  computed: {
   formIsValid () {
     return (
       this.form.company_name &&
       this.form.email &&
       this.form.phone &&
       this.form.address
       )
   },
 },
 mounted() {
  this.$refs.address.focus();
}
}
</script>
