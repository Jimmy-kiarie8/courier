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
                      v-model="form.role"
                      :rules="rules.name"
                      color="blue darken-2"
                      label="Role name"
                      required
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs12>
                      <v-text-field
                        color="blue"
                        multi-line
                        v-model="form.description"
                      >
                        <div slot="label">
                          Description
                        </div>
                      </v-text-field>
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
      role: '',
      description: '',
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
      axios.post('/roles', this.$data.form).
      then((response) => {
        // console.log(response);
        this.$parent.Allusers.push(response.data) 
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
    close() {
      this.$emit('closeRequest')
    },
  },
  computed: {
   formIsValid () {
     return (
       this.form.role &&
       this.form.description 
       )
   },
 },
 mounted() {

 }
}
</script>
