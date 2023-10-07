@extends('Admin.Layout.starter')
@section('title','Categories')
@section('page','Categories')
@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order-Number</th>
                        <th scope="col">Invoice-ID</th>
                        <th scope="col">Transction-ID</th>
                        <th scope="col">Payment-Method</th>
                        <th scope="col">Currency</th>
                        <th scope="col">Price</th>
                        {{-- <th scope="col">Transction-ID</th> --}}
                        <th scope="col">Created At</th>
                        <th colspan="1"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $row => $payment)
                    <tr>
                        <th scope="row">{{ $row + 1 }}</th>
                        <td>{{ $payment->UserOrder->order_number }}</td>
                        <td>{{ $payment->invoice_id }}</td>
                        <td>{{ $payment->trascation_id }}</td>
                        <td>{{ $payment->payment_method }}</td>
                        <td>{{ $payment->currency }}</td>
                        <td>{{ $payment->total_price }}</td>
                        <td>{{ $payment->created_at }}</td>
                        {{-- <td>
                            <a href="{{ route('invoice.edit',Crypt::encrypt($payment->id)) }}"
                                class="btn btn-sm btn-outline-success">Edit</a>
                        </td> --}}
                        <td>
                            @can('delete','App\\Models\Payment')
                            <form action="{{ route('invoice.destroy',Crypt::encrypt($payment->id)) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection