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
                                        <th>Product Name</th>
                                        <th>Attributes</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td class="table-user">
                                                {{ $product->title }}
                                            </td>
                                            <td>
                                                <a href="{{ route('attributesByProduct', $product->uuid) }}"
                                                    class="btn btn-primary btn-sm">Attributes</a>
                                            </td>
                                            <td class="table-action">
                                                <a class="action-icon editProduct" data-product-id="{{ $product->uuid }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <a href="#" class="action-icon delete-product"
                                                    data-product-id="{{ $product->uuid }}">
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
    @include('admin.modals.deleteProduct')
    @include('admin.modals.editProduct')
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/custom/product.js') }}"></script>
@endpush
