<template>
  <div>
    <v-content>
      <div v-show="loader" style="text-align: center; width: 100%;">
          <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
      </div>
     <v-container fluid fill-height v-show="!loader">
      <v-layout justify-center align-center>
        <v-dialog v-model="dialog" max-width="500px">
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>
            <div v-show="Editloader" style="text-align: center; width: 100%;">
                <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
            </div>
            <v-card-text v-show="!Editloader">
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-form ref="form" @submit.prevent="submit">
                    <v-container grid-list-xl fluid>
                      <v-layout wrap>

                        <select class="custom-select custom-select-sm col-md-3" v-model="form.role">
                          <option value="" selected=""></option>
                          <option value="1">Admin</option>
                          <option value="2">Driver</option>
                          <option value="3">Customer</option>
                        </select>
                      </v-layout>
                    </v-container>
                  </v-form>
                </v-layout>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
              <v-btn color="blue darken-1" flat @click.native="save">Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-data-table
        :headers="headers"
        :items="Allusers"
        hide-actions
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
              <v-icon color="teal">edit</v-icon>
            </v-btn>
          </td>
        </template>
      </v-data-table>
    </v-layout>
  </v-container>
</v-content>
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
export default {
  data () {
    const defaultForm = Object.freeze({
      role: '',
    })
    return{
      snackbar: false,
      timeout: 5000,
      message: 'Success',
      color: 'black',
      y: 'bottom',
      x: 'left',
      dialog: false,
      form: Object.assign({}, defaultForm),
      headers: [
      {
        text: 'User Name (100g serving)',
        align: 'left',
        sortable: false,
        value: 'name'
      },
      { text: 'Email', value: 'email' },
      { text: 'phone Number', value: 'phone' },
      { text: 'Address', value: 'address' },
      { text: 'Role', value: 'role' },
      { text: 'Actions', value: 'name', sortable: false }
      ],
      desserts: [],
      Allusers: [],
      editedIndex: -1,
      loader: false,
      Editloader: false,
      editedItem: {
        name: '',
        email: '',
        phone: null,
        zipcode: null,
        branch: '',
        address: '',
        city: '',
        country: '',
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
      this.editedIndex = this.Allusers.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },
    save () {
      this.Editloader = true
      axios.patch(`/roles/${this.editedItem.id}`, this.$data.form)
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
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },
    },
    mounted() {
      this.loader=true
      axios.post('getUsersRole')
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