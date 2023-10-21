@extends('layouts.app')

@section('body')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                        <h6>{{__('appfiy::messages.styleGroup')}}</h6>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group me-2">
                                {{--<a href="{{route('component_add', app()->getLocale())}}" title="" class="module_button_header">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-plus-circle"></i> {{__('appfiy::messages.createNew')}}
                                    </button>
                                </a>--}}
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
                                    <th>{{__('appfiy::messages.totalProperties')}}</th>
                                    <th>{{__('appfiy::messages.Properties')}}</th>
                                    <th scope="col text-center" class="sorting_disabled" rowspan="1" colspan="1" aria-label style="width: 24px;">
                                        <i class="fas fa-cog"></i>
                                    </th>
                                </tr>
                                </thead>

                                @if(count($styleGroups)>0)
                                    <tbody>
                                        @php $i=1; @endphp
                                        @foreach($styleGroups as $styleGroup)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$styleGroup->name}}</td>
                                                <td>{{$styleGroup->slug}}</td>
                                                <td>{{count($styleGroup->groupProperties->toArray())}}</td>
                                                <td>
                                                    <?php echo \Modules\Appfiy\Entities\StyleGroup::getPropertiesNameArray($styleGroup->id);?>
                                                </td>
                                                <td>
                                                    <a title="Edit" class="dropdown-item" href="{{route('style_group_assign_properties',[app()->getLocale(),$styleGroup->id])}}"><i class="fas fa-edit"></i></a>
                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                        @endforeach
                                    </tbody>
                                @endif
                            </table>

                            @if(count($styleGroups)>0)
                                <div class=" justify-content-right">
                                    {{ $styleGroups->links('layouts.pagination') }}
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
@endsection
