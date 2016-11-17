@extends('layouts.master')

@section('pageId', 'productShowPage')

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
        {!! $product->product->title !!}
    </h1>
@endsection

@section('headings.right')
    <div class="button-group">
        <a class="button back" href="{!! route('product.index') !!}"><i class="fa fa-angle-left"></i> Back</a>
        <a class="button" href="{!! route('product.edit', $product->product->id) !!}"><i class="fa fa-pencil"></i> Edit</a>

    </div>   
@endsection



@section('content')

    <div class="row bottom-gap" data-equalizer>
            <div class="small-12 large-6 columns" data-equalizer-watch>
                <img class="res vehicle-image-border" 

@if (isset($product->product->image->src))
    src="{!! $product->product->image->src !!}" alt="">
@else
    src="{!! 'https://placehold.it/767x374' !!}" alt="">
@endif

                <div class="hide-for-large">
                    <br/>
                    <br/>
                </div>
            </div>


        <div class="small-12 large-6 columns vehicle-show-details">

            <div class="callout" data-equalizer-watch>
                <table>                 

                    <tr><td colspan='100%'><h3 class="title">{!! $product->product->title !!}</h3></td></tr>
                    <tr><td>ID:</td><td>{!! $product->product->id !!}<td></tr>
                    <tr><td>Body HTML:</td><td>{!! $product->product->body_html !!}<td></tr>
                    <tr><td>Price:</td><td>{!! $product->product->variants[0]->price !!}<td></tr>
                    <tr><td>SKU:</td><td>{!! $product->product->variants[0]->sku !!}<td></tr>
                    <tr><td>Weight:</td><td>{!! $product->product->variants[0]->weight !!}<td></tr>
                </table>
            </div>
        </div>

    </div>






@endsection
@section('scripts')


@endsection


