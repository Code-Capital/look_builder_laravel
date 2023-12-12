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
                            <ul class="nav nav-tabs nav-bordered mb-3">
                                <li class="nav-item">
                                    <a href="#input-types-code" data-bs-toggle="tab" aria-expanded="true"
                                        class="nav-link active">
                                        {{ $product->title ?? $category->name }} sizes
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#input-types-preview" data-bs-toggle="tab" aria-expanded="false"
                                        class="nav-link ">
                                        New {{ $product->title ?? $category->name }} sizes
                                    </a>
                                </li>
                            </ul>
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
                                            @foreach ($attributes as $attribute)
                                                <tr>
                                                    <td>{{ $attribute->name }}</td>
                                                    <td class="table-action">
                                                        <a class="action-icon editAttribute"
                                                            data-attribute-id="{{ $attribute->uuid }}">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <a class="action-icon delete-product deleteAttribute"
                                                            data-attribute-id="{{ $attribute->uuid }}">
                                                            <i class="mdi mdi-delete"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('option.by.attr', $attribute->uuid) }}"
                                                            class="btn btn-primary btn-sm ">View
                                                            Option</a>
                                                    </td>
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
                                    <form id="addAttributeForm" method="POST" action="{{ route('attribute.store') }}">
                                        @csrf
                                        <input type="hidden" name="look_builder_product_id"
                                            value="{{ $product->id ?? $category->id }}">
                                        <div class="input-rows">
                                            <div class="row mb-3">
                                                <div class="col-lg-4 appendCol">
                                                    <input name='name[]' type='text' class='form-control mb-2'
                                                        placeholder='Name'>
                                                    <input name='description[]' type='text' class='form-control mb-2'
                                                        placeholder='Description'>
                                                </div>
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
    @include('admin.modals.addOption')
    @include('admin.modals.editAttribute')
    @include('admin.modals.deleteAttribute')
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/custom/attribute.js') }}"></script>
    <script src="{{ asset('assets/js/custom/option.js') }}"></script>
@endpush
