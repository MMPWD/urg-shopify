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
        <a class="button" href="{!! route('product.destroy', $product->product->id) !!}"><i class="fa fa-angle-left"></i> Delete</a>

    </div>   
@endsection



@section('content')

<?php //echo '<pre>'. print_r($product->product,true).'</pre>'; ?>
    <div class="row bottom-gap" data-equalizer>
        <div class="small-12 large-6 columns" data-equalizer-watch>
            <img class="res vehicle-image-border" 

@if (isset($product->product->image->src))
    src="{!! $product->product->image->src !!}" alt="">
@else
    src="{!! 'https://placehold.it/767x374' !!}" alt="">
@endif

        </div>

        <div class="small-12 large-6 columns vehicle-show-details">

            <div class="callout" data-equalizer-watch>

                <div class="row">
                    <div class="small-12 columns">
                        <h3 class="title">{!! $product->product->title !!}</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="small-6 large-2 columns vehicle-show-details">
                        <span>ID:</span>
                    </div>
                    <div class="small-6 large-4 columns vehicle-show-details">
                        <span>{!! $product->product->id !!}</span>
                    </div>
                </div>                        

                <div class="row">
                    <div class="small-6 large-2 columns vehicle-show-details">
                        <span>Description:</span>
                    </div>
                    <div class="small-6 large-4 columns vehicle-show-details">
                        <span>{!! $product->product->body_html !!}</span>
                    </div>
                </div>  

                <div class="row">
                    <div class="small-6 large-2 columns vehicle-show-details">
                        <span>Price:</span>
                    </div>
                    <div class="small-6 large-4 columns vehicle-show-details">
                        <span>{!! $product->product->variants[0]->price !!}</span>
                    </div>
                </div>  

                 <div class="row">
                    <div class="small-6 large-2 columns vehicle-show-details">
                        <span>SKU:</span>
                    </div>
                    <div class="small-6 large-4 columns vehicle-show-details">
                        <span>{!! $product->product->variants[0]->sku !!}</span>
                    </div>
                </div>  

                <div class="row">
                    <div class="small-6 large-2 columns vehicle-show-details">
                        <span>Weight:</span>
                    </div>
                    <div class="small-6 large-4 columns vehicle-show-details">
                        <span>{!! $product->product->variants[0]->weight !!}</span>
                    </div>
                </div>                  

            </div>
        </div>

    </div>


@endsection
@section('scripts')


@endsection


