<?php

namespace App\Http\Controllers;

//use App\Models\Post;
use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\File;
 use Illuminate\Support\Facades\Redirect;
 use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Log;
 use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
      ini_set('display_errors', 1);

      $shopify = $this->createShopifyObject();

      // Gets a list of products
      $products = $shopify->call([
        'METHOD'     => 'GET',
        'URL'         => '/admin/products.json?page=1'
      ]);

    return view('pages.product.index', compact('products'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('pages.product.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\ProductCreationRequest $request) {       

      // Instantiate the shopify api object
      $shopify = $this->createShopifyObject();

      // Write the [roducts details to shopify]
      $result = $shopify->call([
      'METHOD'      => 'POST',
      'URL'         => '/admin/products.json',
      'DATA'        => [
        'product' => [
          'title'  => $request->title,
          'body_html'  => $request->desc, 
          'variants' => [[
            'weight' => $request->weight,
            'sku' => $request->sku,
            'price'  => $request->price
            ]]
          ]
        ]
      ]);

      // Get the product ID from the curl response 
      $productID = $result->product->id;

      // Do the image add separately as there may be a problem with the shopify image api
      if( isset($request->fileUpload) ) {
        $thisImage = $request->file('fileUpload');
        $name = $thisImage->getClientOriginalName();
        $thisImage->move('/tmp', $name);
        $data = file_get_contents( '/tmp/'. $name );
        $base64 =  base64_encode($data);

        $result2 = $shopify->call([
        'METHOD'      => 'POST',
        'URL'         => '/admin/products/'.$productID.'/images.json',
        'DATA'        => [
              'image' => [
               "attachment" => $base64
            ]
          ]
        ]);
      }

      // Gets a list of products
      $products = $shopify->call([
        'METHOD'     => 'GET',
        'URL'         => '/admin/products.json?page=1'
      ]);

      // Return the index view
      return view('pages.product.index', compact('products'));
    }




    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

      $shopify = $this->createShopifyObject();

      $product = $shopify->call([
      'METHOD'      => 'GET',
      'URL'         => '/admin/products/'.$id.'.json'
    ]);


        return view('pages.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $shopify = $this->createShopifyObject();

      $product = $shopify->call([
      'METHOD'      => 'GET',
      'URL'         => '/admin/products/'.$id.'.json'
    ]);
        return view('pages.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ProductUpdateRequest $request, $id) {

      $shopify = $this->createShopifyObject();

      $result = $shopify->call([
      'METHOD'      => 'PUT',
      'URL'         => '/admin/products/'.$id.'.json',
      'DATA'        => [
        'product' => [
          'id' => $request->id,
          'title'  => $request->title,
          'body_html'  => $request->desc,
          'variants' => [[
            'weight' => $request->weight,
            'sku' => $request->sku,
            'price'  => $request->price
            ]]
        ]
      ]
    ]);

      // Do the image add separately as there may be a problem with the shopify image api
      if( isset($request->fileUpload) ) {

          // see if there are any images
        $images = $shopify->call([
        'METHOD'      => 'GET',
        'URL'         => '/admin/products/'.$id.'/images.json'
            ]);

        // if there was an image then get its image id.
        if(count($images->images) > 0 ) {

        //echo '<pre>'.$images->images[0]->id.'</pre>';

        // delete the image

        $deleteImages = $shopify->call([
        'METHOD'      => 'DELETE',
        'URL'         => '/admin/products/'.$id.'/images/'.$images->images[0]->id.'.json'
            ]);
      }

      // now, reghardless we can add the new image

        $thisImage = $request->file('fileUpload');
        $name = $thisImage->getClientOriginalName();
        $thisImage->move('/tmp', $name);
        $data = file_get_contents( '/tmp/'. $name );
        $base64 =  base64_encode($data);

        $result2 = $shopify->call([
        'METHOD'      => 'POST',
        'URL'         => '/admin/products/'.$id.'/images.json',
        'DATA'        => [
              'image' => [
               "attachment" => $base64
            ]
          ]
        ]);
      }



      $product = $shopify->call([
      'METHOD'      => 'GET',
      'URL'         => '/admin/products/'.$id.'.json'
    ]);

//echo '<pre>'.print_r($images,true).'</pre>';

        return view('pages.product.show', compact('product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $shopify = $this->createShopifyObject();

      $result = $shopify->call([
        'METHOD'      => 'DELETE',
        'URL'         => '/admin/products/'.$id.'.json',
      ]);

      // Gets a list of products
      $products = $shopify->call([
        'METHOD'     => 'GET',
        'URL'         => '/admin/products.json?page=1'
      ]);

      return view('pages.product.index', compact('products'));  
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