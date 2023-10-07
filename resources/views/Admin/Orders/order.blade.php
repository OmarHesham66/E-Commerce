@extends('Admin.Layout.starter')
@section('title','Orders')
@section('page','Orders')
@section('content')
<!-- Main content -->
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
                        {{-- <th scope="col">Title-Category</th> --}}
                        <th scope="col">User-Name</th>
                        <th scope="col">Order-Status</th>
                        <th scope="col">Payment-Status</th>
                        {{-- <th scope="col">Coupone</th> --}}
                        <th scope="col">Price</th>
                        <th scope="col">Created At</th>
                        <th colspan="4"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $row => $order)
                    <tr>
                        <th scope="row">{{ $row + 1 }}</th>
                        <td>{{ $order->order_number }}</td>
                        {{-- <td>{{ $order->title-category }}</td> --}}
                        <td>{{ $order->user->name ?? 'Unknown'}}</td>
                        <td>{{ $order->status_order }}</td>
                        <td>{{ $order->payment_status }}</td>
                        {{-- <td>{{ $order->coupone }}</td> --}}
                        <td>{{ $order->total_price }}</td>
                        {{-- <td><span style="opacity: 0">.....</span>{{ $order->quantity }}</td> --}}
                        {{-- <td>{{ $order->Category->name }}</td> --}}
                        <td>{{ $order->created_at }}</td>
                        <td>
                            @can('update','App\\Models\UserOrder')
                            <a href="{{ route('order.edit',$order->id) }}"
                                class="btn btn-sm btn-outline-success">Edit</a>
                            @endcan
                        </td>
                        <td>
                            @can('delete','App\\Models\UserOrder')
                            <form action="{{ route('order.destroy',$order->id) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                            @endcan
                        </td>
                        <td>
                            <a href="{{ route('order.items.show',$order->id) }}"
                                class="btn btn-sm btn-outline-primary">Show-Items</a>
                        </td>
                        <td>
                            <a href="{{ route('order.address.show',$order->id) }}"
                                class="btn btn-sm btn-outline-info">Show-Adresses</a>
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