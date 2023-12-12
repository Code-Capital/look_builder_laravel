@extends('admin.layout.master')
@section('title', 'DTAIL | Orders')
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
                                        <th>Change Status</th>
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
                                            <td>
                                                @php
                                                    $dateTime = new DateTime($order->created_at);
                                                    $formattedDate = $dateTime->format('Y-m-d');
                                                @endphp
                                                {{ $formattedDate }}
                                            </td>
                                            <td>
                                                @if ($order->isDelivered == 0)
                                                    {{-- <form id="deliveryForm" method="POST"> --}}
                                                    {{-- @csrf --}}
                                                    <a class="deliverOrder" data-order-id="{{ $order->uuid }}">
                                                        <span style="font-size: 20px;" class="mdi mdi-truck-check"></span>
                                                    </a>
                                                    {{-- <i class="mdi mdi-truck-check" id="submitFormIcon"></i> --}}
                                                    {{-- </form> --}}
                                                @endif
                                            </td>
                                            <td><a href="{{ route('order_details', $order->uuid) }}" class="action-icon"><i
                                                        class="mdi mdi-eye"></i></a></td>
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
    @include('admin.modals.delivered')
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/custom/order.js') }}"></script>
    {{-- <script>
        document.getElementById('submitFormIcon').addEventListener('click', function() {
            document.getElementById('deliveryForm').submit();
        });
    </script> --}}
@endpush
