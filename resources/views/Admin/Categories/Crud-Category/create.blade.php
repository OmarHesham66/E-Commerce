@extends('Admin.Layout.starter')
@section('title','Categories')
@section('page','Categories')
@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        {{-- <div class="row"> --}}
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control @error('name')
                    is-invalid
                    @enderror" name="name" placeholder="Name...">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <input type="text" name="description" class="form-control" placeholder="Description....">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputState">Main Category</label>
                        <select id="inputState" name="main_category_id" class="form-control @error('main_category_id')
                            is-invalid
                        @enderror">
                            <option value="">Choose...</option>
                            @foreach ($main as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('main_category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <input type="file" id="photo-input" class="form-control @error('photo')
                    is-invalid
                    @enderror" name="photo" style="display: none">
                    <button id="photo-category" class="btn btn-outline-info">Upload Photo</button>
                    @error('photo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-outline-success" style="margin-top: 10px">Add</button>
            </form>
            {{--
        </div> --}}
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection