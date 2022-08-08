<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Catalog;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsPaginate = new Product();
        $productsPaginate = $productsPaginate->orderBy('id', 'DESC')->paginate(5);

        return view('admin.product.list', [
            'products' => $productsPaginate,
            'nav_hover' => 'products',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catalogs = Catalog::all();
        // $errors = response()->json();
        return view('admin.product.create', [
            'catalogs' => $catalogs,
            'nav_hover' => 'products',
            // 'errors' => $errors
        ]);
    }

    public function saveFile($file, $prefixName = '', $folder = 'public')
    {
        if ($file) {
            $fileName = $file->hashName();
            $fileName = isset($prefixName)
                ? $prefixName . '_' . $fileName
                : $fileName;

            return $file->storeAs($folder, $fileName);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        if ($request->hasFile('main_img')) {
            $product = new Product();
            $product->fill($request->all());
            $product->main_img = $this->saveFile(
                $request->main_img,
                $request->name,
                'images/product'
            );
            $product->status = 0;
            $product->view = 0;
            $product->save();
        }

        if ($request->hasFile('image')) {
            $sort_id = 1;
            foreach ($request->image as $image) {
                $imageSave = new Image();
                $imageSave->product_id = $product->id;
                $imageSave->sort_id = $sort_id++;
                $imageSave->link = $this->saveFile(
                    $image,
                    $request->name,
                    'images/product-library',
                );
                $imageSave->save();
            }
        }

        return redirect()->route('admin.products.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $image = new Image();
        $images = $image->where("product_id", '=', $id)->get();
        $catalog = Catalog::find($product->catalog_id);
        return view('client.product', [
            'product' => $product,
            'catalog' => $catalog,
            'images' => $images,
            'nav_hover' => '',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // dd($product);
        $image_list = new Image();
        $image_list = $image_list->where('product_id', '=', $product->id)->get();
        // dd($image_list);

        $catalogs = Catalog::all();
        return view('admin.product.create', [
            'product' => $product,
            'catalogs' => $catalogs,
            'image_list' => $image_list,
            'nav_hover' => 'products'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->fill($request->all());
        // dd($product);
        if ($request->all()) {
            if ($request->hasFile('main_img')) {
                $product->main_img = $this->saveFile(
                    $request->main_img,
                    $request->name,
                    'images/product'
                );
            }
            if ($request->hasFile('image')) {
                $imageSave = new Image();
                $image_list = $imageSave->pluck('product_id', $product->id);
                $imageSave->destroy($image_list);
                foreach ($request->image as $image) {
                    $imageSave->product_id = $product->id;
                    $imageSave->link = $this->saveFile(
                        $image,
                        $request->name,
                        'images/product-library',
                    );

                    $imageSave->save();
                }
            }
            $product->save();

            return redirect()->route('admin.products.list');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
    }

    public function delete(Product $product)
    {
        // dd($product);
        if ($product) {
            $image_list = new Image();
            $image_list->pluck('id');
            Image::whereIn('product_id', $image_list)->delete();

            $product->delete();
            return redirect()->route('admin.products.list');
        }
    }

    public function changeStatus(Product $product) {
        if($product) {
            if($product->status == 0) {
                $product->status = 1;
            } else {
                $product->status = 0;
            }

            $product->save();
            return redirect()->back();
        }
    }
}
