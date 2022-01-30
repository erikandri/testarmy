<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i class="fa fas fa-menu"></i>
    </a>
    <div class="navbar-content">
        <form class="search-form">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i data-feather="search"></i>
                    </div>
                </div>
                <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
            </div>
        </form>
        <ul class="navbar-nav">
            <li class="nav-item dropdown nav-profile">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <img src="{{ url('https://via.placeholder.com/30x30') }}" alt="profile">
                </a>
                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                    <div class="dropdown-header d-flex flex-column align-items-center">
                        <div class="figure mb-3">
                            <img src="{{ url('https://via.placeholder.com/80x80') }}" alt="">
                        </div>
                        <div class="info text-center">
                            <p class="name font-weight-bold mb-0">{{ Auth()->user()->name }}</p>
                            <p class="email text-muted mb-3">{{ Auth()->user()->email }}</p>
                        </div>
                    </div>
                    <div class="dropdown-body">
                        <ul class="profile-nav p-0 pt-3">
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="btn btn-sm">
									<i class="fa fas fa-sign-out-alt" style="width: 30px;"></i>
									Log Out
								</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>

<script type="text/javascript">
    function logout() {
        const form = $('<form action="{{ route('logout') }}" method="POST" style="display: none;">' +
            '<input type="hidden" name="_token" value="{{ csrf_token() }}" readonly />');
        $("body").append(form);
        form.submit();
    }
</script>
