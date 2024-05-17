<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ProductCategoryController extends Controller 
{
    // Membuat permission menggunakan contructor
    public function __construct()
    {
        $this->middleware('can:create products/productcategories')->only('create');
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $dataTable)
    {
        $this->authorize('read products/productcategories');
        return $dataTable->render('products.productcategories.index', [
            'menu'     => 'Product Maintenance',
            'title'     => 'Product Category'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('products.productcategories.create', [
            'productcategory' => new ProductCategory(),
            'menu'     => 'Product Maintenance',
            'title'     => 'Create Product Category'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'      => 'required|unique:product_categories|max:255',
            'image'     => 'image|file|max:1024',
            'excerpt'   => 'required|max:255'
        ]);

        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('category-images');
        }

        ProductCategory::create($validateData);
        return \redirect('/products/productcategories')->with('success', 'New Category was created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productcategory)
    {
        return \view('products.productcategories.show', [
            'menu'     => 'Product Maintenance',
            'title'     => 'Display Product Category',
            'user'      => \auth()->user(),
            'product'   => $productcategory 
        ]);
        if ($productcategory->author->id !== \auth()->user()->id) {
            \abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productcategory)
    {
        return \view('products.productcategories.create', [
            // \compact('productitem'),
            'productcategory' => $productcategory,
            'menu'            => 'Product Maintenance',
            'title'           => 'Edit Product Category',
        ]);
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

    public function checkSlug(Request $request) 
    {
        $slug = SlugService::createSlug(ProductCategory::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
