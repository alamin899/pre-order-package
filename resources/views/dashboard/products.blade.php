<!-- resources/views/dashboard.blade.php -->
@extends('preorder::dashboard-layout')

@section('title', 'Products')

@section('page-title', 'Products')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <form action="{{ route('dashboard.products') }}" method="GET" class="w-100 d-flex align-items-center">
                <input type="text" id="tableSearch" name="query" class="form-control" style="margin-right: 10px !important;" placeholder="Search in the table..." value="{{ request()->get('query') }}">

                <select name="column" class="form-control mr-2" style="margin-right: 10px !important;">
                    <option value="">Select Column</option>
                    <option value="id" {{ request()->get('column') == 'id' ? 'selected' : '' }}>ID</option>
                    <option value="name" {{ request()->get('column') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="price" {{ request()->get('column') == 'price' ? 'selected' : '' }}>Price</option>
                </select>

                <select name="orderby" class="form-control" style="margin-right: 10px !important;">
                    <option value="">Select Order</option>
                    <option value="desc" {{ request()->get('orderby') == 'desc' ? 'selected' : '' }}>Descending</option>
                    <option value="asc" {{ request()->get('orderby') == 'asc' ? 'selected' : '' }}>Ascending</option>
                </select>

                <button id="searchButton" type="submit" class="btn btn-primary">Search</button>
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

