@extends('Admin.Layout.starter')
@section('title','Roles')
@section('page','Roles')
@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <form action="{{ route('role.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <div class="form-group ">
                    <label for="inputState">Roles</label>
                    <select id="inputState" class="form-control" name="role">
                        <option selected>Choose...</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" id="submit_form" class="btn btn-outline-primary">Add</button>
            </form>
        </div>
    </div>
</div>
@endsection