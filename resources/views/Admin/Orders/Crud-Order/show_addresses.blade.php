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
                <div style="font-size:2em;font-weight:bold">ADDRESSES</div>
                <table class="table">
                    <thead class="table-active">
                        <th scope="col">#</th>
                        <th scope="col">Order-Number</th>
                        <th scope="col">Type-Address</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">City</th>
                        <th scope="col">State</th>
                        <th scope="col">Zip-Code</th>
                        <th scope="col">Created At</th>
                        <th colspan="2"></th>
                    </thead>
                    <tbody>
                        @foreach ($order->Addresses as $row => $address)
                        <tr>
                            <th scope="row">{{ $row + 1 }}</th>
                            <th>{{ $order->order_number }}</th>
                            <th>{{ $address->type }}</th>
                            <th>{{ $address->first_name }}</th>
                            <th>{{ $address->last_name }}</th>
                            <th>{{ $address->phone_number }}</th>
                            <th>{{ $address->email }}</th>
                            <th>{{ $address->address_name }}</th>
                            <th>{{ $address->city }}</th>
                            <th>{{ $address->state }}</th>
                            <th>{{ $address->zip_code }}</th>
                            <th>{{ $address->created_at }}</th>
                            <td>
                                <a href="{{ route('address.edit',[$address->id,$order->id]) }}"
                                    class="btn btn-sm btn-outline-success">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('address.destroy',$address->id) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{$order->id }}">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
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