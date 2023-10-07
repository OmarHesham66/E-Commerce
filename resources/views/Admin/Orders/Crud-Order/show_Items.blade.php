@extends('Admin.Layout.starter')
@section('title','Option')
@section('page','Option')
@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order-Number</th>
                        <th scope="col">User-Name</th>
                        <th scope="col">Order-Status</th>
                        <th scope="col">Payment-Status</th>
                        <th scope="col">Price</th>
                        <th scope="col">Created At</th>
                        <th colspan="3"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row"> 1 </th>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->status_order }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->price }}</td>
                        <td>{{ $order->created_at }}</td>
                    </tr>
                </tbody>
            </table>
            <div style="margin-top: 40px">
                <div style="font-size:2em;font-weight:bold">ITEMS</div>
                <table class="table">
                    <thead class="table-active">
                        <th scope="col">#</th>
                        <th scope="col">Product-Name</th>
                        <th scope="col">Product-Color</th>
                        <th scope="col">Product-Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Created At</th>
                        <th colspan="2"></th>
                    </thead>
                    <tbody>
                        @foreach ($order->OrderItems as $row => $item)
                        <tr>
                            <th scope="row">{{ $row + 1 }}</th>
                            <th>{{ $item->product_name }}</th>
                            <th>{{ json_decode($item->option)->color }}</th>
                            <th>{{ $item->price }}</th>
                            <th>{{ $item->quantity }}</th>
                            <th>{{ $item->created_at }}</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection