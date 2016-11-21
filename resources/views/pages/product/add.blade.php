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






#drop-zone {
    /*Sort of important*/
    width: 300px;
    /*Sort of important*/
    height: 200px;
    position:absolute;
    left:50%;
    top:100px;
    margin-left:-150px;
    border: 2px dashed rgba(0,0,0,.3);
    border-radius: 20px;
    font-family: Arial;
    text-align: center;
    position: relative;
    line-height: 180px;
    font-size: 20px;
    color: rgba(0,0,0,.3);
}

    #drop-zone input {
        /*Important*/
        position: absolute;
        /*Important*/
        cursor: pointer;
        left: 0px;
        top: 0px;
        /*Important This is only comment out for demonstration purposes.
        opacity:0; */
    }

    /*Important*/
    #drop-zone.mouse-over {
        border: 2px dashed rgba(0,0,0,.5);
        color: rgba(0,0,0,.5);
    }


/*If you dont want the button*/
#clickHere {
    position: absolute;
    cursor: pointer;
    left: 50%;
    top: 50%;
    margin-left: -50px;
    margin-top: 20px;
    line-height: 26px;
    color: white;
    font-size: 12px;
    width: 100px;
    height: 26px;
    border-radius: 4px;
    background-color: #3b85c3;

}

    #clickHere:hover {
        background-color: #4499DD;

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <div class="row bottom-gap" data-equalizer>
    <form action="{!! route('product.store') !!}" method="post" id="mainForm" enctype="multipart/form-data" data-abide novalidate >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">


        @include('layouts.elements.errorBox')

        <div class="form-section">




        <!--    <div class="small-12 large-6 columns" data-equalizer-watch>
                <div class="small-12 columns">
                    <input type="file" name="fileUpload" class="image-provider-a" />
                    <div class="small-6 columns end" id="holder" style="width:200px; height:200px; border: 10px dashed #ccc">
                      <img class="image-holder-a" src="" />
                    </div>
                </div>
            </div>
-->
            <div class="small-12 large-6 columns" data-equalizer-watch>
         
                <div class="small-12 large-6 columns" >
                    <div id="drop-zone">
                        Drop files here...
                            <input type="file" name="fileUpload" class="image-provider-a" />
                                <img class="res image-holder-a"" alt="">        
                    </div>
                 </div>
            </div>



            <div class="small-12 large-6 columns vehicle-show-details">

              <div data-equalizer-watch>




                <div class="small-12 medium-6 columns">
                    <label class="{!! ($errors->has('name')) ? 'is-invalid-label' : '' !!}">Name / Title
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

    <script type="text/javascript">

        // Read input image and display
        function readImage(input, elem) {

            elem = $(".image-holder-a");
            console.log('e'+elem);

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    elem.attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // display input image before upload.
        $(".image-provider-a").change(function () {
            readImage(this, $(this));
        });

    </script>





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

$(function () {
    var dropZoneId = "drop-zone";
    //var buttonId = "clickHere";
    var mouseOverClass = "mouse-over";

    var dropZone = $("#" + dropZoneId);
    var ooleft = dropZone.offset().left;
    var ooright = dropZone.outerWidth() + ooleft;
    var ootop = dropZone.offset().top;
    var oobottom = dropZone.outerHeight() + ootop;
    var inputFile = dropZone.find("input");
    document.getElementById(dropZoneId).addEventListener("dragover", function (e) {
        e.preventDefault();
        e.stopPropagation();
        dropZone.addClass(mouseOverClass);
        var x = e.pageX;
        var y = e.pageY;

        if (!(x < ooleft || x > ooright || y < ootop || y > oobottom)) {
            inputFile.offset({ top: y - 15, left: x - 100 });
        } else {
            inputFile.offset({ top: -400, left: -400 });
        }

    }, true);

    // if (buttonId != "") {
    //     var clickZone = $("#" + buttonId);

    //     var oleft = clickZone.offset().left;
    //     var oright = clickZone.outerWidth() + oleft;
    //     var otop = clickZone.offset().top;
    //     var obottom = clickZone.outerHeight() + otop;

    //     $("#" + buttonId).mousemove(function (e) {
    //         var x = e.pageX;
    //         var y = e.pageY;
    //         if (!(x < oleft || x > oright || y < otop || y > obottom)) {
    //             inputFile.offset({ top: y - 15, left: x - 160 });
    //         } else {
    //             inputFile.offset({ top: -400, left: -400 });
    //         }
    //     });
    // }

    document.getElementById(dropZoneId).addEventListener("drop", function (e) {
        $("#" + dropZoneId).removeClass(mouseOverClass);
    }, true);

})
// Check for the various File API support.
if (window.File && window.FileReader && window.FileList && window.Blob) {
  console.log('yay');
} else {
  console.log('The File APIs are not fully supported in this browser.');
}

<script>
@endsection


