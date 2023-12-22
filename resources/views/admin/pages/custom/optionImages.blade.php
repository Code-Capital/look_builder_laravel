@extends('admin.layout.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h2 class="page-title">{{ $option->name }} Layer Images</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="py-3 text-end">
                    </div>
                    <button type="button" class="btn btn-primary btn-sm addOption"
                        data-bs-attribute="{{ $option->uuid }}">Add
                        Layer Image</button>
                    <div class="card mt-3">
                        <div class="card-body">
                            <table id="selection-datatable"
                                class="lookBuilderTable table table-striped dt-responsive nowrap w-100 align-middle">
                                <thead>
                                    <tr>
                                        <th>Option</th>
                                        <th>Fabric</th>
                                        <th>Layer Image</th>
                                        <th>Sequence</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customImages as $customImage)
                                        <tr>
                                            <td>{{ $customImage->customOption->name }}</td>
                                            <td>{{ $customImage->fabric->name }}</td>
                                            <td>
                                                <img width="80" height="60"
                                                    src="{{ asset('images/custom_products/options/images/' . $customImage->layer_image) }}"
                                                    alt="no-image">
                                            </td>
                                            <td>{{ $customImage->sequence_no }}</td>
                                            <td class="table-action">
                                                <a class="action-icon editOptionImage"
                                                    data-image-id="{{ $customImage->id }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <a class="action-icon deleteOptionImage"
                                                    data-image-id="{{ $customImage->id }}">
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
    @include('admin.modals.custom.addOptionImage')
    @include('admin.modals.custom.editOptionImage')
    @include('admin.modals.custom.deleteOptionImage')
@endsection
@push('scripts')
    {{-- <script src="{{ asset('assets/js/custom/fabric.js') }}"></script> --}}
    <script src="{{ asset('assets/js/custom/custom_option_image.js') }}"></script>
@endpush
