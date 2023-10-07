@extends('Admin.Layout.starter')
@section('title','Option')
@section('page','Option')
@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <a href="{{ route('option.create.1',$product->id) }}" class="btn  btn-outline-success"
                style="margin: 0 0 15px 5px; font-size:1.4em">Create</a>
            <table class="table">
                <thead class="table-dark">
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
                    <tr>
                        <th scope="row"> 1 </th>
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
                    </tr>
                </tbody>
            </table>
            {{-- <caption>OPTIONS</caption> --}}
            <div style="margin-top: 40px">
                <div style="font-size:2em;font-weight:bold">OPTIONS</div>
                <table class="table table-sm" style="width: 500px">
                    <thead class="table-active">
                        <th scope="col">#</th>
                        <th scope="col">Color</th>
                        <th scope="col">Size</th>
                        <th scope="col">Quantity</th>
                        <th colspan="2"></th>
                    </thead>
                    <tbody>
                        @foreach ($product->Options as $row => $option)
                        <tr>
                            <th scope="row">{{ $row + 1 }}</th>
                            <th>{{ $option->color }}</th>
                            <th>{{ $option->size }}</th>
                            <th>{{ $option->quantity }}</th>
                            <td>
                                <a href="{{ route('option.edit.1',[$option->id,$product->id]) }}"
                                    class="btn btn-sm btn-outline-success">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('option.destroy',$option->id) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id }}">
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
{{-- <table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">color</th>
            <th scope="col">Size</th>
            <th scope="col">Quantity</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($product->Options as $key => $option)
        <tr>
            <th scope="row">{{ $key + 1}}</th>
            <td>{{ $option->color }}</td>
            <td>{{ $option->size }}</td>
            <td>{{ $option->quantity }}</td>
        </tr>
        @endforeach
    </tbody>
</table> --}}