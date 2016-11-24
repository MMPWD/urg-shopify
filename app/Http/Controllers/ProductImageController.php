<?php

namespace App\Http\Controllers;

//use App\Models\Vehicle;
//use App\Models\VehicleImage;
use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {

    

        if ($request->ajax()) {
            $shopify = $this->createShopifyObject();
            $productId = Input::get('productId');
           // return $productId;
          // see if there are any images
            $url = '/admin/products/'.$productId.'/images.json';
        $images = $shopify->call([
        'METHOD'      => 'GET',
        'URL'         => $url
            ]);
           // return print_r($images,true);
             return$images->images[0]->src;
        }

        // HTTP
        $productId = $id;
        return view('pages.product.image.index', compact('productId'));

    }

    public function updateRank(Request $request, $id)
    {
//         $images = $request->get('images');

// //        return count($images);

//         foreach($images as $image) {
//             VehicleImage::where('id', '=', $image['id'])->update(['rank' => $image['rank']]);
//         }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //Check to see if Images have been uploaded.

        // $file = $request->file('file');
        // if (!$file) {
        //     return false;
        // }
        // $vehicleImage = processUploadedVehicleImage($file, $id);

        // return $vehicleImage;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param  int $imageId
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $imageId)
    {
        // $image = VehicleImage::find($imageId);
        // $imageToRemoveRank = $image->rank;
        // $image->delete();

        // $images = VehicleImage::where('vehicle_id', '=', $id)->get();
        // foreach($images as $image) {
        //     if ($image->rank >= $imageToRemoveRank)
        //     {
        //         VehicleImage::where('id', '=', $image['id'])->update(['rank' => ($image['rank'] - 1)]);
        //     }
        // }

        // return Response::json('success', 200);
    }



private function createShopifyObject() {
       $s = App::make('ShopifyAPI', [
      'API_KEY' => env('SHOPIFY_API_KEY'),
      'API_SECRET' => env('SHOPIFY_API_SECRET'),
      'SHOP_DOMAIN' => env('SHOPIFY_SHOP_DOMAIN'),
      'ACCESS_TOKEN' => env('SHOPIFY_ACCESS_TOKEN')
    ]);
       return $s;
  }



}
