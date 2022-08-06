<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Catalog;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = new Product();
        $products = $product->search()->orderBy('id', 'DESC')->paginate(12);
        $brands = $product->select('brand')->distinct('brand')->get();
        $sizes = $product->select('size')->distinct('size')->get();
        // dd($brands);
        $catalogs = Catalog::all();
        // dd($brands);
        return view('client.shop', [
            'products' => $products,
            'brands' => $brands,
            'sizes' => $sizes,
            'catalogs' => $catalogs,
            'nav_hover' => 'shop',
        ]);
    }
}
