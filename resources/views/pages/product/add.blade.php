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
    <form action="{!! route('product.store') !!}" method="post" id="mainForm" enctype="multipart/form-data" data-abide novalidate >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">


        @include('layouts.elements.errorBox')

        <div class="form-section">
            <div class="small-12 large-6 columns" data-equalizer-watch>
                <div class="small-12 columns">
                    <input type="file" name="fileUpload" />
                    <!--<input id="fileDragName"><input id="fileDragSize"><input id="fileDragType"><input id="fileDragData">-->
                    
                    <div class="small-6 columns end" id="holder" style="width:200px; height:200px; border: 10px dashed #ccc"></div>
                    <!--<div class="small-6 columns" id='container'>&nbsp;</div> -->
                </div>
            </div>

            <div class="small-12 large-6 columns vehicle-show-details">

              <div data-equalizer-watch>




                <div class="small-12 medium-6 columns">
                    <label class="{!! ($errors->has('name')) ? 'is-invalid-label' : '' !!}">Title
                        <input type="text"
                               class="expanded {!! ($errors->has('title')) ? 'is-invalid-input' : '' !!}"
                               name="title"
                               value="{!! old('title') !!}" required>
                        @if($errors->has('title'))
                            <small class="form-error is-visible">{!! $errors->first('title') !!}</small>
                        @endif
                    </label>
                </div>

                <div class="small-12 medium-6 columns">
                    <label class="{!! ($errors->has('name')) ? 'is-invalid-label' : '' !!}">Description
                        <input type="text"
                               class="expanded {!! ($errors->has('desc')) ? 'is-invalid-input' : '' !!}"
                               name="desc"
                               value="{!! old('desc') !!}">
                        @if($errors->has('desc'))
                            <small class="form-error is-visible">{!! $errors->first('desc') !!}</small>
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
          
        </div>

    </form>
    </div>


@endsection
@section('scripts')
<!--
<script src="https://code.jquery.com/jquery-3.1.1.min.js"
              integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
              crossorigin="anonymous" defer></script>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
              integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
              crossorigin="anonymous" defer></script>
-->
<script src="js/vendor/sweetalert-master/dist/sweetalert.min.js" defer></script>
<link rel="stylesheet" type="text/css" href="js/vendor/sweetalert-master/dist/sweetalert.css">
<!--<link rel="stylesheet" type="text/css" href="css/foundation.min.css">-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="js/vendor/foundation.min.js" defer></script>
<script src="js/app.js" defer></script>
<script>
$(document).ready(function () {

$(document).foundation();


    function readfiles(files) {
  for (var i = 0; i < files.length; i++) {
   // document.getElementById('fileDragName').value = files[i].name
   // document.getElementById('fileDragSize').value = files[i].size
   // document.getElementById('fileDragType').value = files[i].type
   // document.getElementById('fileDragData').value = files[i].slice();
    reader = new FileReader();
    reader.onload = function(event) {

$('#holder').css("background-image", "url("+event.target.result+")");
//$('#imgDiv')."url(/myimage.jpg)");  
  }
    reader.readAsDataURL(files[i]);
  }
}
var holder = document.getElementById('holder');
holder.ondragover = function () { this.className = 'hover'; return false; };
holder.ondragend = function () { this.className = ''; return false; };
holder.ondrop = function (e) {
    console.log('DROPPING');
  this.className = '';
  e.preventDefault();
  readfiles(e.dataTransfer.files);
} 


});
<script>
@endsection


