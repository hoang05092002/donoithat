@extends('admin.layout.main')

@section('title', 'Order Info')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-2">
                        <div class="card-header">
                            <div class="text-black-50">
                                <h3>ID: {{ $transaction->id }}</h3>
                            </div>
                            <div class="text-black-50">
                                <h3>Username: {{ $transaction->username }}</h3>
                            </div>
                            <div class="text-black-50">
                                <h3>Phone: {{ $transaction->user_phone }}</h3>
                            </div>
                            <div class="text-black-50">
                                @if ($transaction->status == 0)
                                    <button width="100" class="btn btn-danger">Đã hủy</button>
                                @elseif ($transaction->status == 1)
                                    <button width="100" class="btn btn-primary">Chờ xác nhận</button>
                                @elseif ($transaction->status == 2)
                                    <button width="100" class="btn btn-info">Đang vận chuyển</button>
                                @elseif($transaction->status == 3)
                                    <button width="100" class="btn btn-success">Giao hàng thành công</button>
                                @elseif($transaction->status == 4)
                                    <button width="100" class="btn btn-warning">Đơn hàng bị trả lại</button>
                                @endif

                            </div>
                        </div>
                        <div class="card-body table-responsive p-0 col-12" style="height: 100%;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Image</th>
                                        <th>Discount</th>
                                        <th>Price</th>
                                        <th>Sub Total</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>
                                                <img src="{{ asset($order->main_img) }}" width="100px" alt="">
                                            </td>
                                            <td>{{ $order->price }}</td>
                                            <td>{{ $order->amount }}</td>
                                            <td>{{ $order->qty }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>{{ $order->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Change Status
                        </div>
                        <div class="card-body table-responsive p-0 col-12" style="height: 100%;">
                            <form action="{{ route('admin.transactions.changeStatus', ['id' => $transaction->id, 'status' => 1]) }}"
                                method="post">
                                @csrf
                                <button width="100" class="btn btn-primary col-1 m-2">Chờ xác nhận</button>
                            </form>
                            <form action="{{ route('admin.transactions.changeStatus', ['id' => $transaction->id, 'status' => 2]) }}"
                                method="post">
                                @csrf
                                <button width="100" class="btn btn-info col-1 m-2">Đang vận chuyển</button>
                            </form>
                            <form action="{{ route('admin.transactions.changeStatus', ['id' => $transaction->id, 'status' => 3]) }}"
                                method="post">
                                @csrf
                                <button width="100" class="btn btn-success col-1 m-2">Giao hàng thành công</button>
                            </form>
                            <form action="{{ route('admin.transactions.changeStatus', ['id' => $transaction->id, 'status' => 4]) }}"
                                method="post">
                                @csrf
                                <button width="100" class="btn btn-warning col-1 m-2">Đơn hàng bị trả lại</button>
                            </form>
                        </div>
                    </div>

                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
