<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request){
           if($request->hasFile('image')){

                $imageName = $request->image->getClientOriginalName();
                $request->image->storeAs('public', $imageName);
           }
           return 'done';
    }
}
