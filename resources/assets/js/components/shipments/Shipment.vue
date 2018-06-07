<template>
 <div>
   <v-content>
    <v-container fluid fill-height>
     <!-- <v-layout justify-center align-center> -->
      <!-- Show details -->
      <v-layout row justify-center>
        <v-dialog v-model="showdialog1" fullscreen hide-overlay transition="dialog-bottom-transition">
          <v-card id="shipment_det">
            <v-card-title>
              <v-toolbar dark color="white">
                <v-btn icon dark @click.native="showdialog1 = false">
                  <v-icon color="black">close</v-icon>
                </v-btn>
                <v-spacer></v-spacer>
              </v-toolbar>
              <span class="headline"></span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md text-xs-center>
                <v-layout row wrap>
                  <!-- COURIER SCRIPTS PVT LTD. -->
                  <v-flex xs7 sm7>
                    <v-card>
                      <v-card-title primary-title>
                        <h3 class="headline mb-0">COURIER SCRIPTS PVT LTD.</h3>
                      </v-card-title>
                      <v-card-actions>
                        <v-list two-line>
                          <v-list-tile>
                            <v-list-tile-action>
                              <v-icon color="indigo">account_circle</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                              <v-list-tile-title>{{ showItem.sender_city }}</v-list-tile-title>
                            </v-list-tile-content>
                          </v-list-tile>
                          <v-list-tile>
                            <v-list-tile-action>
                              <v-icon color="indigo">phone</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                              <v-list-tile-title>{{ showItem.sender_phone }}</v-list-tile-title>
                            </v-list-tile-content>
                          </v-list-tile>

                          <v-list-tile>
                            <v-list-tile-action>
                              <v-icon color="indigo">mail</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                              <v-list-tile-title>{{ showItem.sender_email }}</v-list-tile-title>
                            </v-list-tile-content>
                          </v-list-tile>
                        </v-list>
                      </v-card-actions>
                    </v-card>
                  </v-flex>
                  <!-- COURIER SCRIPTS PVT LTD. -->
                  <v-spacer></v-spacer>

                  <!-- TRACKING NO -->
                  <v-flex xs4 sm4>
                    <v-card>
                      <v-card-title primary-title>
                        <v-list-tile
                        <v-list-tile-content>
                          <v-list-tile-title style="height: 130px;">
                            <barcode v-bind:value="showItem.bar_code">
                              Show this if the rendering fails.
                            </barcode>
                          </v-list-tile-title>
                        </v-list-tile-content>
                      </v-list-tile>
                      <v-list-tile>
                        <v-list-tile-content>
                          <v-list-tile-title>
                            TRACKING NO:{{ showItem.bar_code }}
                          </v-list-tile-title>
                        </v-list-tile-content>
                      </v-list-tile>
                    </v-card-title>
                    <v-card-actions>
                      <v-list-tile @click="">
                        <v-list-tile-content>
                          <v-list-tile-title>Date</v-list-tile-title>
                          <v-list-tile-sub-title>{{showItem.booking_date}}</v-list-tile-sub-title>
                        </v-list-tile-content>
                        <v-list-tile-content>
                          <v-list-tile-title>From</v-list-tile-title>
                          <v-list-tile-sub-title>{{showItem.sender_name}}</v-list-tile-sub-title>
                        </v-list-tile-content>
                        <v-list-tile-content>
                          <v-list-tile-title>To</v-list-tile-title>
                          <v-list-tile-sub-title>{{showItem.client_name}}</v-list-tile-sub-title>
                        </v-list-tile-content>
                      </v-list-tile>              
                    </v-card-actions>
                  </v-card>
                </v-flex>
                <!-- TRACKING NO -->
              </v-layout>
              <v-divider></v-divider>

              <!-- Sender Receiver and Shipment Details  -->
              <v-layout row wrap>
                <!-- sender details -->
                <v-flex xs4 sm4>
                  <v-card>
                    <v-card-title primary-title>
                      <h3 class="headline mb-0">Sender Details :</h3>
                    </v-card-title>
                    <v-card-actions>
                      <v-list two-line>
                        <v-list-tile>
                          <v-list-tile-action>
                            <v-icon color="indigo">account_circle</v-icon>
                          </v-list-tile-action>
                          <v-list-tile-content>
                            <v-list-tile-title>{{ showItem.sender_name }}</v-list-tile-title>
                          </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile>
                          <v-list-tile-action>
                            <v-icon color="indigo">phone</v-icon>
                          </v-list-tile-action>
                          <v-list-tile-content>
                            <v-list-tile-title>{{ showItem.sender_phone }}</v-list-tile-title>
                          </v-list-tile-content>
                        </v-list-tile>

                        <v-list-tile>
                          <v-list-tile-action>
                            <v-icon color="indigo">mail</v-icon>
                          </v-list-tile-action>
                          <v-list-tile-content>
                            <v-list-tile-title>{{ showItem.sender_email }}</v-list-tile-title>
                          </v-list-tile-content>
                        </v-list-tile>
                      </v-list>
                    </v-card-actions>
                  </v-card>
                </v-flex>
                <!-- sender details -->

                <!-- Receiver details -->
                <v-flex xs4 sm4>
                  <v-card>
                    <v-card-title primary-title>
                      <h3 class="headline mb-0">Client Details :</h3>
                    </v-card-title>
                    <v-card-actions>
                      <v-list two-line>
                        <v-list-tile>
                          <v-list-tile-action>
                            <v-icon color="indigo">account_circle</v-icon>
                          </v-list-tile-action>
                          <v-list-tile-content>
                            <v-list-tile-title>{{ showItem.client_name }}</v-list-tile-title>
                          </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile>
                          <v-list-tile-action>
                            <v-icon color="indigo">phone</v-icon>
                          </v-list-tile-action>
                          <v-list-tile-content>
                            <v-list-tile-title>{{ showItem.client_phone }}</v-list-tile-title>
                          </v-list-tile-content>
                        </v-list-tile>

                        <v-list-tile>
                          <v-list-tile-action>
                            <v-icon color="indigo">mail</v-icon>
                          </v-list-tile-action>
                          <v-list-tile-content>
                            <v-list-tile-title>{{ showItem.client_email }}</v-list-tile-title>
                          </v-list-tile-content>
                        </v-list-tile>
                      </v-list>
                    </v-card-actions>
                  </v-card>
                </v-flex>
                <!-- Receiver details -->
                <!-- Shipment details -->
                <v-flex xs4 sm4>
                  <v-card>
                    <v-card-title primary-title>
                      <h3 class="headline mb-0">Shipment Details :</h3>
                    </v-card-title>
                    <v-card-actions>
                      <v-list two-line>
                        <v-list-tile>
                          <v-list-tile-action>
                            <v-icon color="indigo">account_circle</v-icon>
                          </v-list-tile-action>
                          <v-list-tile-content>
                            <v-list-tile-title>{{ showItem.airway_bill_no }}</v-list-tile-title>
                          </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile>
                          <v-list-tile-action>
                            <v-icon color="indigo">phone</v-icon>
                          </v-list-tile-action>
                          <v-list-tile-content>
                            <v-list-tile-title>{{ showItem.derivery_date }}</v-list-tile-title>
                          </v-list-tile-content>
                        </v-list-tile>

                        <v-list-tile>
                          <v-list-tile-action>
                            <v-icon color="indigo">Isured</v-icon>
                          </v-list-tile-action>
                          <v-list-tile-content>
                            <v-list-tile-title>{{ showItem.insuarance_status }}</v-list-tile-title>
                          </v-list-tile-content>
                        </v-list-tile>
                      </v-list>
                    </v-card-actions>
                  </v-card>
                </v-flex>
                <!-- Receiver details -->
              </v-layout>
              <v-divider></v-divider>
              <!-- Sender Receiver and Shipment Details  -->
              <table class="table table-striped table-hover" >
                <thead>
                  <th>Product Name</th>
                  <th>Weight </th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                </thead>
                <tbody>
                  <tr v-for="pros, key in newProducts" :key="pros.id" v-if="pros.shipments_id === showItem.id">
                    <td>{{ pros.product_name }}</td>
                    <td>{{ pros.weight }}</td>
                    <td>{{ pros.price }}</td>
                    <td>{{ pros.quantity }}</td>
                    <td>{{ pros.price * pros.quantity }}</td>
                  </tr>
                </tbody>
              </table>

            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn  v-print color="black darken-1" flat="flat">Print</v-btn>
            <!-- <button  v-print>Print the entire page</button> -->
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-layout>
    <!-- Show details -->

    <!-- Products -->
    <v-dialog v-model="pdialog2" max-width="500px">
     <v-card>
       <v-card-title>
         Products
       </v-card-title>
       <v-card-text>
         <v-form ref="form" @submit.prevent="submit">
           <v-container grid-list-xl fluid>
             <v-layout wrap>
               <v-flex xs12 sm6>
                 <v-text-field
                 v-model="form.product_name"
                 :rules="rules.name"
                 color="blue darken-2"
                 label="Product Name"
                 required
                 ></v-text-field>
               </v-flex>
               <v-flex xs12 sm6>
                 <v-text-field
                 v-model="form.weight"
                 :rules="rules.name"
                 color="blue darken-2"
                 label="Weight"
                 required
                 ></v-text-field>
               </v-flex>
               <v-flex xs12 sm6>
                 <v-text-field
                 v-model="form.quantity"
                 color="blue darken-2"
                 label="Quantity"
                 required
                 ></v-text-field>
               </v-flex>
               <v-flex xs12 sm6>
                 <v-text-field
                 v-model="form.price"
                 color="blue darken-2"
                 label="Each Cost"
                 required
                 ></v-text-field>
               </v-flex>
               <v-btn @click="getTotal" raised>Get Total</v-btn>
               <v-flex xs12 sm6>
                 <v-text-field
                 v-show="gettotlaAmount"
                 v-model="form.total"
                 color="blue darken-2"
                 label="Total Cost"
                 required
                 ></v-text-field>
               </v-flex>
               <!-- <input type="text" v-model="form.id" :value="updateitedItem.id"> -->
             </v-layout>
           </v-container>
         </v-form>
       </v-card-text>
       <v-card-actions>
         <v-btn color="primary" flat @click.stop="pdialog2=false">Close</v-btn>
         <v-spacer></v-spacer>
         <v-btn color="primary" flat @click="addProduct">Add</v-btn>
       </v-card-actions>
     </v-card>
   </v-dialog>
   <!-- Products -->



   <!-- Update Modal -->
   <v-dialog v-model="updateModal" fullscreen hide-overlay transition="dialog-bottom-transition">
    <v-card>
      <v-toolbar dark color="primary">
        <v-btn icon dark @click.native="updateModal = false">
          <v-icon>close</v-icon>
        </v-btn>
        <v-toolbar-title>Edit Shipment</v-toolbar-title>
        <v-spacer></v-spacer>
      </v-toolbar>
      <v-container grid-list-md>
        <v-layout row wrap>
          <v-flex xs8>
            <v-container fill-height>
              <v-layout align-center>
                <v-flex>
                  <!-- <GmapMap
                  :center="{lat:-1.2808685, lng:36.73657560000004}"
                  :zoom="7"
                  map-type-id="terrain"
                  style="width: 700px; height: 400px"
                  >
                  <GmapMarker
                  :position="markers.position"
                  :clickable="true"
                  :draggable="true"
                  @click="center=markers.position"
                  />
                </GmapMap> -->
              </v-flex>
            </v-layout>
          </v-container>
        </v-flex>
        <v-flex xs4>
          <v-card>
              <!-- <v-flex xs12 sm12>
                <v-text-field
                v-model="updateitedItem.client_city"
                :rules="rules.name"
                color="blue darken-2"
                label="Current City"
                required
                ></v-text-field>
              </v-flex> -->
              <vue-google-autocomplete
              ref="address"
              id="map"
              classname="form-control"
              placeholder="Please type your address"
              v-on:placechanged="getAddressData"
              country="ke"
              ></vue-google-autocomplete>
              <!-- <select class="custom-select custom-select-sm col-md-12" v-model="updateitedItem.status">
                <option value="waiting_pproval">Awaiting Approval</option>
                <option value="approved">Approved</option>
              </select> -->


              <select class="custom-select custom-select-sm col-md-12" v-model="updateitedItem.status">
                <option value="Awaiting Approval">Awaiting Approval</option>
                <option value="Approved">Approved</option>
                <option value="Cancelled">Cancelled</option>
                <option value="Shipment Collected">Shipment Collected</option>
                <option value="Waiting for Scan">Waiting for scan</option>
                <option value="Ready For Depart">Ready For Depart</option>
                <option value="Despatched">Despatched</option>
                <option value="Arrived">Arrived</option>
                <option value="Cleared">Cleared</option>
                <option value="Transit">Transit</option>
                <option value="Out For Destination">Out For Destination</option>
                <option value="Out For Delivery">Out For Delivery</option>
                <option value="Delivered">Delivered</option>
                <option value="Returned">Returned</option>
                <option value="Hold">Hold</option>
              </select>




              <v-flex xs12 sm12>
                <v-text-field
                v-model="updateitedItem.remark"
                color="blue"
                multi-line
                >
                <div slot="label">
                  Remark <small>(optional)</small>
                </div>
              </v-text-field>
            </v-flex>
            <v-btn color="primary" flat @click="UpdateStatus">Update Status</v-btn>
          </v-card>
        </v-flex>
      </v-layout>

      <v-divider></v-divider>
      <v-divider></v-divider>

      <!-- Add Products -->
      <v-jumbotron color="grey lighten-2">
        <v-layout align-center>
          <v-flex>
            <h2 class="text-center">Products</h2>
            <v-btn color="primary" flat @click="openProduct(updateitedItem)">Add Product</v-btn>
            <table class="table table-hove table-striped table-responsive">
              <thead>
                <th>Product Name</th>
                <th>Weight</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
              </thead>
              <tbody>
                <tr v-for="products, key in AllProducts" :key="products.id" v-if="products.shipments_id === updateitedItem.id">
                  <td>{{ products.product_name }}</td>
                  <td>{{ products.weight }}</td>
                  <td>{{ products.price }}</td>
                  <td>{{ products.quantity }}</td>
                  <td>{{ products.total }}</td>
                  <td>#</td>
                </tr>
              </tbody>
            </table>
          </v-flex>
        </v-layout>
      </v-jumbotron>
      <!-- Add Products -->
    </v-container>
    <v-divider></v-divider>
  </v-card>
</v-dialog>
<!-- Update Modal -->


<!-- Data table -->
<div style="width: 100%;">
  <v-dialog v-model="dialog1" fullscreen hide-overlay transition="dialog-bottom-transition">
    <v-card>
      <v-toolbar dark color="primary">
        <v-btn icon dark @click.native="dialog1 = false">
          <v-icon>close</v-icon>
        </v-btn>
        <v-toolbar-title>Edit Shipment</v-toolbar-title>
        <v-spacer></v-spacer>
      </v-toolbar>
      <v-container grid-list-md>
        <v-layout wrap>
          <v-form ref="form" @submit.prevent="submit">
            <v-container grid-list-xl fluid>
              <v-layout wrap>
                <v-flex xs4 sm3>
                  <v-text-field
                  v-model="editedItem.client_name"
                  :rules="rules.name"
                  color="blue darken-2"
                  label="Client name"
                  required
                  ></v-text-field>
                </v-flex>
                <v-flex xs4 sm3>
                  <v-text-field
                  v-model="editedItem.client_email"
                  :rules="emailRules"
                  color="blue darken-2"
                  label="Client Email"
                  required
                  ></v-text-field>
                </v-flex>
                <v-flex xs4 sm3>
                  <v-text-field
                  v-model="editedItem.client_address"
                  :rules="rules.name"
                  color="blue darken-2"
                  label="Client Address"
                  required
                  ></v-text-field>
                </v-flex>
                <v-flex xs4 sm3>
                  <v-text-field
                  v-model="editedItem.client_city"
                  :rules="rules.name"
                  color="blue darken-2"
                  label="Client City"
                  required
                  ></v-text-field>
                </v-flex>
                <v-flex xs4 sm3>
                  <v-text-field
                  v-model="editedItem.client_phone"
                  color="blue darken-2"
                  label="Client Phone"
                  required
                  ></v-text-field>
                </v-flex>
                <v-flex xs4 sm3>
                  <v-text-field
                  v-model="editedItem.assign_staff"
                  :rules="rules.name"
                  color="blue darken-2"
                  label="Assigned Staff"
                  required
                  ></v-text-field>
                </v-flex>
                <v-flex xs4 sm3>
                  <v-text-field
                  v-model="editedItem.airway_bill_no"
                  :rules="rules.name"
                  color="blue darken-2"
                  label="Zip Code"
                  required
                  ></v-text-field>
                </v-flex>
                <v-divider></v-divider>
                <v-flex xs4 sm3>
                  <v-text-field
                  v-model="editedItem.shipment_type"
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
                  :return-value.sync="editedItem.booking_date"
                  persistent
                  lazy
                  full-width
                  width="290px"
                  >
                  <v-text-field
                  slot="activator"
                  v-model="editedItem.booking_date"
                  label="Booking Date"
                  prepend-icon="event"
                  readonly
                  ></v-text-field>
                  <v-date-picker v-model="editedItem.booking_date" scrollable>
                    <v-spacer></v-spacer>
                    <v-btn flat color="primary" @click="dmodal1 = false">Cancel</v-btn>
                    <v-btn flat color="primary" @click="$refs.dialog1.save(editedItem.booking_date)">OK</v-btn>
                  </v-date-picker>
                </v-dialog>
              </v-flex>

              <v-flex xs6 sm3 md3>
                <v-dialog
                ref="dialog2"
                v-model="dmodal2"
                :return-value.sync="editedItem.derivery_date"
                persistent
                lazy
                full-width
                width="290px"
                >
                <v-text-field
                slot="activator"
                v-model="editedItem.derivery_date"
                label="Derivery Date"
                prepend-icon="event"
                readonly
                ></v-text-field>
                <v-date-picker v-model="editedItem.derivery_date" scrollable>
                  <v-spacer></v-spacer>
                  <v-btn flat color="primary" @click="dmodal2 = false">Cancel</v-btn>
                  <v-btn flat color="primary" @click="$refs.dialog2.save(editedItem.derivery_date)">OK</v-btn>
                </v-date-picker>
              </v-dialog>
            </v-flex>
            <!-- date picker -->

            <v-flex xs4 sm3>
              <v-text-field
              v-model="editedItem.derivery_time"
              :rules="rules.name"
              :type="'time'"
              color="blue darken-2"
              label="Derivery Time"
              required
              ></v-text-field>
            </v-flex>
            <v-divider></v-divider>
            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Insuarance</label>
                <div class="col-md-6">
                  <select class="custom-select col-md-12" v-model="editedItem.insuarance_status">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                  </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Paid</label>
                <div class="col-md-6">
                  <select class="custom-select custom-select-sm col-md-12" v-model="editedItem.payment">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                  </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Customer</label>
                <div class="col-md-6">
                  <select class="custom-select custom-select-sm col-md-12" v-model="form.customer_id">
                    <option v-for="customers in Allcustomers" :value="customers.id">{{customers.name}}</option>
                  </select>
                </div>
            </div>
            <v-flex xs4 sm3>
              <v-text-field
              v-model="editedItem.bar_code"
              :rules="rules.name"
              color="blue darken-2"
              label="Barcode"
              required
              ></v-text-field>
            </v-flex>
            <barcode v-bind:value="editedItem.bar_code">
              Show this if the rendering fails.
            </barcode>

          </v-layout>
        </v-container>
        <v-card-actions>
          <!-- <v-btn flat @click="resetForm">reset</v-btn> -->
          <v-btn flat @click="close">Close</v-btn>
          <v-spacer></v-spacer>
          <v-btn
          flat
          color="primary"
          @click="update"
          >Add Shipment</v-btn>
        </v-card-actions>
      </v-form>
    </v-layout>
  </v-container>
  <v-divider></v-divider>
</v-card>
</v-dialog>
<!-- Shipment Edit -->
<div v-show="loader" style="text-align: center">
 <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
</div> 
<div v-show="!loader">
 <v-card-title>
  <v-btn color="primary" flat @click="openShipment">Add Shipment</v-btn>
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
<td class="justify-center layout px-0">
 <v-btn icon class="mx-0" @click="editItem(props.item)">
   <v-icon color="blue darken-2">edit</v-icon>
 </v-btn>
 <v-btn icon class="mx-0" @click="UpdateItem(props.item)">
   <v-icon color="blue darken-2" dark>save</v-icon>
 </v-btn>
 <v-btn icon class="mx-0" @click="deleteItem(props.item)">
   <v-icon color="pink darken-2">delete</v-icon>
 </v-btn>
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
</div>
<!-- Data table -->
</v-layout>
</v-container>
</v-content>
<AddShipment :addShipment="dialog" @closeRequest="close" :Allcustomer="Allcustomers"></AddShipment>
<EditShipment :EditShipment="dialog1" @closeRequest="close"></EditShipment>
<!-- <UpdateShipment :UpdateShipment="dialog1" @closeRequest="close"></UpdateShipment> -->
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
import VueBarcode from 'vue-barcode';
let AddShipment = require('./AddShipment')
let EditShipment = require('./EditShipment')
// let UpdateShipment = require('./UpdateShipment')
import VueGoogleAutocomplete from 'vue-google-autocomplete'
export default {
  props: ['user', 'role'],
  components: {
    AddShipment, EditShipment, 'barcode': VueBarcode, VueGoogleAutocomplete
      // , UpdateShipment
    },
    data () {
      const defaultForm = Object.freeze({
       total: null,
       price: null,
       quantity: null,
       weight: null,
       quantity: null,
       product_name: '',
       shipments_id: null,
       customer_id: null,
     })
      return {
        /*select: { state: 'All', abbr: 'All' },
        items: [
          { state: 'All', abbr: 'All' },
          { state: 'Awaiting Approval', abbr: 'Awaiting Approval' },
          { state: 'Approved', abbr: 'approved' },
          { state: 'Cancelled', abbr: 'Cancelled' },
          { state: 'Collected', abbr: 'Customer' },
          { state: 'Arrived', abbr: 'Arrived' },
          { state: 'Cleared', abbr: 'Cleared' },
          { state: 'Returned', abbr: 'Returned' },
          { state: 'Hold', abbr: 'Hold' },
          { state: 'Ready', abbr: 'Ready' },
          { state: 'Transit', abbr: 'Transit' },
          { state: 'Despatched', abbr: 'Despatched' },
        ],*/
        markers: {
          position: {}
        },
        address: '',
        snackbar: false,
        timeout: 5000,
        message: 'Success',
        color: 'black',
        y: 'bottom',
        x: 'left',
        loader: false,
        barcodeValue: 'test',
        notifications: false,
        dmodal1: false,
        dmodal2: false,
        tmodal: false,
        updateModal: false,
        showdialog1: false,
        sound: true,
        AllShipments: [],
        search: '',
        temp: '',
        dialog: false,
        dialog1: false,
        pdialog2: false,
        widgets: false,form: Object.assign({}, defaultForm),
        rules: {
          name: [val => (val || '').length > 0 || 'This field is required']
        },
        updateitedItem: {},
        AllProducts: {},
        newProducts: {},
        coordinatesArr: [],
        showItem: {
          client_name: '',
          client_phone: '',
          client_email: '',
          client_address: '',
          client_city: '',
          sender_name: '',
          sender_phone: '',
          sender_email: '',
          sender_address: '',
          sender_city: '',
          assign_staff: '',
          airway_bill_no: '',
          shipment_type: '',
          payment: '',
          total_freight: '',
          insuarance_status: '',
          remark: '',
          status: '',
          booking_date: null,
          derivery_date: null,
          derivery_time: null,
        },
        editedItem: {
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
          remark: '',
          status: '',
          booking_date: null,
          derivery_date: null,
          derivery_time: null,
        },
        headers: [
        { text: 'Airwaybill', value: 'airway_bill_no' },
        { text: 'Barcode', value: 'bar_code' },
        { text: 'Client', value: 'client_name' },
        { text: 'From', value: 'sender_name' },
        { text: 'To', value: 'client_city' },
        { text: 'Booked on', value: 'booking_date' },
        { text: 'Status', value: 'status' },
        ],
        emailRules: [
        v => {
          return !!v || 'E-mail is required'
        },
        v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
        ],
        rules: {
          name: [val => (val || '').length > 0 || 'This field is required']
        },
        direction: 'left',
        fab: false,
        fling: false,
        hover: false,
        tabs: null,
        bottom: true,
        left: true,
        Allcustomers: {},
        gettotlaAmount: false,
        transition: 'slide-y-reverse-transition'
      }
    },
    methods: {
    resetForm () {
      this.form = Object.assign({}, this.defaultForm)
      this.$refs.form.reset()
    },
     openShipment() {
      this.dialog = true
    },
    addProduct() {
    // alert(this.updateitedItem.id);
    axios.post(`/productAdd/${this.updateitedItem.id}`, this.$data.form)
    .then((response) => {
     // console.log(response.data); 

      this.message = 'Product Added'           
      this.color = 'black'           
      this.snackbar = true  
     this.resetForm()
     this.AllProducts.push(response.data) 
     this.pdialog2 = false
   })
  },
  editShipment(key) {
      // alert(key);
      this.$children[2].list = this.AllShipments[key]
      this.dialog1 = true
    },
   /*del(key, id) {

   },*/
   /*close() {
      this.dialog = this.dialog1 = false
    },*/
    openProduct(updateitedItem) {
      // this.ProductItem = Object.assign({}, item)
      // this.updatedIndex = this.AllShipments.indexOf(item)
      // alert(updateitedItem.id);
      // console.log(updateitedItem);
      this.pdialog2 = true
    },
    UpdateStatus() {
      // alert(this.updateitedItem.id);      
      axios.post(`/updateStatus/${this.updateitedItem.id}`, {formobg: this.$data.updateitedItem, address: this.$data.address})
      .then((response) => {
        this.resetForm()
        // console.log(response); 
        this.message = 'Updated'           
        this.color = 'black'           
        this.snackbar = true           
        this.markers.push(response.data)
      })
    },
    initialize () {
      this.AllShipments
    },

    UpdateItem (item) {
      axios.post(`/getcoordinatesArray/${item.id}`)
      .then((response) => this.markers.position = response.data)
      .catch((error) => this.errors = error.response.data.errors)
      // console.log(this.coordinatesArr);
     this.resetForm()

      
      this.updateitedItem = Object.assign({}, item)
      this.updatedIndex = this.AllShipments.indexOf(item)
        // console.log(this.updateitedItem);
        this.updateModal = true
      },
      editItem (item) {
        this.editedItem = Object.assign({}, item)
        this.editedIndex = this.AllShipments.indexOf(item)
        // console.log(this.editedItem);
        this.dialog1 = true
      },

      showDetails (item) {
        this.showItem = Object.assign({}, item)
        // alert(this.AllProducts);
        this.editedIndex = this.AllShipments.indexOf(item)
        this.showdialog1 = true
        axios.post('/getProducts')
        .then((response) => this.newProducts = response.data)
        .catch((error) => this.errors = error.response.data.errors)
        // console.log(this.newProducts);
      },

      update() {
         // alert(this.editedItem.id);
         axios.patch(`/shipment/${this.editedItem.id}`, this.$data.editedItem)
         .then((response) => {

            this.message = 'Updated'           
            this.color = 'black'           
            this.snackbar = true  
            this.close()
            // console.log(response);            
          // this.$emit('alertRequest')
              // this.$parent.manage.push(response.data)
            })
         .catch((error) => this.errors = error.response.data.errors)
       },

       deleteItem (item) {
        const index = this.AllShipments.indexOf(item)
        if (confirm('Are you sure you want to delete this item?')) {
         axios.delete(`/shipment/${item.id}`)
         .then((response) => {          
            this.message = 'Deleted'           
            this.color = 'black'           
            this.snackbar = true  
             this.AllShipments.splice(index, 1)
             // console.log(response);
           })
         .catch((error) => this.errors = error.response.data.errors)
       }
     },

     close () {
      this.dialog1 = this.dialog = this.pdialog2 = false
      setTimeout(() => {
        this.editedItem = this.UpdateItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      }, 300)
    },
    getAddressData: function (addressData, placeResultData, id) {
      this.address = addressData;
    },
    getTotal() {
      this.gettotlaAmount = true
      if (this.form.quantity && this.form.price) {
        this.form.total = this.form.quantity * this.form.price
      }else{
        this.form.total = 0
      }
    }
    },
    mounted() {

      this.$refs.address.focus();
      this.loader=true
      axios.post('/getShipments')
      .then((response) => {
        this.AllShipments = response.data
        this.loader=false
      })
      .catch((error) => {
        this.errors = error.response.data.errors
        this.loader=false
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

      this.loader=true
      axios.post('/getProducts')
      .then((response) => {
        this.AllProducts = response.data
        this.loader=false
      })
      .catch((error) => {
        console.log(error);
        this.errors = error.response.data.errors
        this.loader=false
      })
    },
    computed: {
     activeFab () {
      switch (this.tabs) {
       case 'one': return { 'class': 'purple', icon: 'account_circle' }
       case 'two': return { 'class': 'red', icon: 'edit' }
       case 'three': return { 'class': 'green', icon: 'keyboard_arrow_up' }
       default: return {}
     }
   },
   formTitle () {
    return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
  },
  /*totalPrice() {
    if (!this.form.quantity || !this.form.price) {
      return 0;
    }
    let total = 0;
    let quantity = this.form.quantity
    let price = this.form.price

    return this.total.reduce(function (quantity, price) {
        // return total + Number(value.total);
        return this.quantity + this.price
    });
    // return this.quantity + this.price
  }*/

},
created () {
  this.initialize()
},
watch: {
 dialog (val) {
   val || this.close()
 },


 top (val) {
  this.bottom = !val
},
right (val) {
  this.left = !val
},
bottom (val) {
  this.top = !val
},
left (val) {
  this.right = !val
}
},
}
</script>

<style>
/* This is for documentation purposes and will not be needed in your application */
#create .speed-dial {
  position: absolute;
}

#create .btn--floating {
  position: relative;
}
.btn__content i{
  color: #fff !important;
  width: 50px;
}
.speed-dial__list i{
  color: #fff !important;
}
</style>
