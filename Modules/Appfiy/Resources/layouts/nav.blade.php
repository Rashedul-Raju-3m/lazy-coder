{{--<div class="nav-group {{ Request::is(app()->getLocale().'/exam/result/*') ? 'show' : ''}}{{ Request::is(app()->getLocale().'/exam/exam/*') ? 'show' : ''}}{{ Request::is(app()->getLocale().'/exam/schedule/*') ? 'show' : ''}}{{ Request::is(app()->getLocale().'/exam/question/*') ? 'show' : ''}}{{ Request::is(app()->getLocale().'/exam/employee/*') ? 'show' : ''}}{{ Request::is(app()->getLocale().'/exam/location/*') ? 'show' : ''}}{{ Request::is(app()->getLocale().'/exam/project/*') ? 'show' : ''}}{{ Request::is(app()->getLocale().'/exam/guideline/*') ? 'show' : ''}}{{ Request::is(app()->getLocale().'/exam/desig/pbs/dept/*') ? 'show' : ''}}">--}}
<div class="nav-group">
{{--    <div class="nav-group-label"  style="font-size: 15px !important;">{{__('exam::messages.exam')}}</div>--}}
    <div class="nav-group-label"  style="font-size: 15px !important;">Test</div>
    <ul class="nav-sidebar">
        <li class="nav-item ">
{{--            <a href="{{route('exam_result_list', app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/exam/result/new/*') ? 'active' : ''}}{{ Request::is(app()->getLocale().'/exam/result/*') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>{{__('exam::messages.result')}}</span></a>--}}
            {{--<a href="{{route('result_list', app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/exam/result/*') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>{{__('exam::messages.result')}}</span></a>--}}
{{--            <a href="{{route('schedule_list', app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/exam/schedule/*') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>{{__('exam::messages.schedule')}}</span></a>--}}
{{--            <a href="{{route('exam_list', app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/exam/exam/*') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>{{__('exam::messages.exam')}}</span></a>--}}

{{--            <a href="{{route('question_list', app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/exam/question/*') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>Question Bank</span></a>--}}
{{--            <a href="{{route('employee_list', app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/exam/employee/*') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>{{__('exam::messages.employee')}}</span></a>--}}
{{--            <a href="{{route('location_list', app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/exam/location/*') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>{{__('exam::messages.location')}}</span></a>--}}
{{--            <a href="{{route('project_list', app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/exam/project/*') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>{{__('exam::messages.project')}}</span></a>--}}
{{--            <a href="{{route('guideline_list', app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/exam/guideline/*') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>{{__('exam::messages.guideline')}}</span></a>--}}
{{--            <a href="{{route('desig_pbs_dept_list', app()->getLocale())}}" class="nav-link {{ Request::is(app()->getLocale().'/exam/desig/pbs/dept/*') ? 'active' : ''}}"><i data-feather="arrow-right"></i><span>{{__('exam::messages.desigPBSDept')}}</span></a>--}}
        </li>
    </ul>
</div>

<div class="nav-group {{--{{ Request::is(app()->getLocale().'/user/*') ? 'show' : ''}}--}}">
    <div class="nav-group-label" style="font-size: 15px !important;">{{__('messages.component')}}</div>
    <ul class="nav-sidebar">
        <li class="nav-item ">
            <a href="{{--{{route('user_add', app()->getLocale())}}--}}" class="nav-link {{--{{ Request::is(app()->getLocale().'/user/create') ? 'active' : ''}}--}}"><i data-feather="arrow-right"></i><span>{{__('messages.newComponent')}}</span></a>
            <a href="{{--{{route('user_list', app()->getLocale())}}--}}" class="nav-link {{--{{ Request::is(app()->getLocale().'/user/list') ? 'active' : ''}}--}}"><i data-feather="arrow-right"></i><span>{{__('messages.listComponent')}}</span></a>
        </li>
    </ul>
</div>
