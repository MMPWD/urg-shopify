@extends('layouts.master')

@section('pageId', 'productImagesPage')

@section('headings.left')
    <h1>
        Edit Product Images
    </h1>
@endsection

@section('headings.right')
    <div class="button-group">
        <a class="button back" href="{!! route('product.show', $productId) !!}"><i class="fa fa-angle-left"></i> Back</a>
        <a data-open="dropzoneModal" class="inline-block">
            <button class="button expand edit expanded">Add</button>
        </a>
    </div>
@endsection


@section('content')





<img src='' id='prodImg' />
    <div class="row wide vehicle-image-gallery" id="gallery">
        <div class="gallery-item" v-for="image in images | orderBy 'rank'">
         <!--   <a v-bind:href="vehicleImagePathJs + image.original_filename"
               data-lightbox="!! $product->make . ' ' . $vehicle->model !!"
               data-title="!! $vehicle->make . ' ' . $vehicle->model !!">
                <img v-bind:src="vehicleImagePathJs + image.thumbnail"
                     class="res gallery-item-thumbnail vehicle-image-border">
            </a>
            <a href="#" v-on:click.prevent="removeItem(image)" class="vehicle-image-selector-delete-button"><i
                        class="fa fa-fw fa-lg fa-times-circle"></i></a>-->
                        
        </div>
    </div>







@endsection

@section('scripts')


    <script type="text/javascript">

        var imageCollection = document.getElementById('gallery');
        var sortable = Sortable.create(imageCollection, {
            onEnd: function (/**Event*/evt) {
                productImagesPage.rankChanged(evt.oldIndex, evt.newIndex);
            }
        });

        $('#dropzone-finished').on('click', function () {
            location.reload();
        })

        //        var ImageDropzone = $("#image-dropzone").dropzone();

        //        ImageDropzone.on('success', function (vehicleImage) {
        //            alert()
        //            vehicleImagesPage.addImageToObject(vehicleImage);
        //        });

       // var businessId = !! Session::get('selectedBusiness')->id !!;
        var productId = {!! $productId !!};
       // var productImages = !! $product->images !!;


    </script>

    <script src="js/vue/productImages.js"></script>
    <script src="js/vue/directives.js"></script>



@endsection


@section('modals')

    <div class="reveal " id="dropzoneModal" data-reveal>
        <h1>Add Images</h1>

        <p class="lead">Drop files below or click to add images to the chosen product.</p>


        <div class="row">
            <div class="small-12 columns">
                <form action="{!! route('product.image.store', $productId) !!}" method="post"
                      enctype="multipart/form-data" class="dropzone">
                    {!! csrf_field() !!}
                </form>
            </div>
        </div>

        <div class="row">
            <div class="small-12 text-center columns">
                <br/>
                <button id="dropzone-finished" class="button submit">Finished</button>
            </div>
        </div>

        <button class="close-button" data-close aria-label="Close reveal" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@endsection