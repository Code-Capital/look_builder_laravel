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
                            <ul class="nav nav-tabs nav-bordered mb-3">
                                <li class="nav-item">
                                    <a href="#input-types-code" data-bs-toggle="tab" aria-expanded="true"
                                        class="nav-link active">

                                        {{ $product->title }} attributes
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#input-types-preview" data-bs-toggle="tab" aria-expanded="false"
                                        class="nav-link ">
                                        New {{ $product->title }} attributes
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="input-types-code">
                                    <table class="table table-sm table-striped table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Attribute Name</th>
                                                <th>Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($attributes as $attribute)
                                                <tr>
                                                    <td>{{ $attribute->name }}</td>
                                                    <td>Type</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> <!-- end preview code-->
                                <div class="tab-pane  " id="input-types-preview">
                                    <div class="text-end mb-3">
                                        <button id="addBtn" class="btn btn-primary btn-sm py-1 px-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 256 256">
                                                <path fill="currentColor"
                                                    d="M228 128a12 12 0 0 1-12 12h-76v76a12 12 0 0 1-24 0v-76H40a12 12 0 0 1 0-24h76V40a12 12 0 0 1 24 0v76h76a12 12 0 0 1 12 12Z" />
                                            </svg>
                                        </button>
                                        <button id="removeBtn" class="btn btn-primary btn-sm py-1 px-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 256 256">
                                                <path fill="currentColor"
                                                    d="M228 128a12 12 0 0 1-12 12H40a12 12 0 0 1 0-24h176a12 12 0 0 1 12 12Z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <form id="addAttributeForm" method="POST">
                                        @csrf
                                        <input type="hidden" name="look_builder_product_id" value="{{ $product->id }}">
                                        <div class="row ">
                                            <div class="col-lg-4 appendCol">

                                            </div>
                                        </div>
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary btn-sm py-1 px-2">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/custom/attribute.js') }}"></script>
@endpush
