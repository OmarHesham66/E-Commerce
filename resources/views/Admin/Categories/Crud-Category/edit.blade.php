@extends('Admin.Layout.starter')
@section('title','Categories')
@section('page','Categories')
@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        {{-- <div class="row"> --}}
            <form action="{{ route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control @error('name')
                    is-invalid
                    @enderror" name="name" placeholder="Name..." value="{{ old('name') ?? $category->name}}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <input type="text" name="description" class="form-control" placeholder="Description...."
                        value="{{ old('description') ?? $category->description}} ">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputState">Main Category</label>
                        <select id="inputState" name="main_category_id" class="form-control @error('main_category_id')
                            is-invalid
                        @enderror">
                            <option value="">Choose...</option>
                            @foreach ($main as $item)
                            <option @selected($item->id == (old('main_category_id') ?? $category->main_category_id))
                                value="{{ $item->id }}">{{ $item->name }} </option>
                            @endforeach
                        </select>
                        @error('Main Category')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <img src="{{ asset('Images/' .$category->photo)}}" alt="none" srcset="" width="200px"
                        height="200px">
                    <input type="file" id="photo-input" class="form-control @error('photo')
                    is-invalid
                @enderror" name="photo" style="display: none" value="">
                    <button id="photo-category" class="btn btn-outline-info" style="margin-top: 10px">Edit
                        Photo</button>
                    @error('photo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-outline-success" style="margin-top: 10px">Edit</button>
            </form>
            {{--
        </div> --}}
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection