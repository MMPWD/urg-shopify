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
        Edit {!! $product->product->title !!}
    </h1>
@endsection

@section('headings.right')
    <div class="button-group">
        <a class="button back" href="{!! route('product.index') !!}"><i class="fa fa-angle-left"></i> Back to Index</a>
        <a class="button" href="{!! route('product.show', $product->product->id) !!}"><i class="fa fa-pencil"></i> Back to View</a> 
        <a class="button save" href="javascript:{}" onclick="document.getElementById('mainForm').submit(); return false;"><i class="fa fa-plus"></i> Save</a>       
    </div>
@endsection



@section('content')






    <div class="row bottom-gap" data-equalizer>
    <form action="{!! route('product.update',$product->product->id) !!}" method="post" id="mainForm" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $product->product->id }}">


        @include('layouts.elements.errorBox')

        <div class="form-section">
            <div class="small-12 large-6 columns" data-equalizer-watch>
                               <!--
                    <input type="file" name="fileUpload" />
                    <div class="small-6 columns end" id="holder" style="width:200px; height:200px; border: 10px dashed #ccc"></div>
                    -->
                <img class="res vehicle-image-border" 
@if (isset($product->product->image->src))
    src="{!! $product->product->image->src !!}" alt="">
@else
    src="{!! 'https://placehold.it/767x374' !!}" alt="">
@endif                    

            </div>

            <div class="small-12 large-6 columns vehicle-show-details">

              <div data-equalizer-watch>




                <div class="small-12 medium-6 columns">
                    <label class="{!! ($errors->has('name')) ? 'is-invalid-label' : '' !!}">Name
                        <input type="text"
                               class="expanded {!! ($errors->has('title')) ? 'is-invalid-input' : '' !!}"
                               name="title"
                               value="{!! old('title', $product->product->title) !!}">
                        @if($errors->has('title'))
                            <small class="form-error is-visible">{!! $errors->first('title') !!}</small>
                        @endif
                    </label>
                </div>

                <div class="small-12 medium-6 columns">
                    <label class="{!! ($errors->has('name')) ? 'is-invalid-label' : '' !!}">Description
                        <input type="text"
                               class="expanded {!! ($errors->has('body_html')) ? 'is-invalid-input' : '' !!}"
                               name="body_html"
                               value="{!! old('body_html',$product->product->body_html) !!}">
                        @if($errors->has('body_html'))
                            <small class="form-error is-visible">{!! $errors->first('body_html') !!}</small>
                        @endif
                    </label>
                </div>

                <div class="small-12 medium-6 columns">
                    <label class="{!! ($errors->has('name')) ? 'is-invalid-label' : '' !!}">Price
                        <input type="text"
                               class="expanded {!! ($errors->has('price')) ? 'is-invalid-input' : '' !!}"
                               name="price"
                               value="{!! old('price',$product->product->variants[0]->price) !!}">
                        @if($errors->has('price'))
                            <small class="form-error is-visible">{!! $errors->first('price') !!}</small>
                        @endif
                    </label>
                </div>

                <div class="small-12 medium-6 columns">
                    <label class="{!! ($errors->has('name')) ? 'is-invalid-label' : '' !!}">SKU
                        <input type="text"
                               class="expanded {!! ($errors->has('sku')) ? 'is-invalid-input' : '' !!}"
                               name="sku"
                               value="{!! old('sku',$product->product->variants[0]->sku) !!}">
                        @if($errors->has('sku'))
                            <small class="form-error is-visible">{!! $errors->first('sku') !!}</small>
                        @endif
                    </label>
                </div>

                <div class="small-12 medium-6 columns">
                    <label class="{!! ($errors->has('name')) ? 'is-invalid-label' : '' !!}">Weight
                        <input type="text"
                               class="expanded {!! ($errors->has('weight')) ? 'is-invalid-input' : '' !!}"
                               name="weight"
                               value="{!! old('weight',$product->product->variants[0]->weight) !!}">
                        @if($errors->has('weight'))
                            <small class="form-error is-visible">{!! $errors->first('weight') !!}</small>
                        @endif
                    </label>
                </div>                

              </div>
          </div>
          
        </div>

    </form>
    </div>






@endsection
@section('scripts')


@endsection


