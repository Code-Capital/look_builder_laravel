@extends('admin.layout.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                        </div>
                        <h4 class="page-title">Suits Definitions</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-3">
                                    <h4 class="header-title">All Suits</h4>
                                    <p class="text-muted font-14">
                                        Add Suits for the entire system.
                                    </p>
                                </div>
                                {{-- <div class="col-lg-6 mb-3">
                                    <select class="form-select mb-3">
                                        <option selected>Select Fabric</option>
                                        @foreach ($fabrics as $fabric)
                                            <option value="{{ $fabric->id }}">{{ $fabric->name }}</option>
                                        @endforeach

                                    </select>
                                </div> --}}
                            </div>
                            <table class="table table-sm table-striped table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Product Image</th>
                                        <th>Jacket Image</th>
                                        <th>Trouser Image</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suits as $suit)
                                        <tr>
                                            <td class="table-user">
                                                {{ $suit->title }}
                                            </td>
                                            <td>
                                                <img width="80" height="60"
                                                    src="{{ asset('images/suits/product_images/' . $suit->product_image) }}"
                                                    alt="no-image">
                                            </td>
                                            <td>
                                                <img width="80" height="60"
                                                    src="{{ asset('images/look_builder_products/product_images/' . $suit->shirt->product_image) }}"
                                                    alt="no-image">
                                            </td>
                                            <td>
                                                <img width="80" height="60"
                                                    src="{{ asset('images/look_builder_products/product_images/' . $suit->trouser->product_image) }}"
                                                    alt="no-image">
                                            </td>
                                            <td class="table-action">
                                                <a class="action-icon editSuit" data-suit-id="{{ $suit->uuid }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <a href="#" class="action-icon delete-suit"
                                                    data-suit-id="{{ $suit->uuid }}">
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
    @include('admin.modals.deleteSuit')
    @include('admin.modals.editSuit')
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/custom/suit.js') }}"></script>
@endpush
