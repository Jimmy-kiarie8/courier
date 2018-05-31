<template>
  <v-layout row justify-center>
    <v-dialog v-model="openAddRequest" persistent max-width="700px">
      <v-card>
        <v-card-title fixed>
          <span class="headline">Add Role</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-form ref="form" @submit.prevent="submit">
                <v-container grid-list-xl fluid>
                  <v-layout wrap>
                    <v-flex xs12 sm6>
                      <v-text-field
                      v-model="form.branch_name"
                      :rules="rules.name"
                      color="blue darken-2"
                      label="Branch name"
                      required
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                      <v-text-field
                      v-model="form.address"
                      :rules="rules.name"
                      color="blue darken-2"
                      label="Branch Address"
                      required
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                      <v-text-field
                      v-model="form.phone"
                      :rules="rules.name"
                      color="blue darken-2"
                      label="Telephone Number"
                      required
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                      <v-text-field
                      v-model="form.email"
                      :rules="rules.name"
                      color="blue darken-2"
                      label="Branch Email"
                      required
                      ></v-text-field>
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
  </v-layout>
</template>

<script>
export default {
  props: ['openAddRequest'],
  data() {
    const defaultForm = Object.freeze({
      branch_name: '',
      email: '',
      phone: '',
      address: '',
    })
    return{
      defaultForm,
      e1: false,
      form: Object.assign({}, defaultForm),
      rules: {
        name: [val => (val || '').length > 0 || 'This field is required']
      },
    }
  },
  methods: {
    save() {
      axios.post('/branches', this.$data.form).
      then((response) => {
        console.log(response);
        this.$parent.AllBranches.push(response.data) 
        this.close;
        this.resetForm();
        this.$emit('closeRequest');
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
  },
  computed: {
   formIsValid () {
     return (
       this.form.branch_name &&
       this.form.email &&
       this.form.phone &&
       this.form.address
       )
   },
 },
 mounted() {

 }
}
</script>
