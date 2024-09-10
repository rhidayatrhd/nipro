<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductItem;
use Illuminate\Http\Request;
use App\DataTables\CategoryDataTable;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    // Membuat permission menggunakan contructor
    public function __construct()
    {
        $this->middleware('can:create masterdatas/productcategories')->only('create');
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $dataTable)
    {
        $this->authorize('read masterdatas/productcategories');
        return $dataTable->render('products.categories.index', [
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
        return \view('products.categories.create', [
            'category' => new Category(),
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
            'name'      => 'required|unique:categories|max:255',
            // 'image'     => 'required|image|mimes:png,jpg,bmp|max:1024',
            'image'     => 'required|image|file|max:1024',
            'excerpt'   => 'required|max:255'
        ]);

        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('category-images');
        }

        Category::create($validateData);
        // return \redirect('/masterdatas/productcategories')->with('success', 'New Category was created!');
        return \response()->json([
            'status'        => 'success',
            'message'       => 'New Category Item was created!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $productcategory)
    {
        return \view('products.categories.show', [
            'menu'     => 'Product Maintenance',
            'title'     => 'Display Product Category',
            'user'      => \auth()->user(),
            'product'   => $productcategory
        ]);
        if ($category->author->id !== \auth()->user()->id) {
            \abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $productcategory)
    {
        return \view('products.categories.create', [
            // \compact('productitem'),
            'category' => $productcategory,
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
    public function update(Request $request, Category $productcategory)
    {
        // \ddd($request->oldImage);
        // \ddd($productcategory->image);
        $rules = [
            'image'     => 'image|file|max:1024',
            'excerpt'   => 'required|max:255'
        ];
        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('category-images');
        }
        $productcategory->where('id', $productcategory->id)
            ->update($validatedData);

        // return redirect('/masterdatas/productcategories')
        // ->with('success', 'Category has been updated!');
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
    public function destroy(Category $productcategory)
    {
        // \ddd($productcategory->id);
        $catitem = ProductItem::where('category_id', $productcategory->id)->get();
        if ($catitem[0]->empty) {
            \dd($catitem[0]->category_id);
            if ($productcategory->image) {
                Storage::delete($productcategory->image);
            }
            $productcategory->destroy($productcategory->id);

            return redirect('/masterdatas/productcategories')->with('success', 'Product Category has been deleted!');
        } else {
            return redirect('/masterdatas/productcategories')->with('error', 'Product Category have a product item!');
        }
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
