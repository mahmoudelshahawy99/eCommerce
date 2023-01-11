@extends('layouts.admin')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Elshahawy programming</h1>
        </div>
    </div>
    <div class="container">
        <div class="row mb-5">
          <div class="col bg-primary">
            <p class="text-white">Total categories : {{ $categories }}</p>
          </div>
          <div class="col-6 bg-dark">
            <p class="text-white">Total products : {{ $products }}</p>
          </div>
          <div class="col bg-warning">
            <p class="text-dark">Total users : {{ $users }}</p>
          </div>
        </div>
        <div class="row">
          <div class="col bg-info">
            <p class="text-white">Total orders : {{ $orders }}</p>
          </div>
          <div class="col-5 bg-danger">
            <p class="text-white">Completed orders : {{ $completedOrders }}</p>
          </div>
          <div class="col bg-success">
            <p class="text-white">Pending orders : {{ $pendingOrders }}</p>
          </div>
        </div>
      </div>
@endsection
