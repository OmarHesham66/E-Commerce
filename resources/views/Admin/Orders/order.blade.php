@extends('Admin.Layout.starter')
@section('title','Orders')
@section('page','Orders')
@section('content')
<!-- Main content -->
@php
$i = 0;
$a=0;
@endphp
<div class="content">
    <div class="container-fluid">
        <div class="row">
            {{-- <a href="{{ route('order.create') }}" class="btn  btn-outline-success"
                style="margin: 0 0 15px 5px; font-size:1.4em">Create</a> --}}
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order-Number</th>
                        <th scope="col">User-Name</th>
                        <th scope="col">Order-Status</th>
                        <th scope="col">Payment-Status</th>
                        <th scope="col">Coupone</th>
                        <th scope="col">Price</th>
                        <th scope="col">Created At</th>
                        <th colspan="5"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $row => $order)
                    <tr>
                        <th scope="row">{{ $row + 1 }}</th>
                        <th>{{ $order->order_number }}</th>
                        <th>{{ $order->user->name ?? 'Unknown'}}</th>
                        <th>{{ $order->status_order }}</th>
                        <th>{{ $order->payment_status }}</th>
                        <th>{{ json_decode($order->coupone)->discount ?? 0}}%</th>
                        <th>{{ $order->total_price }}$</th>
                        <th>{{ $order->created_at }}</th>
                        <th>
                            @can('show',$order)
                            <a href="{{ route('order.show',$order->id) }}"
                                class="btn btn-sm btn-outline-success">Show</a>
                            @endcan
                        </th>
                        <th>
                            @can('update','App\\Models\UserOrder')
                            <a href="{{ route('order.edit',$order->id) }}"
                                class="btn btn-sm btn-outline-success">Edit</a>
                            @endcan
                        </th>
                        <th>
                            @can('delete','App\\Models\UserOrder')
                            <form action="{{ route('order.destroy',$order->id) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                            @endcan
                        </th>
                        <th>
                            <a class="btn btn-sm btn-outline-primary btnI" number={{ $row }}>Show-Items</a>
                        </th>
                        <th>
                            <a class="btn btn-sm btn-outline-info btnA" number={{ $row }}>Show-Adresses</a>
                        </th>
                    </tr>
                    <tr style="display:none">
                        <td colspan="13">
                            <div style="display:none" id="table-address{{ $row }}">
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
                                                <form action="{{ route('address.destroy',$address->id) }}"
                                                    method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <input type="hidden" name="order_id" value="{{$order->id }}">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr style="display:none">
                        <td colspan="13">
                            <div style="display: none" id="table-items{{ $row }}">
                                <table class="table" id="table-items">
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
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">No Defined Orders .</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(function () {
    $(".btnI").each(function () {
        $(this).on("click", function () {
            var number = $(this).attr("number");
            $(`#table-items${number}`).parent().parent().slideToggle();
            $(`#table-items${number}`).slideToggle();
        });
    });
    $(".btnA").each(function () {
        $(this).on("click", function () {
            var number = $(this).attr("number");
            $(`#table-address${number}`).parent().parent().slideToggle();
            $(`#table-address${number}`).slideToggle();
        });
    });
});

</script>
@endpush