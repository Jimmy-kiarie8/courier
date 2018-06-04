<template>
  <v-layout row justify-center>
    <v-dialog v-model="openAddRequest" persistent max-width="700px">
      <v-card>
        <v-card-title fixed>
          <span class="headline">Add User</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap v-show="!loader">
              <v-form ref="form" @submit.prevent>
                <v-container grid-list-xl fluid>
                  <v-layout wrap>
                    <v-flex xs12 sm6>
                      <v-text-field
                      v-model="form.name"
                      :rules="rules.name"
                      color="purple darken-2"
                      label="Full name"
                      required
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                      <v-text-field
                      v-model="form.email"
                      :rules="emailRules"
                      color="blue darken-2"
                      label="Email"
                      required
                      ></v-text-field>
                    </v-flex>
                    <v-flex  xs12 sm6>
                      <v-text-field
                        :append-icon="e1 ? 'visibility' : 'visibility_off'"
                        :append-icon-cb="() => (e1 = !e1)"
                        :type="e1 ? 'password' : 'text'"
                        v-model="form.password"
                        name="input-10-2"
                        label="Enter your password"
                        hint="At least 8 characters"
                        min="8"
                        value=""
                        class="input-group--focused"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                      <v-text-field
                      v-model="form.address"
                      :rules="rules.name"
                      color="blue darken-2"
                      label="Address"
                      required
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                      <v-text-field
                      v-model="form.city"
                      :rules="rules.name"
                      color="blue darken-2"
                      label="City"
                      required
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                      <v-text-field
                      v-model="form.country"
                      :rules="rules.name"
                      color="blue darken-2"
                      label="Country"
                      required
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                      <v-text-field
                      v-model="form.phone"
                      :rules="rules.name"
                      color="blue darken-2"
                      label="Phone"
                      required
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                      <v-text-field
                      v-model="form.zipcode"
                      :rules="rules.name"
                      color="blue darken-2"
                      label="Zip Code"
                      required
                      ></v-text-field>
                    </v-flex>

                    <v-flex xs12 sm6>
                      <v-text-field
                      v-model="form.branch"
                      :rules="rules.name"
                      color="blue darken-2"
                      label="Branch"
                      required
                      ></v-text-field>
                    </v-flex>
                    <select class="custom-select custom-select-md col-md-3" v-model="form.role_id">
                      <option value="1">Admin</option>
                      <option value="2">Company Admin</option>
                      <option value="3">Customer</option>
                      <option value="4">Driver</option>
                    </select>
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
       <div v-show="loader" style="text-align: center; width: 100%;">
           <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
       </div>
      </v-container>
    </v-card-text>
  </v-card>
</v-dialog>
</v-layout>
</template>

<script>
export default {
  props: ['openAddRequest'],
  data() {
      const defaultForm = Object.freeze({
        name: '',
        password: '',
        email: '',
        phone: null,
        zipcode: null,
        branch: '',
        address: '',
        city: '',
        country: '',
      })
    return{
      defaultForm,
      loader: false,
      e1: false,
      form: Object.assign({}, defaultForm),
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
  methods: {
    save() {
      axios.post('/users', this.$data.form).
      then((response) => {
        this.loader=false
        console.log(response);
        this.$parent.Allusers.push(response.data) 
        this.close;
        this.resetForm();
        this.$emit('closeRequest');
        this.$emit('alertRequest');

      })
      .catch((error) => {
        this.errors = error.response.data.errors
        this.loader=false
      })
    },
    resetForm () {
        this.form = Object.assign({}, this.defaultForm)
        this.$refs.form.reset()
      },
    close() {
      this.$emit('closeRequest')
    },
  },
  computed: {
   formIsValid () {
     return (
       this.form.name &&
       this.form.email &&
       this.form.phone &&
       this.form.password &&
       this.form.zipcode &&
       this.form.branch &&
       this.form.address &&
       this.form.city &&
       this.form.country
     )
   },
 },
  mounted() {

  }
}
</script>
