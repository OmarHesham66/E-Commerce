@extends('Admin.Layout.starter')
@section('title','Coupones')
@section('page','Coupones')
@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            @can('create', 'App\\Models\Coupone')
            <a href="{{ route('coupone.create') }}" class="btn  btn-outline-success"
                style="margin: 0 0 15px 5px; font-size:1.4em">Create</a>
            @endcan
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Created At</th>
                        <th colspan="1"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($coupones as $row => $coupone)
                    <tr>
                        <th scope="row">{{ $row + 1 }}</th>
                        <td>{{ $coupone->name }}</td>
                        <td>{{ $coupone->code }}</td>
                        <td>{{ $coupone->discount }}</td>
                        <td>{{ $coupone->created_at }}</td>
                        {{-- <td>
                            @can('update','App\\Models\UserOrder')
                            <a href="{{ route('order.edit',$order->id) }}"
                                class="btn btn-sm btn-outline-success">Edit</a>
                            @endcan
                        </td> --}}
                        <td>
                            @can('delete',$coupone)
                            <form action="{{ route('coupone.destroy',$coupone->id) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                            @endcan
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