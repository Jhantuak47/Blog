<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = "Welcome to Bolg Post!";
        //return view('pages.index',compact('title'));

        return view('pages.index')->with('title',$title);
    }
    public function about(){
        $data = array(
            'company' =>'Blog Post',
            'owners'=>['jhantu','krishna','nandi']
        );
        return view("pages.about")->with($data);
    }
    public function services(){
        $data = array(
            'title'=>'Services',
            'services'=>['Adding','Viewing','Deleting']
        );
        return view('pages.services')->with($data);
    }
}
