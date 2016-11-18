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
// use Intervention\Image\Facades\Image;

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
    public function store(Request $request) {       

      $shopify = $this->createShopifyObject();

      $result = $shopify->call([
      'METHOD'      => 'POST',
      'URL'         => '/admin/products.json',
      'DATA'        => [
        'product' => [
          'title'  => $request->title,
          'body_html'  => $request->body_html,
          'variants' => [[
            'weight' => $request->weight,
            'sku' => $request->sku,
            'price'  => $request->price
            ]]
        ]
      ]
    ]);


      // Gets a list of products
      $products = $shopify->call([
        'METHOD'     => 'GET',
        'URL'         => '/admin/products.json?page=1'
      ]);

    return view('pages.product.index', compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {




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
    public function update(Request $request, $id) {

        //$file = $request->file('preview_image');




// PUT /admin/products/#{id}.json
// {
//   "product": {
//     "id": 632910392,
//     "title": "Updated Product Title",
//     "variants": [
//       {
//         "id": 808950810,
//         "price": "2000.00",
//         "sku": "Updating the Product SKU"
//       },
//       {
//         "id": 49148385
//       },
//       {
//         "id": 39072856
//       },
//       {
//         "id": 457924702
//       }
//     ]
//   }
// }

      $shopify = $this->createShopifyObject();

      $result = $shopify->call([
      'METHOD'      => 'PUT',
      'URL'         => '/admin/products/'.$id.'.json',
      'DATA'        => [
        'product' => [
          'id' => $request->id,
          'title'  => $request->title,
          'body_html'  => $request->body_html,
          'variants' => [[
            'weight' => $request->weight,
            'sku' => $request->sku,
            'price'  => $request->price
            ]]
        ]
      ]
    ]);





      $product = $shopify->call([
      'METHOD'      => 'GET',
      'URL'         => '/admin/products/'.$id.'.json'
    ]);


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
    'API_KEY' => '9894caa0dfeea24fa0072bbd742d8b4d',
    'API_SECRET' => '8cce588d82d90374e4ccd9f646097de7',
    'SHOP_DOMAIN' => 'urg-test-shop.myshopify.com',
    'ACCESS_TOKEN' => 'fb7c5f2957f656c7b4524b9d69f09f52'
  ]);
     return $s;
}


}
