<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ProductCategory;
use App\Models\ProductItem;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = '';
        if (\request('productcategory')) {
            $product = ProductCategory::firstWhere('slug', \request('productcategory'));
            $title = ' in ' . $product->name;
        }
        if (\request('author')) {
            $author = User::firstWhere('username', \request('author'));
            $title = ' by ' . $author->name;
        }

        return \view('posts', [
            'menu'     => 'Products',
            'title'     => 'All Product' . $title,
            'posts'     => ProductItem::latest()->filter(\request(['search', 'productcategory', 'author']))->paginate(7)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // \dd($slug);
        return \view('post', [
            'menu'     => 'Products',
            'title'     => 'Product Information' ,
            'user'      => \auth()->user(),
            'post'      => ProductItem::where('slug', $slug)->get(),
        ]);
        if ($productitem->author->id !== \auth()->user()->id) {
            \abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
