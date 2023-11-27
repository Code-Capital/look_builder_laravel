@extends('admin.layout.master')
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h2 class="page-title">Orders</h2>
                    </div>
                </div>
            </div>
            <!-- end page title -->



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
                                        <th>Delivery date</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ $order->user->email }}</td>
                                            <td>{{ $order->user->phone }}</td>
                                            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. officia
                                                perferendis.</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td><a href="{{ route('order_details', $order->uuid) }}"
                                                    class="btn btn-primary btn-sm">See Details</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div> <!-- end row-->
        </div> <!-- container -->



    </div>
@endsection
