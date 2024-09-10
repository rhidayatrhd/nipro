<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Storage;
use App\DataTables\productItemDataTable;
use Illuminate\Validation\Rule;

class ProductItemyController extends Controller
{
    // Membuat permission menggunakan contructor
    public function __construct()
    {
        $this->middleware('can:create masterdatas/productitems')->only('create');
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(productItemDataTable $dataTable)
    {
        $this->authorize('read masterdatas/productitems');
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
            'title'     => 'Create Product Item',
            'categories' => Category::all(), 
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
        $validateData = $request->validate([
            'title'         => 'required|unique:product_items|max:255',
            'category_id'   => 'required|not_in:-1',
            'image'         => 'required|image|file|max:1024',
            'body'          => 'required'
        ]); 

        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('post-images');
        }
        $validateData['user_id'] = \auth()->user()->id; 
        $validateData['excerpt'] = Str::limit(\strip_tags($request->body), 100);

        ProductItem::create($validateData);
        // return \redirect('/masterdatas/productitems')->with('success', 'New Product Item was created!');
        return \response()->json([
            'status'        => 'success',
            'message'       => 'New Product Item was created!'
        ]);
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
        // \dd($productitem->body);
        return \view('products.productitems.create', [
            'productitem' => $productitem,
            'menu'     => 'Product Maintenance',
            'title'     => 'Edit Product',
            'categories' => Category::all(),
        ],
        \compact('productitem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductItem $productitem)
    {
        $rules = [ 
            'category_id'   => 'required|not_in:-1',
            'image'         => 'image|file|max:1024',
            'body'          => 'required',
        ];
        $validateData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['image'] = $request->file('image')->store('post-images');
        }
        $validateData['excerpt'] = Str::limit(\strip_tags($request->body), 100);
        $productitem::where('id', $productitem->id)
                ->update($validateData);
        // return redirect('/masterdatas/productitems')
        // ->with('success', 'Product Item has been updated!');
        return \response()->json([
            'status'        => 'success',
            'message'       => 'Data already updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductItem $productitem)
    {
        // $productitem->delete();
        // return \response()->json([
        //     'status'        => 'success',
        //     'message'       => 'Data was deleted!'
        // ]);
        if ($productitem->image) {
            Storage::delete($productitem->image);
        }
        ProductItem::destroy($productitem->id);

        return redirect('/masterdatas/productitems')->with('success', 'Product Item has been deleted!');        
    }
}
