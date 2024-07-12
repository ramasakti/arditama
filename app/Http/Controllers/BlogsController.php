<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use GuzzleHttp\Client;
use DB;

class BlogsController extends Controller
{
    public function landing(Request $request)
    {
        $blogs = Blog::get();
        $jumbotron = Blog::where('status', 'jumbotron')->first();
        $popular = Blog::orderBy('hit', 'desc')->limit(5)->get();

        $client = new Client();
        $response = $client->request('GET', env('ISPAGRAM_API_URL') . '/blog', [
            'headers' => [
                'Accept' => 'application/json',
                'Origin' => env('ISPAGRAM_API_URL'),
            ],
        ]);
        $body = $response->getBody();
        $data = json_decode($body);
        
        return view('welcome', [
            'blogs' => $blogs,
            'jumbotron' => $jumbotron
        ]);
    }

    public function article($slug)
    {
        $article = DB::table('blogs')->where('slug', $slug)->first();

        return view('article', [
            'article' => $article
        ]);
    }

    public function create(Request $request)
    {
        $category = DB::table('master_category')->get();

        return view('blogs.create', [
            'category' => $category
        ]);
    }

    public function store(Request $request)
    {

    }

    public function edit($id, Request $request)
    {

    }

    public function update($id, Request $request)
    {

    }

    public function destroy($id)
    {
        DB::table('blogs')->where('id', $id)->delete();
        DB::table('data_category')->where('blog_id', $id)->delete();

        return back()->with('success', 'Berhasil delete data');
    }
}
