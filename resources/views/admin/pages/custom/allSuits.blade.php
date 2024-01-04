@extends('admin.layout.master')
@section('title', 'DTAIL | Products')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                        </div>
                        <h4 class="page-title">Custom Suit Definitions</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-3">
                                    <h4 class="header-title">All Custom Suits</h4>
                                    <p class="text-muted font-14">
                                        Add Suits and product attributes for the entire system.
                                    </p>
                                </div>
                                <div class="py-3 text-end">
                                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseLook" role="button"
                                        aria-expanded="true" aria-controls="collapseLook">
                                        <span class="d-flex align-items-center gap-2">
                                            <span>Add new suit</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 256 256">
                                                <path fill="currentColor"
                                                    d="M228 128a12 12 0 0 1-12 12h-76v76a12 12 0 0 1-24 0v-76H40a12 12 0 0 1 0-24h76V40a12 12 0 0 1 24 0v76h76a12 12 0 0 1 12 12Z">
                                                </path>
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                                <div class="collapse bg-light p-3 rounded-3 my-3" id="collapseLook" style="">
                                    <div class=" bg-transparent">
                                        <form id="addCustomProduct" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mx-0">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <select class="form-select" name="shirt_id">
                                                            <option selected>Select Shirt</option>
                                                            @foreach ($customProducts as $customProduct)
                                                                <option value="{{ $customProduct->id }}">
                                                                    {{ $customProduct->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <select class="form-select" name="shirt_id">
                                                            <option selected>Select Trouser</option>
                                                            @foreach ($customProducts as $customProduct)
                                                                <option value="{{ $customProduct->id }}">
                                                                    {{ $customProduct->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <select class="form-select" name="shirt_id">
                                                            <option selected>Select Waistcoat</option>
                                                            @foreach ($customProducts as $customProduct)
                                                                <option value="{{ $customProduct->id }}">
                                                                    {{ $customProduct->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="mt-3 text-center ">
                                                        <button class="btn btn-primary btn-sm"
                                                            type="submit">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-sm table-striped table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suits as $suit)
                                        <tr>
                                            <td class="table-user">
                                                {{ $suit->name }}
                                            </td>



                                            <td class="table-action">
                                                <a class="action-icon editProduct" data-product-id="{{ $suit->uuid }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <a href="#" class="action-icon delete-product"
                                                    data-product-id="{{ $suit->uuid }}">
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
    @include('admin.modals.custom.deleteProduct')
    @include('admin.modals.custom.editProduct')
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/custom/custom_product.js') }}"></script>
@endpush
