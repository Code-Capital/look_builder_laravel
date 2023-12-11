@extends('admin.layout.master')
@section('title', 'DTAIL | Fabrics')

@section('content')
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h2 class="page-title">Fabrics</h2>
                    </div>
                </div>
            </div>

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
                            <form id="addFabricFrom" method="POST">
                                @csrf
                                <div class="row mx-0">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="">Title</label>
                                            <input type="text" class="form-control" placeholder="" name="title">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="">Product Image</label>
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="">Price</label>
                                            <input type="numeric" class="form-control" placeholder="" name="price">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="">Composition</label>
                                            <input type="text" class="form-control" placeholder="" name="composition">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="">Weight</label>
                                            <input type="text" class="form-control" placeholder="" name="weight">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="">Season</label>
                                            <input type="text" class="form-control" placeholder="" name="season">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="">Woven By</label>
                                            <input type="text" class="form-control" placeholder="" name="woven_by">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="">Fabric Code</label>
                                            <input type="text" class="form-control" placeholder="" name="code">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3 text-center">
                                        <button type="submit" class="btn btn-primary ">Submit</button>
                                    </div>
                                </div>
                            </form>
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
                                        <th>Action</th>
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
                                            <td class="table-action">
                                                <a class="action-icon editFabric" data-fabric-id="{{ $fabric->uuid }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <a class="action-icon delete-fabric" data-fabric-id="{{ $fabric->uuid }}">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </td>
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
    @include('admin.modals.deleteFabric')
    @include('admin.modals.editFabric')
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/custom/fabric.js') }}"></script>
@endpush
