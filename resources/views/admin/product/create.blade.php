@extends('admin.layout.main')

@section('title', 'Create New Product')

@section('content')
    {{-- <script src="https://cdn.ckeditor.com/[version.number]/[distribution]/ckeditor.js"></script> --}}

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                    <div class="card card-blue">
                        <div class="card-header">
                            @if (isset($product->id))
                                <h3 class="card-title">Update Product</h3>
                            @else
                                <h3 class="card-title">Create New Product</h3>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form
                                action="{{ isset($product->id) ? route('admin.products.update') : route('admin.products.store') }}"
                                method="post" enctype="multipart/form-data">
                                {{-- @if (isset($product->id))
                                    @method('PUT')
                                @endif --}}
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input name="name" type="text" class="form-control"
                                                placeholder="Enter ..."
                                                value="{{ isset($product->name) ? $product->name : '' }} {{ old('name') }}">
                                        </div>
                                        <div class="alert-danger">{{ $errors->first('name') ? $errors->first('name') : '' }}
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <input name="brand" type="text" class="form-control"
                                                placeholder="Enter ..."
                                                value="{{ isset($product->brand) ? $product->brand : '' }} {{ old('brand') }}">
                                        </div>
                                        <div class="alert-danger">
                                            {{ $errors->first('brand') ? $errors->first('brand') : '' }}</div>
                                    </div>

                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Code</label>
                                            <input name="code" type="text" class="form-control"
                                                placeholder="Enter ..."
                                                value="{{ isset($product->code) ? $product->code : '' }}{{ old('code') }}">
                                        </div>
                                        <div class="alert-danger">
                                            {{ $errors->first('code') ? $errors->first('code') : '' }}
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
                                            <textarea name="description" class="form-control" rows="3" placeholder="Enter ...">{{ isset($product->description) ? $product->description : '' }}{{ old('description') }}</textarea>
                                        </div>
                                        <div class="alert-danger">
                                            {{ $errors->first('description') ? $errors->first('description') : '' }}</div>
                                    </div>

                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input name="price" type="number" class="form-control"
                                                placeholder="Enter ..."
                                                value="{{ old('price') }} {{ isset($product->price) ? $product->price : '' }} ">
                                        </div>
                                        <div class="alert-danger">
                                            {{ $errors->first('price') ? $errors->first('price') : '' }}
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Discount</label>
                                            <input name="discount" type="number" class="form-control"
                                                placeholder="Enter ..."
                                                value="{{ isset($product->discount) ? $product->discount : '' }}{{ old('discount') }}">
                                        </div>
                                        <div class="alert-danger">
                                            {{ $errors->first('discount') ? $errors->first('discount') : '' }}</div>
                                    </div>

                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Main Image</label>
                                            <input name="main_img" type="file" class="form-control-file"
                                                placeholder="Enter ..." id="main_img">
                                            @if (isset($product->main_img))
                                                <img width="100px" src="{{ asset($product->main_img) }}" alt=""
                                                    class="main_img">
                                            @endif
                                            <img width="100px" src="" id="preview" alt="">
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
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    if (isset($('.main_img'))) {
                        $('.main_img').attr('src', e.target.result);
                    } else {
                        $('#preview').attr('src', e.target.result);
                    }
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#main_img").change(function() {
            readURL(this);
        });
    </script>
@endsection
