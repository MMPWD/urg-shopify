@extends('layouts.master')

@section('pageId', 'productsPage')

@section('styles')
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
@endsection

@section('headings.left')
    <h1>
        Products
    </h1>
@endsection

@section('headings.right')
    <div class="button-group">
        <a class="button" href="{!! route('product.create') !!}"><i class="fa fa-plus"></i> New</a>
    </div>
@endsection



@section('content')


    <div class="row">
        <div class="small-12 columns">
            <table class="data-table-a">
                <thead>
                <tr>

                    <th v-on:click="sortBy('id')"
                        v-bind:class="{ 'sorted-by' : isSortedBy('id'), 'sorted-reverse' : isSortedReversed() }">
                        id
                    </th>
                    <th v-on:click="sortBy('name')" class="hide-for-small-only"
                        v-bind:class="{ 'sorted-by' : isSortedBy('title'), 'sorted-reverse' : isSortedReversed() }">
                        Name
                    </th>    
                    <th v-on:click="sortBy('description')" class="hide-for-small-only"
                        v-bind:class="{ 'sorted-by' : isSortedBy('description'), 'sorted-reverse' : isSortedReversed() }">
                        Description
                    </th>
                    <th v-on:click="sortBy('sku')" class="hide-for-small-only"
                        v-bind:class="{ 'sorted-by' : isSortedBy('sku'), 'sorted-reverse' : isSortedReversed() }">
                        SKU
                    </th>
                    <th v-on:click="sortBy('price')"
                        v-bind:class="{ 'sorted-by' : isSortedBy('price'), 'sorted-reverse' : isSortedReversed() }">
                        Price
                    </th>
                    <th v-on:click="sortBy('price')"
                        v-bind:class="{ 'sorted-by' : isSortedBy('weight'), 'sorted-reverse' : isSortedReversed() }">
                        Weight
                    </th>
                </tr>
                </thead>
                <tbody>

<?php //echo '<pre>'.print_r($products,true).'</pre>' ?>

<?php
foreach($products->products as $product) {
?>
                <tr onclick="prodClick('<?php echo $product->id ?>');">

                    <td class="hide-for-small-only"><?php echo $product->id ?></td>
                    <td class="text-capitalize"><?php echo $product->title  ?></td> 
                    <td class="hide-for-small-only"><?php echo substr($product->body_html,0,255)  ?></td> 
                    <td class="hide-for-small-only"><?php echo $product->variants[0]->sku  ?></td>
                    <td class="hide-for-small-only"><?php echo $product->variants[0]->price  ?></td>
                    <td class="hide-for-small-only"><?php echo $product->variants[0]->weight  ?></td>

                </tr>
<?php
 }
?>
<!--
                <tr v-for="product in items | filterByListSelection | filterByCustom listFilter | orderBy sortKey sortReverse | limitBy listCount"
                    transition="expand" v-on:click="selectListItem(product)">

                    <td v-on:click="toggleRead(product,$event)" v-if="product.opened == 0" class="hide-for-small-only" alt="Unread"><i class="fa fa-fw fa-lg fa-envelope fa-envelope-unread"></i></td>
                    <td v-on:click="toggleRead(product,$event)" v-if="product.opened == 1" class="hide-for-small-only" alt="Read"><i class="fa fa-fw fa-lg fa-envelope-o fa-envelope-read"></i></td>

                    <td class="text-capitalize">@{{ product.id }}</td>
                    <td class="hide-for-small-only">@{{ product.sku }}</td>
                    <td class="text-capitalize">@{{ product.name }}</td>                    
					<td class="hide-for-small-only">@{{ product.description }}</td>
                    <td class="hide-for-small-only">@{{ product.price }}</td>

                </tr>


-->

                </tbody>
            </table>
        </div>
        <div v-if="loadingItems" class="small-12 text-center columns" style="padding-top: 20px;">
            <i class="fa fa-2x fa-spinner fa-pulse"></i>
        </div>
    </div>



@endsection


@section('scripts')

<script>
 function prodClick(item) {
            console.log(item);
            window.location = "/product/" + item;
        }
        </script>
    <script src="js/vue/products.js"></script>
<script src="js/vue/filters.js"></script>

@endsection