@extends('admin.layout.main')

@section('title', 'Create New Product')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                    <div class="card card-blue">
                        <div class="card-header">
                            <h3 class="card-title">Create New Product</h3>
                        </div>

                        <div>
                            <div>
                                @if ($errors->any())
                                    @dd($errors)
                                @endif
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form
                                action="{{ isset($product->id) ? route('admin.products.update', $product->id) : route('admin.products.store') }}"
                                method="post" enctype="multipart/form-data">
                                @if (isset($product->id))
                                    @method('PUT')
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input name="name" type="text" class="form-control"
                                                placeholder="Enter ..."
                                                value="{{ isset($product->name) ? $product->name : '' }}">
                                        </div>
                                    </div>
                                    <div class="text-danger">{{ $errors->name }}</div>
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <input name="brand" type="text" class="form-control"
                                                placeholder="Enter ..."
                                                value="{{ isset($product->brand) ? $product->brand : '' }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Code</label>
                                            <input name="code" type="text" class="form-control"
                                                placeholder="Enter ..."
                                                value="{{ isset($product->code) ? $product->code : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Catalog</label>
                                            <select name="catalog_id" id="" class="form-control">
                                                @foreach ($catalogs as $catalog)
                                                    <option value="{{ $catalog->id }}"
                                                        selected="{{ isset($product->catalog_id) && $product->catalog_id == $catalog->id ? 'selected' : '' }}">
                                                        {{ $catalog->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Size</label>
                                            <select name="size" id="" class="form-control ">
                                                <option value="0"
                                                    selected="{{ isset($product->size) && $product->size == 0 ? 'selected' : '' }}">
                                                    Large Size</option>
                                                <option value="1"
                                                    selected="{{ isset($product->size) && $product->size == 1 ? 'selected' : '' }}">
                                                    Medium Size</option>
                                                <option value="2"
                                                    selected="{{ isset($product->size) && $product->size == 2 ? 'selected' : '' }}">
                                                    Small Size</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control" rows="3" placeholder="Enter ...">{{ isset($product->description) ? $product->description : '' }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input name="price" type="number" class="form-control"
                                                placeholder="Enter ..."
                                                value="{{ isset($product->price) ? $product->price : '' }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Discount</label>
                                            <input name="discount" type="number" class="form-control"
                                                placeholder="Enter ..."
                                                value="{{ isset($product->discount) ? $product->discount : '' }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Main Image</label>
                                            <input name="main_img" type="file" class="form-control-file"
                                                placeholder="Enter ...">
                                            @if (isset($product->main_img))
                                                <img width="100px" src="{{ asset($product->main_img) }}" alt="">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Photo library</label>
                                            <input name="image[]" type="file" class="form-control-file"
                                                placeholder="Enter ..." multiple>
                                            @if (isset($image_list))
                                                @foreach ($image_list as $image)
                                                    <img width="100px" src="{{ asset($image) }}" alt="">
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- select -->
                                        @if (isset($product->id))
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        @else
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>

                @endsection
