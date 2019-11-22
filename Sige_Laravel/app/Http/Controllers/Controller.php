<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        return view('admin.index.index');
    }

    public function about(){
        return view('admin.index.about');
    }

    public function contact(){
        return view('admin.index.contact');
    }

    public function events(){
        return view('admin.index.events');
    }

    public function gallery(){
        return view('admin.index.gallery');
    }

    public function news(){
        return view('admin.index.news');
    }
}
