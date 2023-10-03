@extends('Admin.Layout.starter')
@section('title','Categories')
@section('page','Categories')
@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <a href="{{ route('category.create') }}" class="btn  btn-outline-success"
                style="margin: 0 0 15px 5px; font-size:1.4em">Create</a>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Main Category</th>
                        <th scope="col">Created At</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $row => $category)
                    <tr>
                        <th scope="row">{{ $row + 1 }}</th>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->SuperCategory->name }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td><a href="{{ route('category.edit',$category->id) }}"
                                class="btn btn-sm btn-outline-success">Edit</a></td>
                        <td>
                            <form action="{{ route('category.destroy',$category->id) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
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