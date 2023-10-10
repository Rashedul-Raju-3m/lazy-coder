<ul class="sidebar-menu scrollable position-relative pt-3">

        <li class="nav-item dropdown">
            <a class="nav-link wave-effect" href="{{route('admin-dashboard', app()->getLocale())}}">
              <span class="icon-holder">
                <i class="fas fa-home"></i>
              </span>
                <span class="title">
                   {{ __('messages.dashboard') }}
                </span>
            </a>
        </li>


    @if(Module::has('Exam'))
        @include('exam::layouts.nav')
    @endif


    @can('CORE')
    <li class="nav-item dropdown">
        <a class="nav-link wave-effect" href="{{route('role_list', app()->getLocale())}}">
              <span class="icon-holder">
                <i class="fas fa-sitemap"></i>
              </span>
            <span class="title">
                   {{ __('messages.role') }}
                </span>
        </a>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link wave-effect" href="{{route('user_list', app()->getLocale())}}">
                  <span class="icon-holder">
                    <i class="far fa-user"></i>
                  </span>
            <span class="title">
                       {{ __('messages.userMenu') }}
                    </span>
        </a>
    </li>
    @endcan


</ul>
