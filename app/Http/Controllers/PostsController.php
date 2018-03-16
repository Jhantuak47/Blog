<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

         /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
       //$allPosts =  Post::all();
       //$allPosts = Post::where('title','post two')->get();
       //$allPosts = Post::orderBy('created_at','Desc')->get();
       //$post = Post::orderBy('title','Desc')->take(1)->get();//limit the data 1 or 10.
       //$allPosts = DB::select('SELECT * FROM posts');
       //$allPosts = Post::orderBy('title','Desc')->paginate(10);
       $allPosts = Post::where('deleted', false)
       ->orderBy('created_at','Desc')
       ->with('user')->paginate();
      $postArray = array();
      $i=0;
      foreach ($allPosts as $post) {
          $postArray[$i] = ['id'=>$post->id, 'title'=>$post->title, 'body'=>$post->body, 'created_at'=>date('M d,Y', strtotime($post->created_at)), 'user_name'=>$post->user->name,'image_path'=>$post->cover_image];
          $i++;
      }
        return view('posts.index', compact('allPosts', 'postArray'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'Body'=>'required',
            'cover_image'=> 'image|nullable|max:1999'
        ]);

        //Handle file ..
        if($request->hasFile('cover_image')){

                //Get file name with extention ...
                    $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
                //Get just file name...
                    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);//geting only the file name without extention...
                //Get just ext
                    $extension = $request->file('cover_image')->getClientOriginalExtension();
                //File name to store..
                    $fileNameToStore = $fileName.'_'.  time() . '.' .  $extension;
                //Uploading the image ..
                    $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
        else{
            
            $fileNameToStore = 'no_image.jpg';
        }
        //Inserting Post into the data base...
      $post= new Post;
      $post->title = $request->input('title');
      $post->body = $request->input('Body');
      $post->deleted = false;
      $post->user_id = auth()->user()->id;
      $post->cover_image = $fileNameToStore;
      $post->save();
    
        return redirect('/post')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show_post')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
       //$post = Post::find($id);
       if($post->deleted){
           return back()->with('error','Post does not exist !');
       }
       if(auth()->user()->id !== $post->user_id)
            return redirect('/')->with('error','Not allow to access Unauthorized pages');
       return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  

         
        // $url = Storage::url('cover_images/no_image.jpg'); //used to display the image..
        // return "<img src = '".asset($url)."' />";
        $this->validate($request,[
            'title'=>'required',
            'Body'=>'required',
            'cover_image'=> 'image|nullable|max:1999'
        ]);

        if($request->hasFile('cover_image')){

            //Get file name with extention ...
                $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just file name...
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);//geting only the file name without extention...
            //Get just ext
                $extension = $request->file('cover_image')->getClientOriginalExtension();
            //File name to store..
                $fileNameToStore = $fileName.'_'.  time() . '.' .  $extension;
            //Uploading the image ..
                $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
        //Inserting Post into the data base...
                $post = Post::find($id); ;
                $post->title = $request->input('title');
                $post->body = $request->input('Body');
                if($request->hasFile('cover_image')){
                    $post->cover_image = $fileNameToStore;
                }
                $post->save();
    
        return redirect('/post')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id)
        return redirect('/')->with('error','Not allow to access Unauthorized pages');
       // $post->delete();
       $post->deleted = true;
       $post->deleted_at = date('Y-m-d h:i:s');
       $post->save();
        return redirect('/post')->with('success', 'Post Deleted');
    }
    public function paginate(){
        return view('posts.pagination')->withUserdata($this->user);
    }
}
