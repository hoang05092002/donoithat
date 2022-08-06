@extends('admin.layout.main')

@section('title', 'Product List')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{route('admin.products.create')}}"><button type="submit" class="btn btn-primary">New Product</button></a>

                        </div>
                        {{-- <div class="card-header">
                            <h3 class="card-title">Fixed Header Table</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div> --}}
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0 col-12" style="height: 100%;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Image</th>
                                        <th>View</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->discount }}</td>
                                            <td><img width="100px" src="{{ asset($product->main_img) }}" alt=""></td>
                                            <td>{{ $product->view }}</td>
                                            <td>{{ $product->created_at }}</td>
                                            <td>{{ $product->updated_at }}</td>
                                            <td>
                                                <form action="{{route('admin.products.edit', $product->id)}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{route('admin.products.delete', $product)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</a></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>
                                {{ $products->links('pagination::bootstrap-5'); }}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
