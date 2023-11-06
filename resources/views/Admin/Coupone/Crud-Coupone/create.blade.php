@extends('Admin.Layout.starter')
@section('title','Coupones')
@section('page','Coupones')
@section('content')
<div class="content">
    <div class="container-fluid">
        <form action="{{ route('coupone.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="inputEmail4">Name</label>
                <input type="text" class="form-control @error('name')
                    is-invalid
                    @enderror" name="name" placeholder="Name..." value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputDescribtion">Describtion</label>
                <input type="text" name="detiles" class="form-control  @error('detiles')
                is-invalid
                @enderror" id="inputDescribtion" placeholder="Text...." value="{{ old('detiles') }}">
                @error('detiles')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputDescribtion">Code</label>
                <input type="text" name="code" class="form-control  @error('code')
                is-invalid
                @enderror" id="inputDescribtion" placeholder="Number...." value="{{ old('code') }}">
                @error('code')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputDescribtion">Discount</label>
                <input type="text" name="discount" class="form-control  @error('discount')
                is-invalid
                @enderror" id="inputDescribtion" placeholder="Amount...." value="{{ old('discount') }}">
                @error('discount')
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