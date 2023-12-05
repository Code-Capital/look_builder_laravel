@extends('admin.layout.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h2 class="page-title">Suits</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="py-3 text-end">
                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseLook" role="button"
                            aria-expanded="true" aria-controls="collapseLook">
                            <span class="d-flex align-items-center gap-2">
                                <span>Add new Suit</span>
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
                            <form id="addSuit" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mx-0">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <input type="text" name="title" class="form-control" placeholder="Title">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <input name="product_image" type="file" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <select class="form-select" aria-label="Default select example" name="shirt_id">
                                            <option selected>Select Shirt</option>
                                            @foreach ($jackets as $jacket)
                                                <option value="{{ $jacket->id }}">{{ $jacket->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <select class="form-select" aria-label="Default select example" name="trouser_id">
                                            <option selected>Select Trouser</option>
                                            @foreach ($trousers as $trouser)
                                                <option value="{{ $trouser->id }} ">{{ $trouser->title }}</option>
                                            @endforeach
                                        </select>
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
                                        <th>Jacket Image</th>
                                        <th>Trouser Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suits as $suit)
                                        <tr>
                                            <td>{{ $suit->title }}</td>
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
    <script src="{{ asset('assets/js/custom/suit.js') }}"></script>
@endpush
