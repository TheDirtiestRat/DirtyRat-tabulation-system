<nav class=" text-bg-light navbar navbar-expand-lg navbar-light w-100 rounded-4 rounded-top shadow pt-3 pb-3 mb-3">
    <div class="container-fluid">
        <!-- sidebar button -->
        <button class="btn btn-danger" id="sidebarToggle">
            <i class="bi bi-list-task"></i>
        </button>
        
        <!-- user logout -->
        <button class="navbar-toggler p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list-task"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ms-auto gap-2 mt-2 mt-lg-0 float-end float-md-none">
                <li class="nav-item dropdown justify-content-between">
                    <a href="#" class=" text-decoration-none">
                        <button class="btn rounded-3 text-dark" type="button">{{ Session::get('Judge_user')[0]->firstname .' '. Session::get('Judge_user')[0]->lastname }}</button>
                    </a>
                </li>
                <li class="nav-item dropdown justify-content-between">
                    <form action="{{ url('logoutJudge') }}" method="post">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-secondary rounded-3" type="submit">
                            Logout
                            <i class="bi bi-power"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
