<?php

namespace App\Http\Controllers;

use App\Models\ProductItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\DataTables\productItemDataTable;

class ProductItemyController extends Controller
{
    // Membuat permission menggunakan contructor
    public function __construct()
    {
        $this->middleware('can:create products/productitems')->only('create');
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(productItemDataTable $dataTable)
    {
        $this->authorize('read products/productitems');
        return $dataTable->render('products.productitems.index', [
            'menu'     => 'Product Maintenance',
            'title'     => 'Product Item'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('products.productitems.create', [
            'productitem' => new ProductItem(),
            'menu'     => 'Product Maintenance',
            'title'     => 'Create Product Category',
            'categories' => ProductCategory::all(), 
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
        // \dd($request);
        $validate = $request->validate([
            'title'         => 'required|unique:product_items|max:255',
            'category_id'   => 'required',
            'image'         => 'image|file|max:1024',
            'body'          => 'required'
        ]);

        if ($request->file('image')) {
            $validate['image'] = $request->file('image')->store('post-images');
        }
        $validate['user_id'] = \auth()->user()->id;
        $validate['excerpt'] = Str::limit(\strip_tags($request->body), 100);

        ProductItem::create($validate);
        return \redirect('/products/productitems')->with('success', 'New Product Item was created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductItem $productitem)
    {
        return \view('products.productitems.show', [
            'menu'     => 'Product Maintenance',
            'title'     => 'Display Product item',
            'user'      => \auth()->user(),
            'product'   => $productitem
        ]);
        if($productitem->author->id !== \auth()->user()->id) {
            \abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductItem $productitem)
    {
        // \dd('test');
        return \view('products.productitems.create', [
            // \compact('productitem'),
            'productitem' => $productitem,
            'menu'     => 'Product Maintenance',
            'title'     => 'Edit Product',
            'categories' => ProductCategory::all(),
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
    public function destroy(ProductItem $productitem)
    {
        $productitem->delete();
        return \response()->json([
            'status'        => 'success',
            'message'       => 'Data was deleted!'
        ]);
    }
}
