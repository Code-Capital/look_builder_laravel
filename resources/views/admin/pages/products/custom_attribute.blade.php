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
                            <ul class="nav nav-tabs nav-bordered mb-3">
                                <li class="nav-item">
                                    <a href="#input-types-code" data-bs-toggle="tab" aria-expanded="true"
                                        class="nav-link active">
                                        Shirt Attributes
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#input-types-preview" data-bs-toggle="tab" aria-expanded="false"
                                        class="nav-link ">
                                        New Shirt Attributes
                                    </a>
                                </li>

                            </ul> <!-- end nav-->

                            <div class="tab-content">
                                <div class="tab-pane show active" id="input-types-code">
                                    <table class="table table-sm table-striped table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Attribute Name</th>
                                                <th>Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="table-user">
                                                    Collar
                                                </td>
                                                <td>Look Builder</td>
                                            </tr>
                                            <tr>
                                                <td class="table-user">
                                                    Sleeve
                                                </td>
                                                <td>Look Builder</td>
                                            </tr>
                                            <tr>
                                                <td class="table-user">
                                                    Buttons
                                                </td>
                                                <td>Look Builder</td>
                                            </tr>



                                        </tbody>
                                    </table>
                                </div> <!-- end preview code-->
                                <div class="tab-pane  " id="input-types-preview">
                                    <div class="text-end mb-3">
                                        <button id="addBtn" class="btn btn-primary btn-sm py-1 px-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 256 256">
                                                <path fill="currentColor"
                                                    d="M228 128a12 12 0 0 1-12 12h-76v76a12 12 0 0 1-24 0v-76H40a12 12 0 0 1 0-24h76V40a12 12 0 0 1 24 0v76h76a12 12 0 0 1 12 12Z" />
                                            </svg>
                                        </button>
                                        <button id="removeBtn" class="btn btn-primary btn-sm py-1 px-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 256 256">
                                                <path fill="currentColor"
                                                    d="M228 128a12 12 0 0 1-12 12H40a12 12 0 0 1 0-24h176a12 12 0 0 1 12 12Z" />
                                            </svg>
                                        </button>

                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-4 appendCol">
                                            <input type="text" placeholder="Color" class="form-control disabled mb-3"
                                                disabled readonly>
                                            <input type="text" placeholder="Seleve" class="form-control disabled mb-3"
                                                disabled readonly>
                                            <input type="text" placeholder="Buttons" class="form-control disabled mb-3"
                                                disabled readonly>
                                        </div>
                                    </div>
                                    <div class="text-start">
                                        <a href="custom-product" class="btn btn-primary btn-sm py-1 px-2">
                                            Submit
                                        </a>
                                    </div>
                                    <!-- end row-->
                                </div> <!-- end preview-->
                            </div> <!-- end tab-content-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $("#addBtn").click(function() {
            $(".appendCol").append("<input type='text' class='form-control mb-3'>");
        });

        $("#removeBtn").click(function() {
            $(".appendCol input:last").remove();
        });
    </script>
@endpush
