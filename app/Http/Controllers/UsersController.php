<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function upload_profile_pics(Request $request){
        $this->validate($request,[
            'profile_img'=> 'image|nullable|max:1999'
        ]);

         //Handle file ..
         if($request->hasFile('profile_img')){

            //Get file name with extention ...
                $fileNameWithExt = $request->file('profile_img')->getClientOriginalName();
            //Get just file name...
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);//geting only the file name without extention...
            //Get just ext
                $extension = $request->file('profile_img')->getClientOriginalExtension();
            //File name to store..
                $fileNameToStore = $fileName.'_'.  time() . '.' .  $extension;
            //Uploading the image ..
                $path = $request->file('profile_img')->storeAs('public/profile_img', $fileNameToStore);
         }
        else{
                
                $fileNameToStore = 'no_image.jpg';
            }
    //Inserting Post into the data base...
  $user_id = auth()->user()->id;
    $user = User::find($user_id);
  $user->profile_img = $fileNameToStore;
  $user->save();
    return redirect('/home')->with('success','Profile Pics Uploaded Successfully');
    }
}
