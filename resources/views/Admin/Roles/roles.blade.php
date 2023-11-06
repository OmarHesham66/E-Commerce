@extends('Admin.Layout.starter')
@section('title','Premissions')
@section('page','Premissions')
@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            @can('create', 'App\\Models\Role')
            <a href="{{ route('permission.create') }}" class="btn  btn-outline-success"
                style="margin: 0 0 15px 5px; font-size:1.4em">Create</a>
            @endcan
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created At</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $row => $role)
                    <tr>
                        <th scope="row">{{ $row + 1 }}</th>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->created_at }}</td>
                        <td>
                            @can('update', 'App\\Models\Role')
                            <a href="{{ route('permission.edit',Crypt::encrypt($role->id)) }}"
                                class="btn btn-sm btn-outline-success">Edit</a>
                            @endcan
                        </td>
                        <td>
                            @can('delete', 'App\\Models\Role')
                            <form action="{{ route('permission.destroy',Crypt::encrypt($role->id)) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">No Defined Roles .</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection