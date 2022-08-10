@extends('client.layout.main')

@section('title', 'Track Order')

@section('content')
    <div class="cart-table section-padding-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="cart-title mt-50">
                        <h2>Shopping Cart</h2>
                    </div>

                    <div>
                        <table class="table table-striped">
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($transactions) --}}
                                @foreach ($transactions as $id => $transaction)
                                    <tr
                                        class="
                                    @if ($transaction->status == 0) table-danger
                                    @elseif($transaction->status == 1)
                                    table-primary
                                    @elseif($transaction->status == 2)
                                    table-info
                                    @elseif($transaction->status == 3)
                                    table-success
                                    @elseif($transaction->status == 4)
                                    table-warning @endif
                                ">
                                        <td>
                                            {{ $transaction->id }}
                                        </td>
                                        <td>
                                            {{ $transaction->username }}
                                        </td>
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
                                            <form action="{{ route('users.trackOrderInfo', $transaction) }}"
                                                method="post">
                                                @csrf
                                                {{-- @method('DELETE') --}}
                                                <button type="submit" class="btn btn-info">Info</a></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <button class="btn amado-btn mb-15">Update Cart</button>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
