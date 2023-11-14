@extends('admin.layout.master')
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h2 class="page-title">Fabrics</h2>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="py-3 text-end">
                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseLook" role="button"
                            aria-expanded="true" aria-controls="collapseLook">
                            <span class="d-flex align-items-center gap-2">
                                <span>Add new fabric</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 256 256">
                                    <path fill="currentColor"
                                        d="M228 128a12 12 0 0 1-12 12h-76v76a12 12 0 0 1-24 0v-76H40a12 12 0 0 1 0-24h76V40a12 12 0 0 1 24 0v76h76a12 12 0 0 1 12 12Z">
                                    </path>
                                </svg>
                            </span>

                        </a>
                    </div>
                    <div class="collapse bg-light p-3 rounded-3 my-3" id="collapseLook" style="">
                        <div class=" bg-transparent">
                            <div class="row mx-0">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="">Title</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="">Product Image</label>
                                        <input type="file" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="">Price</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="">Composition</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="">Weight</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="">Season</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="">Woven By</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="">Fabric Code</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="selection-datatable"
                                class="lookBuilderTable table table-striped dt-responsive nowrap w-100 align-middle">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Product Image</th>
                                        <th>Price</th>
                                        <th>Composition</th>
                                        <th>Weight</th>
                                        <th>Season</th>
                                        <th>Woven By</th>
                                        <th>Fabric Code</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fabrics as $fabric)
                                        <tr>
                                            <td>{{ $fabric->name }}</td>
                                            <td>
                                                <img width="80" height="60"
                                                    src="{{ asset('images/fabrics/' . $fabric->image) }}" alt="no-image">
                                            </td>
                                            <td>{{ $fabric->price }}</td>
                                            <td>{{ $fabric->composition }}</td>
                                            <td>{{ $fabric->weight }}</td>
                                            <td>{{ $fabric->season }}</td>
                                            <td>{{ $fabric->woven_by }}</td>
                                            <td>{{ $fabric->fabric_code }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div> <!-- end row-->
        </div> <!-- container -->

    </div> <!-- content -->
@endsection
