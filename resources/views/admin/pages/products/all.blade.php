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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td class="table-user">
                                                {{ $product->title }}
                                            </td>
                                            <td class="table-action">
                                                <a href="{{ route('attributesByProduct', $product->uuid) }}"
                                                    class="action-icon">
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
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.delete-product').click(function(e) {
                e.preventDefault();

                var productId = $(this).data('product-id');

                $.ajax({
                    type: 'DELETE',
                    url: '/all_products/delete/' + productId,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "product_id": productId
                    },
                    success: function(response) {
                        toastr.options = {
                            progressBar: true,
                            closeButton: true,
                            timeOut: 2000,
                        };
                        if (response.status == true) {
                            toastr.success(response.message, "Success");
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            toastr.error(response.message, "Error");
                        }
                    },
                    error: function(data) {
                        const errorMessages = Object.values(
                            errors?.responseJSON?.errors
                        ).flat();
                        toastr.options = {
                            progressBar: true,
                            closeButton: true,
                        };
                        for (let i = 0; i < errorMessages.length; i++) {
                            toastr.error(errorMessages[i], "Error");
                        }
                    }
                });
            });
        });
    </script>
@endpush
