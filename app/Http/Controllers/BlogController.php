<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        echo 'INSIDE BLOG CONTROLLER'.$id;
    }
    public function show_data($id,$name,$token)
    {
        Blog::all();
        return view('data', compact('id','name', 'token'));
    }

    public function test(Request $request) {
        dd($request);
    }

   
}
