@extends('Admin.Layout.starter')
@section('title','Options')
@section('page','Options')
@section('content')
<div class="content">
    <div class="container-fluid">
        <form action="{{ route('option.update',$option->id) }}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="form-group col-md-3">
                <label for="inputCity">Color</label>
                <input type="color" class="form-control @error('color')
                    is-invalid
                @enderror" id="inputCity" name="hexa" value="{{ old('hexa') ?? $option->hexa}}">
                <input id="sec" type="hidden" name="color" value="{{ old('color') ?? $option->color}}">
                @error('color')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="inputZip">Quantity</label>
                <input type="number" name="quantity" class="form-control @error('quantity')
                    is-invalid
                @enderror" min="1" max="100" value="{{ old('quantity') ?? $option->quantity}}">
                @error('quantity')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-5">
                <label for="inputState">Size</label>
                <select id="inputState" name="size" class="form-control @error('size')
                    is-invalid
                @enderror">
                    <option value="">Choose...</option>
                    <option @selected('S'==(old('size') ?? $option->size)) value="S">Small</option>
                    <option @selected('M'==(old('size') ?? $option->size)) value="M">Medium</option>
                    <option @selected('L'==(old('size') ?? $option->size)) value="L">Large</option>
                    <option @selected('XL'==(old('size') ?? $option->size)) value="XL">X-Large</option>
                    <option @selected('XXL'==(old('size') ?? $option->size)) value="XXL">XX-Large</option>
                </select>
                @error('size')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" id="submit_form" class="btn btn-outline-primary">Add</button>
        </form>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('dist/js/ConvertColor.js') }}"></script>
@endpush