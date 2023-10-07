@extends('Admin.Layout.starter')
@section('title','Orders')
@section('page','Orders')
@section('content')
<div class="content">
    <div class="container-fluid">
        <form action="{{ route('order.update',$order->id) }}" method="post">
            @csrf
            @method('put')
            @foreach ($enum as $status)
            <div class="form-check">
                <input @checked($status==$order->status_order) class="form-check-input" type="radio"
                name="status_order"
                id="exampleRadios1" value="{{ $status }}">
                <label class="form-check-label" for="exampleRadios1">
                    {{ $status }}
                </label>
            </div>
            @endforeach
            <button type="submit" id="submit_form" class="btn btn-sm btn-outline-primary">Change</button>
        </form>
    </div>
</div>
@endsection