<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::paginate();

        return response()->view('dashboard.products.index', compact("products",));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $category = Category::get();
        $product = new Product();
        return response()->view('dashboard.products.create', compact('product','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {

        $user = Auth::user();
        $storeId = $user->store_id;
        $product = new Product();
        $new_image = $this->uploadeFile($request);
        $product->store_id = $storeId;
        $product->category_id= $request->input('category_id');
        $product->name = $request->input('name');
        $product->is_visible = $request->input('is_visible');
        $product->slug = Str::slug($request->post('name'));
        $product->description = $request->input('description');
        $product->quantity = $request->input('quantity');
        $product->delivery_period = $request->input('delivery_period');
        $product->image = $new_image;
        $product->price = $request->input('price');
        $product->compare_price = $request->input('compare_price');
        $product->opations = $request->input('opations');
        $product->rating = $request->input('rating');
        $product->featured = $request->input('featured');
        $product->status = $request->input('status');

        $product->save();

        return redirect()->route('dashboard.products.index',
        )->with('success', 'Product Created ');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->view('dashboard.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {
            $product = Product::findOrFail($id);
        } catch (Exception $e) {
            return Redirect::route('dashboard.products.index')->with('info', 'item not found ');
        }


        return response()->view('dashboard.products.edit', compact('product'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $old_image = $product->image;
        $product->name = $request->post('name');
        $product->category_id = $request->post('category_id');
        $product->is_visible = $request->post('is_visible');
        $product->is_favorite = $request->post('is_favorite');
        $product->slug = Str::slug($request->post('name'));
        $product->description = $request->post('description');
        $product->quantity = $request->post('quantity');
        $product->delivery_period = $request->post('delivery_period');
        $product->price = $request->post('price');
        $product->compare_price = $request->post('compare_price');
        $product->opations = $request->post('opations');
        $product->rating = $request->post('rating');
        $product->featured = $request->post('featured');
        $product->status = $request->post('status');

        $new_image = $this->uploadeFile($request);
        if ($new_image) {
            $product->image = $new_image;
        }
        $product->update();

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }


        return redirect('dashboard/products')->with('success', 'Product Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        //    if($category->image){
        //     Storage::disk('public')->delete($category->image);

        //    }
        return redirect('dashboard/products')->with('success', 'Product Deleted!');
    }

    protected function uploadeFile(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        $new_image = $file->store('uploades', ['disk' => 'public']);
        return $new_image;
    }

    public function trash()
    {
        $products = Product::onlyTrashed()->paginate();
        return view('dashboard.products.trash', compact('products'));

    }

    public function restore(Request $request, $id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('dashboard.products.trash')
            ->with('success', 'Product restore!');


    }

    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();

        if ($product->image) {
            Storage::disk('public')->delete($product->image);

        }
        return redirect()->route('dashboard.products.trash')
            ->with('success', 'product deleted forver!');


    }
}
