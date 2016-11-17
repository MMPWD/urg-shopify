<?php

namespace App\Http\Controllers;

//use App\Models\Post;
use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\File;
 use Illuminate\Support\Facades\Redirect;
 use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Log;
// use Intervention\Image\Facades\Image;

class HomeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        ini_set('display_errors', 0);
        return view('pages.home.welcome');
    }

   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
