@extends('admin.layout.main')

@section('title', 'Catalog List')

@section('content')
{{-- @dd($catalog_children) --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.catalogs.create') }}"><button type="submit" class="btn btn-primary">New
                                    Catalog</button></a>

                        </div>
                        <div class="card-body table-responsive p-0 col-12" style="height: 100%;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($catalogs as $catalog)
                                        <tr>
                                            <td>{{ $catalog->id }}</td>
                                            <td>{{ $catalog->name }}</td>
                                            <td>{{ $catalog->created_at }}</td>
                                            <td>{{ $catalog->updated_at }}</td>
                                            <td>
                                                <form action="{{ route('admin.catalogs.edit', $catalog->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.catalogs.delete', $catalog) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this catalog ?')">Delete</a></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="m-3">
                                {{ $catalogs->links('pagination::bootstrap-5') }}
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
