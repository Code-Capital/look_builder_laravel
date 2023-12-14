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
                                <div class="py-3 text-end">
                                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseLook" role="button"
                                        aria-expanded="true" aria-controls="collapseLook">
                                        <span class="d-flex align-items-center gap-2">
                                            <span>Add new product</span>
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
                                                        <input type="text" name="title" class="form-control"
                                                            placeholder="Title">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <select class="form-select" name="fabric_id">
                                                            <option selected>Select Fabric</option>
                                                            @foreach ($fabrics as $fabric)
                                                                <option value="{{ $fabric->id }}">{{ $fabric->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <input name="layer_image" type="file" class="form-control">
                                                    </div>
                                                </div>


                                                {{-- <div class="col-lg-12">
                                                    <div class="mt-3 text-center ">
                                                        <input type="hidden" name="category_id" id="category_id"
                                                            value="{{ $tabCategory->id }}">
                                                    </div>
                                                </div> --}}
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
                                        {{-- <th>Category</th> --}}
                                        <th>Action</th>
                                        <th>Attributes</th>
                                        <th>Sizes</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td class="table-user">
                                                {{ $product->title }}
                                            </td>
                                            {{-- <td class="table-user">
                                                {{ $product->category->name }}
                                            </td> --}}
                                            <td class="table-action">
                                                <a class="action-icon editProduct" data-product-id="{{ $product->uuid }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <a href="#" class="action-icon delete-product"
                                                    data-product-id="{{ $product->uuid }}">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('customAttributesByProduct', $product->uuid) }}"> <i
                                                        class="mdi mdi-eye"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('sizesOfCustomProduct', $product->uuid) }}"><i
                                                        class="mdi mdi-eye"></i></a>
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
