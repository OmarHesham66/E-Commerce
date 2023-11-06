@extends('Admin.Layout.starter')
@section('title','Admins')
@section('page','Admins')
@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            @can('create', 'App\\Models\Admin')
            <a href="{{ route('product.create') }}" class="btn  btn-outline-success"
                style="margin: 0 0 15px 5px; font-size:1.4em">Create</a>
            @endcan
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Created_at</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $row => $admin)
                    <tr>
                        <th scope="row">{{ $row + 1 }}</th>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->created_at }}</td>
                        @if ($admin->role->count()>0)
                        <td>
                            @can('view', $admin->role[0])
                            <a href="{{ route('admin.show',Crypt::encrypt($admin->id)) }}"
                                class="btn btn-sm btn-outline-success">Show-Role</a>
                            @endcan
                        </td>
                        @else
                        <td>
                            @can('create', 'App\\Models\RoleUser')
                            <a href="{{ route('role.select',Crypt::encrypt($admin->id)) }}"
                                class="btn btn-sm btn-outline-success">Set-Role</a>
                            @endcan
                        </td>
                        @endif
                        <td>
                            @can('delete', 'App\\Models\Admin')
                            <form action="{{ route('admin.destroy',$admin->id) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection