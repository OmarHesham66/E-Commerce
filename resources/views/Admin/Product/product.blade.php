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
                        <th scope="col">Title-Category</th>
                        <th scope="col">Describtion</th>
                        <th scope="col">Price</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Avaliable</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Category</th>
                        <th scope="col">Created At</th>
                        <th colspan="4"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $row => $product)
                    <tr>
                        <th scope="row">{{ $row + 1 }}</th>
                        <th>{{ $product->name }}</th>
                        <th>{{ $product->title }}</th>
                        <th>{{ $product->description }}</th>
                        <th>{{ $product->price }}$</th>
                        <th>{{ $product->discount }}</th>
                        <th>{{ $product->avaliable }}</th>
                        <th>{{ $product->rating }}</th>
                        <th><span style="opacity: 0">.....</span>{{ $product->quantity }}</th>
                        <th>{{ $product->Category->name }}</th>
                        <th>{{ $product->created_at }}</th>
                        <th>
                            @can('show', $product)
                            <a href="{{ route('product.show',$product->id) }}"
                                class="btn btn-sm btn-outline-success">Show</a>
                            @endcan
                        </th>
                        <th>
                            @can('update', 'App\\Models\Product')
                            <a href="{{ route('product.edit',$product->id) }}"
                                class="btn btn-sm btn-outline-success">Edit</a>
                            @endcan
                        </th>
                        <th>
                            @can('delete', 'App\\Models\Product')
                            <form action="{{ route('product.destroy',$product->id) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                            @endcan
                        </th>
                        <th>
                            <a class="btn btn-sm btn-outline-warning btnO" number="{{ $row }}">Show-Option</a>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="14">
                            <div style="display: none" id="table-options{{ $row }}">
                                <table class="table table-sm">
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
                                                <a href="{{ route('option.edit',$option->id) }}"
                                                    class="btn btn-sm btn-outline-success">Edit</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('option.destroy',$option->id) }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{$product->id }}">
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(function () {
    $(".btnO").each(function () {
        $(this).on("click", function () {
            var number = $(this).attr("number");
            $(`#table-options${number}`).slideToggle();
        });
    });
});
</script>
@endpush