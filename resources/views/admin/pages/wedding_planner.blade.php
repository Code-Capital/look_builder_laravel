@extends('admin.layout.master')
@section('content')
    <div class="content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h2 class="page-title">Wedding Planner</h2>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="py-3 text-end">
                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseLook" role="button"
                            aria-expanded="true" aria-controls="collapseLook">
                            <span class="d-flex align-items-center gap-2">
                                <span>Add New in Shirt</span>
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
                            <div class="row mx-0">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Title">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <input type="file" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Color">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Size">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Price">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div>
                                        <textarea placeholder="description" class="form-control" id="example-textarea" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
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
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>Desc</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shirt</td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>
                                            <img width="40" height="40"
                                                src="{{ asset('assets/images/attributes/long-seleve.avif') }}"
                                                alt="no-image">
                                        </td>
                                        <td>Blue</td>
                                        <td>42</td>
                                        <td>$20</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, atque aut
                                            commodi corporis.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div> <!-- end row-->
        </div>
    </div>
@endsection
