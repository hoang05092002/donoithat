@extends('admin.layout.main')

@section('title', 'Product List')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.products.create') }}"><button type="submit" class="btn btn-primary">New
                                    Product</button></a>
                        </div>

                        <input name="search" id="search" type="text" class="form-control" placeholder="Search" />

                        <div class="card-body table-responsive p-0 col-12 mt-2" style="height: 100%;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Image</th>
                                        <th>View</th>
                                        <th>Status</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="alldata">
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->discount }}</td>
                                            <td><img width="100px" src="{{ asset($product->main_img) }}" alt="">
                                            </td>
                                            <td>{{ $product->view }}</td>
                                            <td>
                                                <form action="{{ route('admin.products.change', $product) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit"
                                                        class="{{ $product->status == 0 ? 'btn btn-success' : 'btn btn-danger' }}"
                                                        onclick="return confirm('Are you sure you want to change status this product ?')">
                                                        <i
                                                            class="{{ $product->status == 0 ? 'fa-solid fa-check' : 'fa-solid fa-x' }}"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>{{ $product->created_at }}</td>
                                            <td>{{ $product->updated_at }}</td>
                                            <td>
                                                <form action="{{ route('admin.products.edit', $product->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.products.delete', $product) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this product ?')">Delete</a></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="searchdata">

                                </tbody>
                            </table>
                            <div>
                                {{ $products->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                $value = $(this).val();
                // console.log(keyword);

                $.ajax({
                    type: "GET",
                    url: 'admin/products/search',
                    data: {
                        'search': $value
                    },

                    success: function(data) {
                        console.log(data);
                        $('#alldata').html(data);
                    }
                });

                $.ajaxSetup({
                    headers: {
                        'csrftoken': '{{ csrf_token() }}'
                    }
                });
            })
        })
    </script>
@endsection
