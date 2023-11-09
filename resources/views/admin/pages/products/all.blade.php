@extends('admin.layout.master')
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                        </div>
                        <h4 class="page-title">Product Definitions</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-3">
                                    <h4 class="header-title">All Products</h4>
                                    <p class="text-muted font-14">
                                        Add Products and product attributes for the entire system.
                                    </p>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <select class="form-select mb-3">
                                        <option selected>Select Fabric</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>



                            <table class="table table-sm table-striped table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="table-user">
                                            Shirts
                                        </td>
                                        <td>Look Builder</td>
                                        <td class="table-action">
                                            <a href="{{ route('custom_product_attribute') }}" class="action-icon"> <i
                                                    class="mdi mdi-pencil"></i></a>
                                            <a href="#" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-user">
                                            Trousers
                                        </td>
                                        <td>Look Builder</td>
                                        <td class="table-action">
                                            <a href="custom-product-attribute" class="action-icon"> <i
                                                    class="mdi mdi-pencil"></i></a>
                                            <a href="#" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-user">
                                            Jackets
                                        </td>
                                        <td>Look Builder</td>
                                        <td class="table-action">
                                            <a href="custom-product-attribute" class="action-icon"> <i
                                                    class="mdi mdi-pencil"></i></a>
                                            <a href="#" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-user">
                                            Shoes
                                        </td>
                                        <td>Look Builder</td>
                                        <td class="table-action">
                                            <a href="custom-product-attribute" class="action-icon"> <i
                                                    class="mdi mdi-pencil"></i></a>
                                            <a href="#" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-user">
                                            Suits
                                        </td>
                                        <td>Custom Made</td>
                                        <td class="table-action">
                                            <a href="custom-product-attribute" class="action-icon"> <i
                                                    class="mdi mdi-pencil"></i></a>
                                            <a href="#" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-user">
                                            Shirts
                                        </td>
                                        <td>Custom Made</td>
                                        <td class="table-action">
                                            <a href="custom-product-attribute" class="action-icon"> <i
                                                    class="mdi mdi-pencil"></i></a>
                                            <a href="#" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div>
    </div>
@endsection
