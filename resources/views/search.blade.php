<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
        <title>Search with Laravel Scout and Vue.js!</title>
    </head>
    <body>
        <div class="container" id="app">
            <div class="alert alert-danger" role="alert" v-if="error">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                @{{ error }}
            </div>
            <div class="well well-sm">
                <div class="form-group">
                    <div class="input-group input-group-md">
                        <div class="icon-addon addon-md">
                            <input type="text" placeholder="What are you looking for?" class="form-control" v-model="query">
                        </div>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" v-if="!loading" @click="search()" v-if="!loading">Search!</button>
                            <button class="btn btn-default" type="button" disabled="disabled" v-if="loading">Searching...</button>
                        </span>
                    </div>
                </div>
            </div>
            <div id="shipments" class="row list-group">
                <div class="item col-xs-4 col-lg-4" v-for="shipment in shipments">
                    <div class="thumbnail">
                        <!-- <img class="group list-group-image" :src="shipment.image" alt="@{{ shipment.title }}" /> -->
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading">@{{ shipment.client_name }}</h4>
                            <p class="group inner list-group-item-text">@{{ shipment.description }}</p>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <p class="lead">$@{{ shipment.bar_code }}</p>
                                </div>
                                <!-- <div class="col-xs-12 col-md-6">
                                    <a class="btn btn-success" href="#">Add to cart</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>