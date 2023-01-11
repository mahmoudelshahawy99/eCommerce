@extends('layouts.front')

@section('title')
    Checkout
@endsection

@section('content')

    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">
                    Home
                </a> /
                <a href="{{ url('checkout') }}">
                    Checkout
                </a>
            </h6>
        </div>
    </div>

    <div class="container mt-3">
        <form action="{{ url('place-order') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>Basic details</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label for="">First name</label>
                                    <input type="text" name="fname" value="{{ Auth::user()->name }}" class="form-control" placeholder="Enter first name">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Last name</label>
                                    <input type="text" name="lname" value="{{ Auth::user()->lname }}" class="form-control" placeholder="Enter last name">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Email</label>
                                    <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="Enter mail">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Phone number</label>
                                    <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control" placeholder="Enter phone number">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Address 1</label>
                                    <input type="text" name="address1" value="{{ Auth::user()->address1 }}" class="form-control" placeholder="Enter address 1">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Address 2</label>
                                    <input type="text" name="address2" value="{{ Auth::user()->address2 }}" class="form-control" placeholder="Enter address 2">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">City</label>
                                    <input type="text" name="city" value="{{ Auth::user()->city }}" class="form-control" placeholder="Enter city">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">State</label>
                                    <input type="text" name="state" value="{{ Auth::user()->state }}" class="form-control" placeholder="Enter state">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Country</label>
                                    <input type="text" name="country" value="{{ Auth::user()->country }}" class="form-control" placeholder="Enter country">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Zip Code</label>
                                    <input type="text" name="zipcode" value="{{ Auth::user()->zipcode }}" class="form-control" placeholder="Enter zip code">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Order details</h6>
                            <hr>
                            @if($cartItems->count() > 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total = 0; @endphp
                                        @foreach ($cartItems as $item)
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->prod_qty }}</td>
                                            <td>{{ $item->product->selling_price }}</td>
                                        </tr>
                                        @php $total += $item->product->selling_price * $item->prod_qty; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                <h6>Grand Total <span class="float-end">EGP {{ $total }}</span></h6>
                                <hr>
                                <button type="submit" class="btn btn-success w-100">Place Order</button>
                                <input type="hidden" name="total_price" value="{{ $total }}">
                            @else
                                <h3 class="text-center">No products in cart</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
