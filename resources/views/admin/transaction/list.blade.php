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
                                        <th colspan="2">Action</th>
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
                                                @if ($transaction->status == 0)
                                                    <div width="100" class="btn btn-danger">Đã hủy</div>
                                                @elseif ($transaction->status == 1)
                                                    <div width="100" class="btn btn-primary">Chờ xác nhận</div>
                                                @elseif ($transaction->status == 2)
                                                    <div width="100" class="btn btn-info">Đang vận chuyển</div>
                                                @elseif($transaction->status == 3)
                                                    <div width="100" class="btn btn-success">Giao hàng thành
                                                        công</div>
                                                @elseif($transaction->status == 4)
                                                    <div width="100" class="btn btn-warning">Đơn hàng bị trả
                                                        lại</div>
                                                @endif
                                            </td>
                                            <td>{{ $transaction->created_at }}</td>
                                            <td>{{ $transaction->updated_at }}</td>

                                            <td>
                                                <form action="{{ route('admin.transactions.info', $transaction) }}"
                                                    method="post">
                                                    @csrf
                                                    {{-- @method('DELETE') --}}
                                                    <button type="submit" class="btn btn-info">Info</a></button>
                                                </form>
                                            </td>
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
