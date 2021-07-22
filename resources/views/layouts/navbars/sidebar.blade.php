<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white " id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">з
                        <h6 class="text-overflow m-0">{{ __('Ласкаво просимо!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col collapse-close ml-auto">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>

            </form>
            @if(!empty(app('supervisors_school')[0]))
                {{--@if(count(app('supervisors_school')) == 1 )
                    <p>{{app('supervisors_school')[0]->title}}</p>-->
                    @else--}}
                <div class="dropdown show">
                <a class="btn btn-outline-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fort-awesome"></i> Виберіть школу
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    @foreach(app('supervisors_school') as $s)
                        <a class="dropdown-item" href="{{ url('admin/changeschool/' . $s->id) }}">
                            <i class="fa fa-fort-awesome"></i>{{$s->title}}</a>
                    @endforeach
                </div>
            </div>
                @endif


            <!-- Navigation -->

            <ul class="navbar-nav" id="navnav">
                <li class="nav-item">
                  <div class="text-center">
                      <h2 class="pink h4 text-center text-uppercase">  "{{app('currentSchool')->title ?? 'Виберіть школу'}}"</h2>
                  </div>
                </li>

               {{--@canany('admin')
                @if ($user2 ?? ''=='admin')
               --}}

                @if (Auth::user()->isAdmin())
                <li class="nav-item">

                    <a class="nav-link" id="testlink" href="{{ route('users.index') }}">
                        <i class="fa fa-user" aria-hidden="true"></i> {{ __('Користувачі') }}
                    </a>
                </li>
                        {{-- <li class="nav-item">

                        <a class="nav-link" href="{{ route('contacts.index') }}">
                            <i class="fa fa-user" aria-hidden="true"></i> {{ __('Відправка запрошення на email') }}
                        </a>
                    </li>--}}
                {{--@endcanany
                    @endif
                --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{route('schools.index')}}">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i> {{ __('Школи') }}
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{route('dances.index')}}">
                        <i class="fa fa-music"></i>{{ __('Танці') }}
                    </a>
                </li>
                
               {{--<li class="nav-item">
                    <a class="nav-link" href="{{route('teachers.index')}}">
                        <i class="fa fa-users" aria-hidden="true"></i>{{ __('Наша команда') }}
                    </a>
                </li>--}}
                <li class="nav-item">
                    <a class="nav-link" href="{{route('halls.index')}}">
                        <i class="fas fa-vector-square"></i>{{ __('Зали') }}
                    </a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link" href="{{route('news.index')}}">
                        <i class="fa fa-music"></i>{{__('Новини') }}
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{route('masterclasses.index')}}">
                        <i class="fa fa-diamond" aria-hidden="true"></i>{{ __('Майстер-класи') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('choreographers.index')}}">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>{{ __('Хореографи') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('inventories.index')}}">
                        <i class="fa fa-briefcase" aria-hidden="true"></i>{{ __('Одяг-аксесуари') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('dancepartners.index')}}">
                        <i class="fas fa-handshake-o"></i>{{ __('Партнери по танцях') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('feedbacks.index')}}">
                        <i class="fa fa-comment-o"></i>{{ __('Відгуки') }}
                    </a>
                </li>
                <li class="nav-item">
                <div id="sweeties" class="mmenu">
                    <a href="#" class="nav-link title">
                        <i class="fa fa-calendar"></i> Виберіть подію</a>
                    <ul>
                    <li><a class="nav-link" href="{{route('competitions.index')}}">
                            <i class="fa fa-car"></i>{{ __(' Змагання') }} </a></li>
                    <li><a class="nav-link" href="{{route('conquers.index')}}">
                            <i class="fa fa-balance-scale"></i>{{ __(' Конкурси') }} </a></li>
                    <li><a class="nav-link" href="{{route('parties.index')}}">
                            <i class="fa fa-birthday-cake"></i>{{ __(' Вечірки') }} </a></li>
                    </ul>
                    </li>
                   
                    <br>
                </div>

                <script  type="text/javascript">

                    function linklist(what){
                        var selectedopt=what.options[what.selectedIndex];
                        if (document.getElementById && selectedopt.getAttribute("target")=="new")
                            window.open(selectedopt.value);
                        else
                            document.location=selectedopt.value
                        }
                    var nav=document.getElementById('navnav')
                    var el=nav.getElementsByTagName('a');
                    var url=document.location.href;
                        for(var i=0;i<el.length; i++){
                            if (url==el[i].href){
                                el[i].style.color ='mediumvioletred';
                            };
                        };
                       
                </script>
            </ul>



                  


        </div>
    </div>
</nav>




