@extends('layouts.app')

@section('body')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                        <h6>{{__('appfiy::messages.componentList')}}</h6>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group me-2">
                                <a href="{{route('component_add', app()->getLocale())}}" title="" class="module_button_header">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-plus-circle"></i> {{__('appfiy::messages.createNew')}}
                                    </button>
                                </a>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('layouts.message')
                        <form method="post" role="form" id="search-form">
                            <table id="leave_settings" class="table table-bordered datatable table-responsive mainTable text-center">

                                <thead class="thead-dark">
                                <tr>
                                    <th>{{__('appfiy::messages.SL')}}</th>
                                    <th>{{__('appfiy::messages.name')}}</th>
                                    <th>{{__('appfiy::messages.slug')}}</th>
                                    <th>{{__('appfiy::messages.label')}}</th>
                                    <th>{{__('appfiy::messages.iconCode')}}</th>
                                    <th>{{__('appfiy::messages.event')}}</th>
                                    <th>{{__('appfiy::messages.scope')}}</th>
                                    <th scope="col text-center" class="sorting_disabled" rowspan="1" colspan="1" aria-label style="width: 24px;">
                                        <i class="fas fa-cog"></i>
                                    </th>
                                </tr>
                                </thead>

                                @if(isset($components) && count($components)>0)
                                    <tbody>
                                        @php $i=1; @endphp
                                        @foreach($components as $component)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$component->name}}</td>
                                                <td>{{$component->slug}}</td>
                                                <td>{{$component->label}}</td>
                                                <td>{{$component->icon_code}}</td>
                                                <td>{{$component->event}}</td>
                                                <td>{{$component->scope}}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown"><div class="btn-group" role="group"><button id="btnGroupDrop1" type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                                            <ul class="dropdown-menu dropdown-style" aria-labelledby="btnGroupDrop1">
                                                                <li><a title="Edit" class="dropdown-item" href=""><i class="fas fa-edit"></i></a></li>
                                                                <li><a title="View" class="dropdown-item" href=""><i class="fas fa-eye"></i></a></li>
                                                                <li><a title="Delete" class="dropdown-item" onclick="return confirm('Are you sure to delete ?');" href=""><i class="fas fa-trash-alt"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                        @endforeach
                                    </tbody>
                                @endif
                            </table>
                            @if(isset($components) && count($components)>0)
                                <div class=" justify-content-right">
                                    {{ $components->links('layouts.pagination') }}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('footer.scripts')
{{--    <script src="{{Module::asset('appfiy:js/employee.js')}}"></script>--}}
@endsection
