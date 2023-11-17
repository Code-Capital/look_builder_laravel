@extends('admin.layout.master')
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h2 class="page-title">{{ $attribute->name }} options</h2>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="py-3 text-end">
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <table id="selection-datatable"
                                class="lookBuilderTable table table-striped dt-responsive nowrap w-100 align-middle">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Attribute</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($options as $option)
                                        <tr>
                                            <td>{{ $option->name }}</td>
                                            <td>{{ $option->description }}</td>
                                            <td>
                                                <img width="80" height="60"
                                                    src="{{ asset('images/options/' . $option->image) }}" alt="no-image">
                                            </td>
                                            <td>{{ $option->attribute->name }}</td>

                                            <td class="table-action">
                                                <a class="action-icon editOption" data-option-id="{{ $option->uuid }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <a class="action-icon deleteOption" data-option-id="{{ $option->uuid }}">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </td>
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
    @include('admin.modals.addOption')
    @include('admin.modals.editOption')
    @include('admin.modals.deleteOption')
@endsection
@push('scripts')
    {{-- <script src="{{ asset('assets/js/custom/fabric.js') }}"></script> --}}
    <script src="{{ asset('assets/js/custom/option.js') }}"></script>
@endpush
