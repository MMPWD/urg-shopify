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

@endsection

@section('headings.right')

@endsection

@section('content')

        <div class="container">
            <div class="content">
                <div class="title">Mark's URG Shopify Admin Portal</div>
                <div><br /></div>
                <h2>Welcome to Heaven. Click a link below to proceed</h2>
                <h3><a href='/show_products'>See Products</a></h3>
                <h3><a href='/add_product'>Add Product</a></h3>
                <div><br /></div>
                <div><br /></div>
                <div><br /></div>
                <div><b><h1>Release Notes</h1></b></div>
                <div><b>Known BUG</b>: Image drag and drop: Somewhere between dev and upload the image functionality has broken. Watch this space.</div>
            </div>
        </div>

@endsection


@section('scripts')

    <!--<script src="js/vue/products.js"></script>-->

@endsection