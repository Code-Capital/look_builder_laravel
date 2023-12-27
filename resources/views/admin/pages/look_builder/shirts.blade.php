@extends('admin.layout.master')
@section('title', 'DTAIL | Products')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h2 class="page-title">{{ $tabCategory->name }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="py-3 text-end">
                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseLook" role="button"
                            aria-expanded="true" aria-controls="collapseLook">
                            <span class="d-flex align-items-center gap-2">
                                <span>Add new {{ $tabCategory->name }}</span>
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
                            <form id="addLookBuilderProduct" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mx-0">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <input type="text" name="title" class="form-control" placeholder="Title">
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-4">
                                        <div class="mb-3">
                                            <select class="form-select" name="fabric_id">
                                                <option selected>Select Fabric</option>
                                                @foreach ($fabrics as $fabric)
                                                    <option value="{{ $fabric->id }}">{{ $fabric->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <input name="product_image" type="file" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <input name="layer_image" type="file" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <input name="color" type="text" class="form-control" placeholder="Color">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <input name="price" type="text" class="form-control" placeholder="Price">
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div>
                                            <textarea name="description" placeholder="description" class="form-control" id="example-textarea" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mt-3 text-center ">
                                            <input type="hidden" name="category_id" id="category_id"
                                                value="{{ $tabCategory->id }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mt-3 text-center ">
                                            <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                                        </div>
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
                                        <th>Title</th>
                                        <th>Product Image</th>
                                        <th>Layer Image</th>
                                        <th>Color</th>
                                        <th>Price</th>
                                        <th>Desc</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->title }}</td>
                                            <td>
                                                <img width="80" height="60"
                                                    src="{{ asset('images/look_builder_products/product_images/' . $product->product_image) }}"
                                                    alt="no-image">
                                            </td>
                                            <td>
                                                <img width="80" height="60"
                                                    src="{{ asset('images/look_builder_products/layer_images/' . $product->layer_image) }}"
                                                    alt="no-image">
                                            </td>
                                            <td>{{ $product->color }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->description }}</td>

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
    <script src="{{ asset('assets/js/custom/look_builder_product.js') }}"></script>
    <script src="{{ asset('assets/js/custom/product.js') }}"></script>
@endpush
