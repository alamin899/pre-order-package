<!-- resources/views/dashboard.blade.php -->
@extends('preorder::dashboard-layout')

@section('title', 'PreOrder')

@section('page-title', 'PreOrder')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <form action="{{ route('dashboard.preorders') }}" method="GET" class="w-100 d-flex">
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
                    <th>Customer</th>
                    <th>Customer Contact</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Data</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableBody">
                @foreach ($preorders as $index => $preorder)
                    <tr>
                        <td>{{ $preorders->firstItem() + $index }}</td>
                        <td>{{ $preorder->customer_name }}</td>
                        <td>{{ $preorder->customer_email }}<br>{{ $preorder->customer_phone }}</td>
                        <td>{{$preorder->quantity}}</td>
                        <td>{{$preorder->total_amount}}</td>
                        <td>{{ \Carbon\Carbon::parse($preorder->created_at)->format('d M Y H:i A') }}</td>
                        <td>
                            <form action="{{ route('dashboard.preorders.destroy', [$preorder->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this pre order?')">
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
                {{ $preorders->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
