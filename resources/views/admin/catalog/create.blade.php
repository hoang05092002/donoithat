@extends('admin.layout.main')

@section('title', 'Create New Catalogs')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row m-2">
                {{-- {{dd($catalog)}} --}}
                <!-- left column -->
                <div class="col-md-8">
                    <div class="card card-blue">
                        <div class="card-header">
                            @if (isset($catalog->id))
                                <h3 class="card-title">Update Catalog</h3>
                            @else
                                <h3 class="card-title">Create New Catalog</h3>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form
                                action="{{ isset($catalog->id) ? route('admin.catalogs.update', $catalog->id) : route('admin.catalogs.store') }}"
                                method="post" enctype="multipart/form-data">
                                @if (isset($catalog->id))
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
                                                value="{{ isset($catalog->name) ? $catalog->name : '' }} {{old('name')}}">
                                            <label for="" class="text-danger">{{$errors->first('name')}}</label>
                                        </div>

                                    </div>

                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Parent</label>
                                            <select class="form-control" name="parent_id">
                                                <option value="0">--- Select ---</option>
                                                @foreach ($catalogs as $item)
                                                    <option {{ isset($catalog->parent_id) && $item->id == $catalog->parent_id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        @if (isset($catalog->id))
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
