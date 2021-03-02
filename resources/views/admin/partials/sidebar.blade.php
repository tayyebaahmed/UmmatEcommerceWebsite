<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link @if(request()->url() == route('admin.dashboard')){{'active'}} @endif" href="{{ route('admin.dashboard') }}">
                <i class="fa fa-cog" aria-hidden="true"></i>&nbsp;
                    Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link @if(request()->url() == route('order.index')){{'active'}} @endif" href="{{ url('/admin/orders') }}">
                <i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp;
                    Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->url() == route('admin.product.index')){{'active'}} @endif" href="{{ route('admin.product.index') }}">
                <i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;
                    Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->url() == route('admin.category.index')){{'active'}} @endif " href="{{ route('admin.category.index') }}">
                <i class="fa fa-sitemap" aria-hidden="true"></i>&nbsp;
                    Categories
                </a>
            </li>
            <li class="nav-item dropdown show">
                <a class="nav-link  @if(request()->url() == route('admin.profile.index')){{'active'}} @endif " href="{{ route('admin.profile.index') }}" >
                <i class="fa fa-users" aria-hidden="true"></i>&nbsp;
                Customers
                </a>
            </li>
        </ul>
    </div>
</nav>

<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
