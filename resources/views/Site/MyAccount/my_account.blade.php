@extends('Site.Layouts.app')
@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> My Account
            </div>
        </div>
    </div>
    <section class="pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab"
                                            href="#dashboard" role="tab" aria-controls="dashboard"
                                            aria-selected="false"><i
                                                class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders"
                                            role="tab" aria-controls="orders" aria-selected="false"><i
                                                class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab"
                                            href="#account-detail" role="tab" aria-controls="account-detail"
                                            aria-selected="true"><i class="fi-rs-user mr-10"></i>Account details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('get_logout') }}"><i
                                                class="fi-rs-sign-out mr-10"></i>Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="tab-content dashboard-content">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                    aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Hello Rosie! </h5>
                                        </div>
                                        <div class="card-body">
                                            <p>From your account dashboard. you can easily check &amp; view your <a
                                                    href="" id="ordersBtn">recent orders</a>, manage your profile and <a
                                                    href="" id="accountBtn">edit your
                                                    password and
                                                    account
                                                    details.</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Your Orders</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Order-Number</th>
                                                            <th>Status-Order</th>
                                                            <th>Coupone</th>
                                                            <th>Price</th>
                                                            <th>Date</th>
                                                            <th colspan="2">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($orders as $row => $order)
                                                        <tr>
                                                            <td>{{ $order->order_number }}</td>
                                                            <td>{{ $order->status_order }}</td>
                                                            <td>{{ json_decode($order->coupone)->discount ?? 0}}%
                                                            </td>
                                                            <td>{{ $order->total_price }}</td>
                                                            <td>{{ $order->created_at }}</td>
                                                            <td><a style="font-size: 0.9em" number="{{ $row }}"
                                                                    class="btn-small d-block viewI">View Items</a></td>
                                                            <td><a style="font-size: 0.9em" number="{{ $row }}"
                                                                    class="btn-small d-block viewA">View Address</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="7">
                                                                <div class="table-responsive" id="tableI{{ $row }}"
                                                                    style="display: none">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr class="table-danger">
                                                                                <th>Product-Name</th>
                                                                                <th>Option</th>
                                                                                <th>Quantity</th>
                                                                                <th>Price</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($order->OrderItems as $item)
                                                                            <tr>
                                                                                <td>{{ $item->product_name }}</td>
                                                                                <td>Color:
                                                                                    {{json_decode($item->option)->color
                                                                                    }} ||
                                                                                    Size:
                                                                                    {{json_decode($item->option)->size
                                                                                    }}
                                                                                </td>
                                                                                <td>{{ $item->quantity }}</td>
                                                                                <td>{{ $item->price }}</td>
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="7">
                                                                <div class="table-responsive" id="tableA{{ $row }}"
                                                                    style="display: none">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr class="table-danger">
                                                                                <th>Name</th>
                                                                                <th>Email</th>
                                                                                <th>Phone</th>
                                                                                <th>Address-Name</th>
                                                                                <th>City</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($order->Addresses as $address)
                                                                            <tr>
                                                                                <td>{{ $address->first_name}}
                                                                                    {{$address->last_name}}
                                                                                </td>
                                                                                <td>{{ $address->email }}</td>
                                                                                <td>{{ $address->phone_number }}</td>
                                                                                <td>{{ $address->address_name }}</td>
                                                                                <td>{{ $address->city }}</td>
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td>No Orders ..</td>
                                                        </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="account-detail" role="tabpanel"
                                    aria-labelledby="account-detail-tab">
                                    <div class="card" id="update" style="display: none;
                                        height: 70px;
                                        background: lightgreen;
                                        text-align: center;
                                        font-size: 1.2em;
                                        padding-top: 22px;
                                        color: black;
                                        margin-bottom: 10px;
                                        font-weight: bold;">
                                        Updated Information
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Account Details</h5>
                                        </div>
                                        <div class="card-body">
                                            <form id="form" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>Display Name <span class="required">*</span></label>
                                                        <input class="form-control square" name="name" type="text"
                                                            value="{{ old('name') ?? $user->name}}">
                                                    </div>
                                                    <p class="error_name" class="alert alert-warning" role="alert">
                                                    </p>
                                                    <div class="form-group col-md-12">
                                                        <label>Email Address <span class="required">*</span></label>
                                                        <input class="form-control square" name="email" type="email"
                                                            value="{{ old('email') ?? $user->email}}">
                                                    </div>
                                                    <p class="error_email" class="alert alert-warning" role="alert">
                                                    </p>
                                                    <label>Photo <span class="required">*</span></label>
                                                    <div class="input-group col-md-12">
                                                        <input type="file" name="photo" class="form-control">
                                                    </div>
                                                    <p class="error_photo" class="alert alert-warning" role="alert">
                                                    </p>
                                                    <div class="form-group col-md-12">
                                                        <label>Current Password <span class="required">*</span></label>
                                                        <input class="form-control square" name="cpassword"
                                                            type="password">
                                                    </div>
                                                    <p class="error_cpassword" class="alert alert-warning" role="alert">
                                                    </p>
                                                    <div class="form-group col-md-12">
                                                        <label>New Password <span class="required">*</span></label>
                                                        <input class="form-control square" name="password"
                                                            type="password">
                                                    </div>
                                                    <p class="error_password" class="alert alert-warning" role="alert">
                                                    </p>
                                                    <div class="form-group col-md-12">
                                                        <label>Confirm Password <span class="required">*</span></label>
                                                        <input class="form-control square" name="password_confirmation"
                                                            type="password">
                                                    </div>
                                                    <p class="error_password_confirmation" class="alert alert-warning"
                                                        role="alert">
                                                    </p>
                                                    <div class="col-md-12">
                                                        <button type="submit" id="save" class="btn btn-fill-out submit"
                                                            name="submit" value="Submit">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@push('js')
<script>
    $('#ordersBtn').on('click', function (e) {
        e.preventDefault();
        document.getElementById('orders-tab').click();
    });
    $('#accountBtn').on('click', function (e) {
        e.preventDefault();
        document.getElementById('account-detail-tab').click();
    });
    $('.viewI').each(function () { 
        $(this).on('click', function (e) {
            console.log(this);
        let number = $(this).attr('number');
        $(`#tableI${number}`).slideToggle();
    });
    }); 
    $('.viewA').each(function () { 
        $(this).on('click', function (e) {
            console.log(this);
        let number = $(this).attr('number');
        $(`#tableA${number}`).slideToggle();
    });
    });
    
</script>
<script>
    const route = "{{ route('account.edit') }}";
</script>
<script src="{{ asset('assets/js/AjaxRegister.js') }}"></script>
@endpush