@php
    $categories = App\Models\Category::all();
@endphp
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ route('dashboard') }}" class="logo logo-light">
        <span class="logo-lg  ">
            <div class="d-flex align-items-center gap-2">
                <img class="logoImage" src="{{ asset('assets/images/logo.png') }}" alt="small logo">
                <span class="text-white h2">DTAIL</span>
            </div>

        </span>
        <span class="logo-sm">
            <div class="d-flex align-items-center gap-2">
                <img class="logoImage" src="{{ asset('assets/images/logo.png') }}" alt="small logo">
                <span class="text-white h2">DTAIL</span>
            </div>
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="index" class="logo logo-dark">
        <span class="logo-lg align-items-center">
            <div class="d-flex align-items-center gap-2">
                <img class="logoImage" src="{{ asset('assets/images/logo.png') }}" alt="small logo">
                <span class="text-white h2">DTAIL</span>
            </div>
        </span>
        <span class="logo-sm">
            <div class="d-flex align-items-center gap-2">
                <img class="logoImage" src="{{ asset('assets/images/logo.png') }}" alt="small logo">
                <span class="text-white h2">DTAIL</span>
            </div>
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!-- Leftbar User -->
        <div class="leftbar-user">
            <a href="pages-profile">
                <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image" height="42"
                    class="rounded-circle shadow-sm">
                <span class="leftbar-user-name mt-2">Dominic Keller</span>
            </a>
        </div>

        <!--- Sidemenu -->
        <ul class="side-nav">
            <li class="side-nav-item">
                <a href="{{ route('dashboard') }}" aria-expanded="false" aria-controls="sidebarDashboards"
                    class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>

            </li>

            <li class="side-nav-item">
                <a href="{{ route('orders') }}" aria-expanded="false" aria-controls="sidebarDashboards"
                    class="side-nav-link">
                    <i class="uil-box"></i>
                    <span> Orders </span>
                </a>

            </li>

            <li class="side-nav-item">
                <a href="{{ route('customers') }}" aria-expanded="false" aria-controls="sidebarDashboards"
                    class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Customers </span>
                </a>
            </li>
            {{-- <li class="side-nav-item">
                <a href="{{ route('wedding_planner') }}" aria-expanded="false" aria-controls="sidebarDashboards"
                    class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Wedding Planner </span>
                </a>

            </li> --}}
            <li class="side-nav-item">
                <a href="{{ route('categories') }}" aria-expanded="false" aria-controls="sidebarDashboards"
                    class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Categories </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false"
                    aria-controls="sidebarEcommerce" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span> Look Builder </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce">
                    <ul class="side-nav-second-level">
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('productByCategory', $category->uuid) }}"> {{ $category->name }}</a>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{ route('suit.list') }}">Suits</a>
                        </li>
                    </ul>

                </div>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('customProducts') }}" aria-expanded="false" aria-controls="sidebarDashboards"
                    class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Custom Products </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('customSuit.list') }}" aria-expanded="false" aria-controls="sidebarDashboards"
                    class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Custom Suits </span>
                </a>
            </li>

            {{-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEcommerce2" aria-expanded="false"
                    aria-controls="sidebarEcommerce" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span> Custom Products </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce2">
                    <ul class="side-nav-second-level">
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('customProductByCategory', $category->uuid) }}">
                                    {{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li> --}}
            {{-- <li class="side-nav-item">
                <a href="{{ route('suit.all') }}" aria-expanded="false" aria-controls="sidebarDashboards"
                    class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Suits </span>
                </a>
            </li> --}}
            <li class="side-nav-item">
                <a href="{{ route('fabrics') }}" aria-expanded="false" aria-controls="sidebarDashboards"
                    class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Fabrics </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('look_builder_models.list') }}" aria-expanded="false"
                    aria-controls="sidebarDashboards" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> LB Models </span>
                </a>
            </li>
            {{-- <li class="side-nav-title">Settings</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarTasks" aria-expanded="false" aria-controls="sidebarTasks"
                    class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span> Products Settings </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarTasks">
                    <ul class="side-nav-second-level">

                        <li>
                            <a href="{{ route('allProducts') }}">Look Builder Products</a>
                        </li>
                        <li>
                            <a href="{{ route('customProducts') }}">Custom Products</a>
                        </li>
                        <li>
                            <a href="{{ route('suit.all') }}">Suits</a>
                        </li>
                        <li>
                            <a href="{{ route('fabrics') }}">Fabrics</a>
                        </li>
                        <li>
                            <a href="{{ route('look_builder_models.list') }}">LB Models</a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarTasks2" aria-expanded="false"
                    aria-controls="sidebarTasks" class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span> General Settings </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarTasks2">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('profile') }}">My Account</a>
                        </li>
                    </ul>
                </div>
            </li>


        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
