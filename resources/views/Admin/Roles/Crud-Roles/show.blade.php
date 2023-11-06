@extends('Admin.Layout.starter')
@section('title','Roles')
@section('page','Roles')
@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">

            <table class="table col-md-5">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created At</th>
                        <th colspan='1'></th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse ($roles as $row => $role) --}}
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->created_at }}</td>
                        <td>
                            @can('delete', 'App\\Models\RoleUser')
                            <form action="{{ route('role.unset') }}" method="POST">
                                <input type="hidden" name="id" value="{{$role->pivot->id}}">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Unset</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
            <legend>Permissions</legend>
            <table class="table table-sm table-bordered col-md-5">
                <thead>
                    <tr class="bg-info">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($role->Permissions as $key => $permission)
                    <tr>
                        <th scope="row">{{ $key +1 }}</th>
                        <td>{{ config('permissions')[$permission->name] }}</td>
                        <td>{{ $permission->type }}</td>
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