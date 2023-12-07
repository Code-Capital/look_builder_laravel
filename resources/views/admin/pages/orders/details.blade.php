@extends('admin.layout.master')
@section('content')
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                @foreach ($orderProducts as $product)
                    {{-- @php
                        dd($product->lookBuilderProduct);
                    @endphp --}}
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card text-black">
                            <div class="card-body">
                                <img src="{{ asset('images/look_builder_products/product_images/' . $product->lookBuilderProduct->product_image) }}"
                                    class="card-img-top" alt="Apple Computer" />

                                <div class="text-center pt-2">
                                    <h5 class="card-title">{{ $product->lookBuilderProduct->title }}</h5>
                                    <p class="text-muted mb-4">{{ $product->lookBuilderProduct->description }}</p>
                                </div>
                                <div>
                                    <div class="d-flex justify-content-between">
                                        <span>Color</span><span>{{ $product->lookBuilderProduct->color }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Size</span><span>{{ $product->size }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Category</span><span>{{ $product->lookBuilderProduct->category->name }}</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between total font-weight-bold mt-4">
                                    <span>Price</span><span>€{{ $product->lookBuilderProduct->price }}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach



            </div>
        </div>
    </section>
@endsection
