<!-- resources/views/dashboard.blade.php -->
@extends('preorder::dashboard-layout')

@section('title', 'Products')

@section('page-title', 'Products')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <form action="{{ route('dashboard.products') }}" method="GET" class="w-100 d-flex">
                <input type="text" id="tableSearch" name="query" class="form-control mr-3" placeholder="Search in the table..." value="{{ request()->get('query') }}">
                <button id="searchButton" type="submit" class="pl-2 btn btn-primary">Search</button>
            </form>
        </div>
        <div class="card-body">
            <!-- Table -->
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableBody">
                @foreach ($products as $index => $product)
                    <tr>
                        <td>{{ $products->firstItem() + $index }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <form action="{{ route('dashboard.product.destroy', [$product->slug]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Destroy</button>
                            </form>
                        </td>
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

