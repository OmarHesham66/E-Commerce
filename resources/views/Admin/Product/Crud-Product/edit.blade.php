@extends('Admin.Layout.starter')
@section('title','Products')
@section('page','Products')
@section('content')
<div class="content">
    <div class="container-fluid">
        <form action="{{ route('product.update',$product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Name</label>
                    <input type="text" class="form-control @error('name')
                    is-invalid
                    @enderror" name="name" placeholder="Name..." value="{{ old('name') ?? $product->name}}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="inputTitle4">Title</label>
                    <input type="Title" class="form-control @error('title')
                        is-invalid
                    @enderror" id="inputTitle4" name="title" placeholder="Title"
                        value="{{ old('title') ?? $product->title}}">
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="inputDescribtion">Describtion</label>
                <input type="text" name="describtion" class="form-control  @error('describtion')
                is-invalid
                @enderror" id="inputDescribtion" placeholder="Text...."
                    value="{{ old('describtion') ?? $product->describtion}}">
                @error('describtion')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputDescribtion">Photo</label><br>
                <img src="{{ asset('Images') . $product->photo}}" width="150px" height="200px">
                <input type="file" id="photo-input" class="form-control @error('photo')
                is-invalid
                @enderror" name="photo" style="display: none" value="{{ old('photo') }}">
                <button id="photo-category" class="btn btn-outline-info">Upload Photo</button>
                @error('photo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">Price</label>
                    <input type="text" name="price" class="form-control @error('price')
                        is-invalid
                    @enderror" id="inputCity" value="{{ old('price') ?? $product->price}}">
                    @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Price-After-Discount</label>
                    <input type="text" name="discount" class="form-control @error('discount')
                        is-invalid
                    @enderror" id="inputZip" value="{{ old('discount') ?? $product->discount}}">
                    @error('discount')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Category</label>
                    <select id="inputState" name="category_id" class="form-control @error('category_id')
                    is-invalid
                @enderror">
                        <option value="">Choose...</option>
                        @foreach ($categories as $category)
                        <option @selected(old('category_id') ?? $product->category_id == $category->id)
                            value="{{ $category->id }}">
                            {{$category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            {{-- <div class="form-group">
                <a class="btn btn-outline-warning" id="add">
                    Add-Option
                </a>
            </div>
            <div class="form-group" style="display: flex;flex-wrap:wrap;" id="divbtn">
                @if(session('isOption'))
                <div>
                    {{ session('isOption') }}
                </div>
                @endif
                @if(session('isOptionFull'))
                <div>
                    {{session('isOptionFull')}}
                </div>
                @endif
            </div> --}}
            <button type="submit" id="submit_form" class="btn btn-outline-primary">Add</button>
        </form>
        {{-- @selected('S' == old('option.color.${index}'))/ --}}
    </div>
</div>
@endsection
<script>
    let c = "{{ old('counter') ?? 0}}";
    let a ="{{ old('option.color.0') }}"
    console.log(a);
</script>