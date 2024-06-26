<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('dist_frontend/img/CODIAS.png') }}" alt="" width="50px" class="img-fluid py-2">
        </div>
        <div class="sidebar-brand-text mx-3">MAAD</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ $page == 'dashboard' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin_dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>


    @if (auth()->guard('admin')->check() && auth()->guard('admin')->user()->role == 'Dosen')
        <li class="nav-item {{ $page == 'rekap' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin_rekap_show') }}">
                <i class="fas fa-fw fa-chart-bar"></i>
                <span>Data Summary</span></a>
        </li>
        {{-- <li class="nav-item {{ $page == 'category' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin_category_show') }}">
                <i class="fas fa-fw fa-list"></i>
                <span>Category</span></a>
        </li> --}}
        {{-- <li class="nav-item {{ $page == 'post' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin-post-show') }}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Post</span></a>
        </li> --}}
        <li class="nav-item {{ $page == 'sub-category' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin_subCategory_show') }}">
                <i class="fa fa-file"></i>
                <span>Sub Category</span></a>
        </li>
        <li class="nav-item {{ $page == 'user' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin_user_show') }}">
                <i class="fas fa-users fa-cog"></i> <span>Mahasiswa</span>
                @if ($notif = App\Models\User::where('role', 'pending')->count())
                    <span class="badge badge-danger">
                        {{ $notif }}
                    </span>
                @endif

            </a>
        </li>
    @elseif (auth()->guard('admin')->check() && auth()->guard('admin')->user()->role == 'Dosen Reviewer')
        <li class="nav-item {{ $page == 'rekap' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin_rekap_show') }}">
                <i class="fas fa-fw fa-chart-bar"></i>
                <span>Data Summary</span></a>
        </li>
        {{-- <li class="nav-item {{ $page == 'category' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin_category_show') }}">
                <i class="fas fa-fw fa-list"></i>
                <span>Category</span></a>
        </li> --}}
        {{-- <li class="nav-item {{ $page == 'post' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin-post-show') }}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Post</span></a>
        </li> --}}
        <li class="nav-item {{ $page == 'review_post' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin-review-post') }}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Review Post</span>
                @php
                    $countPost = App\Models\Post::where('status', 'Pending')->count();
                @endphp

                @if ($countPost > 0)
                    <span class="badge badge-danger ml-3">{{ $countPost }}</span>
                @endif
            </a>
        </li>
        <li class="nav-item {{ $page == 'sub-category' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin_subCategory_show') }}">
                <i class="fa fa-file"></i>
                <span>Sub Category</span></a>
        </li>
        <li class="nav-item {{ $page == 'user' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin_user_show') }}">
                <i class="fas fa-users fa-cog"></i> <span>Mahasiswa</span>
                @if ($notif = App\Models\User::where('role', 'pending')->count())
                    <span class="badge badge-danger">
                        {{ $notif }}
                    </span>
                @endif

            </a>
        </li>
    @elseif (auth()->guard('admin')->check() && auth()->guard('admin')->user()->role == 'Admin')
        <li class="nav-item {{ $page == 'rekap' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin_rekap_show') }}">
                <i class="fas fa-fw fa-chart-bar"></i>
                <span>Data Summary</span></a>
        </li>
        <li class="nav-item {{ $page == 'category' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin_category_show') }}">
                <i class="fas fa-fw fa-list"></i>
                <span>Category</span></a>
        </li>

        <li class="nav-item {{ $page == 'price' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin_price_show') }}">
                <i class="fas fa-fw fa-dollar-sign"></i>
                <span>Price</span>
            </a>
        </li>
        {{-- <li class="nav-item {{ $page == 'post' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin-post-show') }}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Post</span></a>
        </li> --}}
        <li class="nav-item {{ $page == 'review_post' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin-review-post') }}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Review Post</span>
                @php
                    $countPost = App\Models\Post::where('status', 'Pending')->count();
                @endphp

                @if ($countPost > 0)
                    <span class="badge badge-danger ml-3">{{ $countPost }}</span>
                @endif
            </a>
        </li>
        <li class="nav-item {{ $page == 'sub-category' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin_subCategory_show') }}">
                <i class="fa fa-file"></i>
                <span>Sub Category</span></a>
        </li>
        <li class="nav-item {{ $page == 'dosen' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin_dosen_show') }}">
                <i class="fas fa-users fa-cog"></i> <span>Dosen</span>

            </a>
        </li>
        <li class="nav-item {{ $page == 'user' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin_user_show') }}">
                <i class="fas fa-users fa-cog"></i> <span>Mahasiswa</span>
                @if ($notif = App\Models\User::where('role', 'pending')->count())
                    <span class="badge badge-danger">
                        {{ $notif }}
                    </span>
                @endif

            </a>
        </li>
    @endif



    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
