@extends('Admin.Layout.starter')
@section('title','Products')
@section('page','Products')
@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            @can('create', 'App\\Models\Product')
            <a href="{{ route('product.create') }}" class="btn  btn-outline-success"
                style="margin: 0 0 15px 5px; font-size:1.4em">Create</a>
            @endcan
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        {{-- <th scope="col">Title-Category</th> --}}
                        <th scope="col">Describtion</th>
                        <th scope="col">Price</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Avaliable</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Category</th>
                        <th scope="col">Created At</th>
                        <th colspan="3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $row => $product)
                    <tr>
                        <th scope="row">{{ $row + 1 }}</th>
                        <td>{{ $product->name }}</td>
                        {{-- <td>{{ $product->title-category }}</td> --}}
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->discount }}</td>
                        <td>{{ $product->avaliable }}</td>
                        <td>{{ $product->rating }}</td>
                        <td><span style="opacity: 0">.....</span>{{ $product->quantity }}</td>
                        <td>{{ $product->Category->name }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>
                            @can('update', 'App\\Models\Product')
                            <a href="{{ route('product.edit',$product->id) }}"
                                class="btn btn-sm btn-outline-success">Edit</a>
                            @endcan
                        </td>
                        <td>
                            @can('delete', 'App\\Models\Product')
                            <form action="{{ route('product.destroy',$product->id) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                            @endcan
                        </td>
                        <td>
                            <a href="{{ route('product.show',$product->id) }}"
                                class="btn btn-sm btn-outline-warning">Show-Option</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection