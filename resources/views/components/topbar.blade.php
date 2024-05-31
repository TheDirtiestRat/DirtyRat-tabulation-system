<nav class=" text-light grd-tb-bg navbar navbar-expand-lg navbar-dark w-100 rounded-4 rounded-top shadow p-3 mb-3">
    <div class="container-fluid p-0">
        <!-- sidebar button -->
        <button class="btn btn-primary" id="sidebarToggle">
            <i class="bi bi-list-task"></i>
        </button>
        
        <!-- user logout -->
        <button class="navbar-toggler p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list-task"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ms-auto gap-2 mt-2 mt-lg-0 float-md-end ">
                <li class="nav-item dropdown justify-content-between">
                    <a href="#" class=" text-decoration-none">
                        <button class="btn btn-outline-light rounded-3 w-100" type="button">{{ Auth::user()->name }}</button>
                    </a>
                </li>
                <li class="nav-item dropdown justify-content-between">
                    <form action="{{ url('logoutUser') }}" method="post">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-secondary rounded-3 w-100" type="submit">
                            Log-out
                            <i class="bi bi-power"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
