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
{{--                        <a href="{{route('layout_type_properties_list', app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/appfiy/component/create') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>{{__('appfiy::messages.layoutTypeProperties')}}</span></a>--}}
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


            <div class="nav-group {{ Request::is(app()->getLocale().'/appfiy/theme/*') ? 'show' : ''}}">
                <div class="nav-group-label" style="font-size: 15px !important;">{{__('appfiy::messages.Theme')}}</div>
                <ul class="nav-sidebar">
                    <li class="nav-item ">
                        <a href="{{route('theme_list',app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/appfiy/theme/list') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>{{__('appfiy::messages.themeList')}}</span></a>
                    </li>
                </ul>
            </div>


            <div class="nav-group {{ Request::is(app()->getLocale().'/appfiy/style/group/*') ? 'show' : ''}}">
                <div class="nav-group-label" style="font-size: 15px !important;">{{__('appfiy::messages.styleGroup')}}</div>
                <ul class="nav-sidebar">
                    <li class="nav-item ">
                        <a href="{{route('style_group_list',app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/appfiy/style/group/list') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>{{__('appfiy::messages.styleGroupList')}}</span></a>
                    </li>
                </ul>
            </div>
        @endif


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

