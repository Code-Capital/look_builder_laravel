@extends('admin.layout.master')
@section('meta_description', 'This is the meta description for the home page.')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Dashboard</h4>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">
                                        Customers</h5>
                                    <h3 class="mt-3 mb-3">{{ $customers }}</h3>
                                    <p class="mb-0 text-muted">
                                        {{-- <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i>
                                                5.27%</span>
                                            <span class="text-nowrap">Since last month</span> --}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-cart-plus widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Orders</h5>
                                    <h3 class="mt-3 mb-3">{{ $orders }}</h3>
                                    <p class="mb-0 text-muted">
                                        {{-- <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i>
                                                1.08%</span>
                                            <span class="text-nowrap">Since last month</span> --}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-currency-usd widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Look Builder Products
                                    </h5>
                                    <h3 class="mt-3 mb-3">{{ $lookBuilderProducts }}</h3>
                                    {{-- <p class="mb-0 text-muted">
                                        <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                                        <span class="text-nowrap">Since last month</span>
                                    </p> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-pulse widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Growth">Suits</h5>
                                    <h3 class="mt-3 mb-3">{{ $suits }}</h3>
                                    {{-- <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 4.87%</span>
                                        <span class="text-nowrap">Since last month</span>
                                    </p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
