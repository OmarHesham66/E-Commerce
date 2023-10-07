@extends('Admin.Layout.starter')
@section('title','Permissions')
@section('page','Permissions')
@section('content')
<div class="content">
    <div class="container-fluid">
        <form action="{{ route('permission.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="inputDescribtion">Role</label><br>
                <input type="text" class="form-control @error('role')
                is-invalid
                @enderror" name="role" value="{{ old('role') }}">
                @error('role')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <fieldset>
                <legend>Permissions</legend>
                @foreach (config('permissions') as $values)
                @foreach ($values as $key => $value)
                <span style="font-weight: bold">{{$value }}</span>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="perm[{{ $key }}]" value="Allow"
                        @checked('Allow'==old("perm.$key"))>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Allow
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="perm[{{ $key }}]" value="Deny"
                        @checked('Deny'==old("perm.$key"))>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Deny
                    </label>
                </div>
                @error("perm.$key")
                <div>
                    {{ $message }}
                </div>
                @enderror
                @endforeach
                @endforeach
            </fieldset>
            <button type="submit" id="submit_form" class="btn btn-outline-primary">Add</button>
        </form>
    </div>
</div>
@endsection