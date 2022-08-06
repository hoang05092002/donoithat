@extends('admin.layout.main')

@section('title', 'User List')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0 col-12" style="height: 100%;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Avatar</th>
                                        <th>Phone</th>
                                        <th>Permission</th>
                                        <th>Status</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td><img width="100" src="{{ asset($user->avatar) }}" alt=""></td>
                                            <td>{{ $user->phone }}</td>
                                            <td>
                                                <form action="{{ route('admin.users.change-permission', $user) }}" method="post">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn {{ $user->role == 0 ? 'btn-success' : 'btn-danger' }}">
                                                        @if ($user->role == 0)
                                                            <i class="fa-solid fa-user-shield"></i>
                                                        @else
                                                            <i class="fa-solid fa-user-alt"></i>
                                                        @endif
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.users.change-status', $user) }}" method="post">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn {{ $user->status == 0 ? 'btn-success' : 'btn-danger' }}">
                                                        @if ($user->status == 0)
                                                            <i class="fa-solid fa-lock-open"></i>
                                                        @else
                                                            <i class="fa-solid fa-lock"></i>
                                                        @endif
                                                    </button></form>
                                            </td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>{{ $user->updated_at }}</td>
                                            <td>
                                                <form action="{{ route('admin.users.delete', $user->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this user ?')">Delete</a></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="m-3">
                                {{ $users->links('pagination::bootstrap-5') }}
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
