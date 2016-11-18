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
        <a class="button save" href="javascript:{}" onclick="document.getElementById('mainForm').submit(); return false;"><i class="fa fa-plus"></i> Save</a>
    </div>
@endsection



@section('content')
    <div class="row bottom-gap" data-equalizer>
    <form action="{!! route('product.store') !!}" method="post" id="mainForm" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">


        @include('layouts.elements.errorBox')

        <div class="form-section">
            <div class="small-12 large-6 columns" data-equalizer-watch>
                <img class="res vehicle-image-border" src="$product->product->image->src" alt="">

                <div class="hide-for-large">
                    <br/>
                    <br/>
                </div>
            </div>




        <div class="small-12 large-6 columns vehicle-show-details">

            <div data-equalizer-watch>




                <div class="small-12 medium-6 columns">
                    <label class="{!! ($errors->has('name')) ? 'is-invalid-label' : '' !!}">Name
                        <input type="text"
                               class="expanded {!! ($errors->has('title')) ? 'is-invalid-input' : '' !!}"
                               name="title"
                               value="{!! old('title') !!}">
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
                               value="{!! old('body_html') !!}">
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
                               value="{!! old('price') !!}">
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
                               value="{!! old('sku') !!}">
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
                               value="{!! old('weight') !!}">
                        @if($errors->has('weight'))
                            <small class="form-error is-visible">{!! $errors->first('weight') !!}</small>
                        @endif
                    </label>
                </div>                




            </div>
        </div>
<!--







                <table>                 

                    <tr><td colspan='100%'><h3 class="title">Name<input name='title' type='text' /></h3></td></tr>
                    <tr><td>Description:</td><td><input name='body_html' type='text' /><td></tr>
                    <tr><td>Price:</td><td><input name='' type='text' /><td></tr>
                    <tr><td>SKU:</td><td><input name='sku' type='text' /><td></tr>
                    <tr><td>Weight:</td><td><input name='weight' type='text' /><td></tr>
                </table>





-->
    </form>
    </div>


@endsection
@section('scripts')


@endsection


