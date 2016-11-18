@extends('layouts.master')

@section('pageId', 'productAddPage')

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
        Add New Product
    </h1>
@endsection

@section('headings.right')
    <div class="button-group">
        <a class="button back" href="{!! route('product.index') !!}"><i class="fa fa-angle-left"></i> Back</a>       
    </div>
@endsection



@section('content')

    <div class="row bottom-gap" data-equalizer>
            <div class="small-12 large-6 columns" data-equalizer-watch>
                <img class="res vehicle-image-border" src="$product->product->image->src" alt="">

                <div class="hide-for-large">
                    <br/>
                    <br/>
                </div>
            </div>


        <div class="small-12 large-6 columns vehicle-show-details">

            <div class="callout" data-equalizer-watch>
                <table>                 

                    <tr><td colspan='100%'><h3 class="title">Name<input name='title' type='text' /></h3></td></tr>
                    <tr><td>Description:</td><td><input name='body_html' type='text' /><td></tr>
                    <tr><td>Price:</td><td><input name='price' type='text' /><td></tr>
                    <tr><td>SKU:</td><td><input name='sku' type='text' /><td></tr>
                    <tr><td>Weight:</td><td><input name='weight' type='text' /><td></tr>
                </table>
            </div>
        </div>

    </div>






@endsection
@section('scripts')


@endsection


