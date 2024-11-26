<!-- resources/views/dashboard.blade.php -->
@extends('preorder::dashboard-layout')

@section('title', 'Products')

@section('page-title', 'Products')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <input type="text" id="tableSearch" class="form-control mr-3" placeholder="Search in the table...">
            <button id="searchButton" class="pl-2 btn btn-primary">Search</button>
        </div>
        <div class="card-body">
            <!-- Table -->
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody id="tableBody">
                @foreach ($products as $index => $product)
                    <tr>
                        <td>{{ $products->firstItem() + $index }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
