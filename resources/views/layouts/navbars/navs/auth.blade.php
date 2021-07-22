<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container">
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-4-800x800.jpg">
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span style="color:mediumvioletred;" class="mb-0 text-sm  font-weight-bold ">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu bg-dark dropdown-menu-right">
                    <!-- <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Вітаємо</h6>
                    </div> -->
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('Мій профіль') }}</span>
                    </a>
                   <!-- <div class="dropdown-divider"></div> -->
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>Вийти</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
