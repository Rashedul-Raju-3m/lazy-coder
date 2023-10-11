<div class="sidebar">
    <div class="sidebar-header">
{{--        <a href="#" class="sidebar-logo"><img src="{{ asset('exam.png') }}" width="180px" alt=""></a>--}}
        <a href="#" class="sidebar-logo-text">{{ __('messages.LazyCoder') }}<span> </span></a>
    </div><!-- sidebar-header -->
    <div class="sidebar-search">
        <div class="search-body">
            <i data-feather="home"></i>
            <a href="" style="color: #000000b3">Dashboard</a>
            {{--
            <input type="text" class="form-control" placeholder="Search...">--}}
        </div><!-- search-body -->
    </div><!-- sidebar-search -->
    <div class="sidebar-body pt-20">

        @if(Module::has('Appfiy'))

            <div class="nav-group {{ Request::is(app()->getLocale().'/appfiy/layout/type/*') ? 'show' : ''}}">
                <div class="nav-group-label" style="font-size: 15px !important;">{{__('appfiy::messages.layoutType')}}</div>
                <ul class="nav-sidebar">
                    <li class="nav-item ">
                        <a href="{{route('layout_type_list',app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/appfiy/layout/type/list') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>{{__('appfiy::messages.layoutType')}}</span></a>
                        <a href="{{route('layout_type_properties_list', app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/appfiy/component/create') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>{{__('appfiy::messages.layoutTypeProperties')}}</span></a>
                    </li>
                </ul>
            </div>


            <div class="nav-group {{ Request::is(app()->getLocale().'/appfiy/component/*') ? 'show' : ''}}">
                <div class="nav-group-label" style="font-size: 15px !important;">{{__('appfiy::messages.component')}}</div>
                <ul class="nav-sidebar">
                    <li class="nav-item ">
                        <a href="{{route('component_list',app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/appfiy/component/list') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>{{__('appfiy::messages.componentList')}}</span></a>
                        <a href="{{route('component_add', app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/appfiy/component/create') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>{{__('appfiy::messages.createComponent')}}</span></a>
                    </li>
                </ul>
            </div>
        @endif
        {{--@if(Module::has('Exam'))
            @can('EXAM')
                @canany(['CREATE','EDIT','DELETE'])
                    @include('exam::layouts.nav1')
                @endcanany
            @endcan
        @endif--}}

            {{--@can('CORE')
                <div class="nav-group {{ Request::is(app()->getLocale().'/user/*') ? 'show' : ''}}">
                    <div class="nav-group-label" style="font-size: 15px !important;">{{__('messages.userMenu')}}</div>
                    <ul class="nav-sidebar">
                        <li class="nav-item ">
                            <a href="{{route('user_add', app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/user/create') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>New User</span></a>
                            <a href="{{route('user_list', app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/user/list') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>User List</span></a>
                        </li>
                    </ul>
                </div>
            @endcan--}}

            {{--@can('CORE')
                <div class="nav-group {{ Request::is(app()->getLocale().'/role/*') ? 'show' : ''}}">
                    <div class="nav-group-label" style="font-size: 15px !important;">{{ __('messages.role') }}</div>
                    <ul class="nav-sidebar">
                        <li class="nav-item ">
                            <a href="{{route('role_add', app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/role/create') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>New Role</span></a>
                            <a href="{{route('role_list', app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/role/list') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>Role List</span></a>
                        </li>
                    </ul>
                </div>
            @endcan--}}

    </div><!-- sidebar-body -->


    <div class="sidebar-footer">
        <a href="" class="avatar online"><span class="avatar-initial" style="font-size: 15px;">Lazy Coder</span></a>
        <div class="avatar-body">
            <div class="d-flex align-items-center justify-content-between">
                <h6>{{auth()->user()?auth()->user()->name:''}}</h6>
                <a href="" class="footer-menu"><i class="ri-settings-4-line"></i></a>
            </div>
            <span>
                {{--@php
                    $roles = auth()->user()->getRoleNames();
                    foreach ($roles as $role){
                        if (!empty($role)){
                            echo $role.' <br> ';
                        }
                    }
                @endphp--}}
            </span>
        </div><!-- avatar-body -->
    </div><!-- sidebar-footer -->
</div>

