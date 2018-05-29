<template>
   <v-content>
      <v-container fluid fill-height>
         <v-layout justify-center align-center>
            
            <section class="content">
              <!-- Small boxes (Stat box) -->
              <div class="row">
                <div class="col-lg-3 col-xs-6 col-md-3" id="cols">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>{{ Allusers.length }}</h3>

                      <p>Users </p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-person"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6 col-md-3" id="cols">
                  <!-- small box -->
                  <div class="small-box bg-purple">
                    <div class="inner">
                      <h3>10</h3>

                      <p>Comments</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-comments"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6 col-md-3" id="cols">
                  <!-- small box -->
                  <div class="small-box bg-orange">
                    <div class="inner">
                      <h3>2</h3>

                      <p>Uploads</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-cloud-upload"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6 col-md-3" id="cols">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3>3</h3>

                      <p>Companies registered</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-building"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                  </div>
                </div>
                <!-- ./col -->
              </div>
           </section>
         </v-layout>
      </v-container>
   </v-content>
</template>

<script>
export default {
   data() {
      return{
         Allusers: {},
      }
   },
   mounted() {
    axios.post('getUsers')
     .then((response) => this.Allusers = this.temp = response.data)
     .catch((error) => this.errors = error.response.data.errors)
   }
}
</script>


<style scoped>
/*#tiles .col-md-3{
   width: 90%;
   height: 90px;
   border-radius: 3px;
}
.bg-green{
   background: green;
}
.bg-purple{
   background: purple;
}
.bg-orange{
   background: orange;
}
.bg-aqua{
   background: aqua;
}*/
#cols{
   background: #f0f0f0;
}
</style>