@extends('admin.layout.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                        </div>
                        <h4 class="page-title">Product Definitions</h4>
                    </div>
                </div>
            </div>
            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomSizeModal">
                Launch demo modal
            </button> --}}
            <button type="button" class="btn btn-primary btn-sm addSize" data-bs-size="{{ $custom_product->uuid }}">Add
                Size</button>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="input-types-code">
                                    <table class="table table-sm table-striped table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Size</th>
                                                <th>Action</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sizes as $size)
                                                <tr>
                                                    <td>{{ $size->name }}</td>
                                                    <td class="table-action">
                                                        <a class="action-icon editAttribute"
                                                            data-attribute-id="{{ $size->uuid }}">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <a class="action-icon delete-product deleteAttribute"
                                                            data-attribute-id="{{ $size->uuid }}">
                                                            <i class="mdi mdi-delete"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('option.by.attr', $size->uuid) }}"
                                                            class="btn btn-primary btn-sm ">View
                                                            Option</a>
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
        </div>
    </div>
    @include('admin.modals.custom.addSize')
    @include('admin.modals.addOption')
    @include('admin.modals.editAttribute')
    @include('admin.modals.deleteAttribute')
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/custom/attribute.js') }}"></script>
    <script src="{{ asset('assets/js/custom/option.js') }}"></script>
    <script src="{{ asset('assets/js/custom/customSize.js') }}"></script>
@endpush
