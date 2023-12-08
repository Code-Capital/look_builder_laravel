@extends('admin.layout.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h2 class="page-title">Orders</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="selection-datatable" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Delivery Address</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Order date</th>
                                        <th>Status</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ $order->user->email }}</td>
                                            <td>{{ $order->user->phone }}</td>
                                            <td>{{ $order->user->address }}, {{ $order->user->city }},
                                                {{ $order->user->state }}, {{ $order->user->country }}.</td>
                                            <td>
                                                @if ($order->isDelivered == 0)
                                                    <span class="badge  bg-danger">Not Delivered</span>
                                                @else
                                                    <span class="badge  bg-success ">Delivered</span>
                                                @endif
                                            </td>
                                            <td>{{ $order->amount }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>
                                                <form action="{{ route('markAsDelivered', $order->uuid) }}" method="POST">
                                                    @csrf
                                                    <button type="submit">Mark as delivered</button>
                                                </form>
                                            </td>
                                            <td><a href="{{ route('order_details', $order->uuid) }}"
                                                    class="btn btn-primary btn-sm">See Details</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
