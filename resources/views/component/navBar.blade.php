<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="##">FOOD CART </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active {{ Auth::user()->role == 'waiter' ? 'disabled' : '' }}" aria-current="page"
                        href="{{ route('admin_index') }}">ORDERS MONITOR </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active " aria-current="page" href="{{ route('client_page') }}">MAKE ORDER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active {{ Auth::user()->role == 'waiter' ? 'disabled' : '' }}"
                        aria-current="page" href="{{ route('admin_item') }}">ITEMS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active {{ Auth::user()->role == 'waiter' ? 'disabled' : '' }}"
                        aria-current="page" href="{{ route('admin_profile') }}">PROFILES</a>
                </li>

            </ul>
            <a href="{{ route('logout') }}">logout {{ Auth::user()->name }}</a>
        </div>
    </div>
</nav>

@push('css')
    <style>
        .navbar {
            position: fixed;
        }

    </style>
@endpush
