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
                                    </tr>
                                </thead>


                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>Tiger@gmail.com</td>
                                        <td>+12345678990</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. officia
                                            perferendis.</td>
                                        <td>2011/04/25</td>
                                    </tr>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>Tiger@gmail.com</td>
                                        <td>+12345678990</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. officia
                                            perferendis.</td>
                                        <td>2011/04/25</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div> <!-- end row-->
        </div> <!-- container -->



    </div>
@endsection
