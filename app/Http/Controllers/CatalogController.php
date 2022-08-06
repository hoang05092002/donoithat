<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatalogRequest;
use App\Models\Catalog;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogs = Catalog::select('id', 'name', 'created_at', 'updated_at', 'parent_id')->orderBy('updated_at', 'DESC')->paginate(10);
        // $catalog_children = [];
        // $count = 0;
        // foreach ($catalogs as $item) {
        //     $count ++;
        //     $catalog_children[$count] = Catalog::select('id', 'name', 'parent_id', 'created_at', 'updated_at')->orderBy('created_at', 'DESC')->get();
        // }
        return view('admin.catalog.list', [
            'catalogs' => $catalogs,
            // 'catalog_children' => $catalog_children,
            'nav_hover' => 'catalogs'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catalogs = Catalog::select('id', 'name')->get();
        return view('admin.catalog.create', [
            'catalogs' => $catalogs,
            'nav_hover' => 'catalogs'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatalogRequest $request)
    {
        if ($request->all()) {
            $catalog = new Catalog();
            $catalog->fill($request->all());
            $catalog->sort_order = 0;
            $catalog->save();
            return redirect()->route('admin.catalogs.list');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Catalog $catalog)
    {
        // dd($catalog);
        $catalogs = Catalog::all();
        return view('admin.catalog.create', [
            'catalog' => $catalog,
            'catalogs' => $catalogs,
            'nav_hover' => 'catalogs'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CatalogRequest $request, $id)
    {
        if($id) {
            $catalog = new Catalog();
            $catalog = $catalog->fill($request->all());
            $catalog->sort_order = 0;
            $catalog->save();

            return redirect()->route('admin.catalogs.list');
        } else {
            return redirect()->back();
        }
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

    public function delete(Catalog $catalog)
    {
        // dd($catalog);
        if ($catalog) {
            $product_ids = Product::where('catalog_id', '=', $catalog->id)->pluck('id');
            Product::whereIn('id', $product_ids)->update(['catalog_id' => 0]);
            $catalog->delete();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
