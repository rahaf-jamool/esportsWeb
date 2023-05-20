<?php

namespace App\Http\Controllers;

use App\Facades\BlocksService;
use App\Facades\BlogService;
use App\Helpers\General\EndPoints;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class BlogsController extends Controller
{
    public function index() {
        $user = session()->has('loggedUser') ? session('loggedUser') : '';
        $blogs = BlogService::getApiResponse(EndPoints::GetAllAcceptedAndActiveApi);
    //  dd($blogs);
        return view('blogs.list',compact('blogs','user'));
    }

    public function view($local, $id){
        $blog = BlogService::getOne($id);
        $blog = $blog['result'];
      // dd($blog);
        return view('blogs.view',compact('blog'));
    }

    public function getSubmitBlogs(){
        $user = session()->has('loggedUser') ? session('loggedUser') : '';
        if (empty($user)) {
            return redirect(url(App::getLocale() . '/login'));
        }
        return view('blogs.form');
    }
}
