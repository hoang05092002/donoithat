@extends('admin.layout.main')

@section('title', 'Transaction List')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
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
                                        <th>Username</th>
                                        <th>User Phone</th>
                                        <th>Amount</th>
                                        <th>Payment</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->id }}</td>
                                            <td>{{ $transaction->username }}</td>
                                            <td>{{ $transaction->user_phone }}</td>
                                            <td>{{ $transaction->amount }}</td>
                                            <td>{{ $transaction->payment }}</td>
                                            <td>{{ $transaction->message }}</td>
                                            <td>
                                                <form action="{{ route('admin.transactions.changeStatus', $transaction->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit"
                                                        class="{{ $transaction->status == 0 ? 'btn btn-success' : 'btn btn-danger' }}"
                                                        onclick="return confirm('Are you sure you want to change status this transaction ?')">
                                                        <i
                                                            class="{{ $transaction->status == 0 ? 'fa-solid fa-check' : 'fa-solid fa-x' }}"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>{{ $transaction->created_at }}</td>
                                            <td>{{ $transaction->updated_at }}</td>

                                            <td>
                                                <form action="{{ route('admin.transactions.delete', $transaction) }}"
                                                    method="post">
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
                                {{ $transactions->links('pagination::bootstrap-5') }}
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
