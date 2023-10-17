@extends('layouts.app')

@section('body')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="margin-bottom: 0px">

                    <div class="card-header">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                            <h6>{{__('appfiy::messages.componentInformation')}}</h6>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group me-2">

                                    <a href="{{route('component_add', app()->getLocale())}}" title="" class="module_button_header">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-plus-circle"></i> {{__('appfiy::messages.createNew')}}
                                        </button>
                                    </a>

                                    <a href="{{route('component_list', app()->getLocale())}}" title="" class="module_button_header">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-list"></i> {{__('appfiy::messages.list')}}
                                        </button>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('layouts.message')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">

                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2 text-end">
                                            <label for="" class="form-label">{{__('appfiy::messages.name')}} &nbsp;&nbsp; : </label>
                                        </div>
                                        <div class="col-sm-3"><label for="" class="form-label">{{$component->name}}</label></div>

                                        <div class="col-sm-2 text-end">
                                            <label for="" class="form-label">{{__('appfiy::messages.label')}} &nbsp;&nbsp; : </label>
                                        </div>

                                        <div class="col-sm-3"><label for="" class="form-label">{{$component->label}}</label></div>
                                    </div>

                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2 text-end">
                                            <label for="" class="form-label">{{__('appfiy::messages.iconCode')}} &nbsp;&nbsp; : </label>
                                        </div>
                                        <div class="col-sm-3"><label for="" class="form-label">{{$component->icon_code}}</label></div>

                                        <div class="col-sm-2 text-end">
                                            <label for="" class="form-label">{{__('appfiy::messages.event')}} &nbsp;&nbsp; : </label>
                                        </div>

                                        <div class="col-sm-3"><label for="" class="form-label">{{$component->event}}</label></div>
                                    </div>

                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2 text-end">
                                            <label for="" class="form-label">{{__('appfiy::messages.layoutType')}} &nbsp;&nbsp; : </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <label for="" class="form-label">{{$component->componentLayout['name']}}</label>
                                        </div>
                                    </div>

                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2 text-end">
                                            <label for="" class="form-label">{{__('appfiy::messages.productType')}} &nbsp;&nbsp; : </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <label for="" class="form-label">
                                                {{$component->product_type}}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2 text-end">
                                            <label for="" class="form-label">{{__('appfiy::messages.scope')}} &nbsp;&nbsp; : </label>
                                        </div>
                                        <div class="col-sm-3"><label for="" class="form-label">{{$component->scope}}</label></div>
                                    </div>

                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2 text-end">
                                            <label for="" class="form-label">{{__('appfiy::messages.styleGroup')}} &nbsp;&nbsp; : </label>
                                        </div>
                                        <div class="col-sm-8"><label for="" class="form-label">
                                                @if(count($componentLayout)>0)
                                                    @php $styleGroupArray = []; @endphp
                                                    @foreach($componentLayout as $group)
                                                        @php array_push($styleGroupArray,$group['name']) @endphp
{{--                                                        {{$group['name']}}--}}
                                                    @endforeach
                                                    {{implode(',',$styleGroupArray)}}
                                                @endif
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card" >

                    <div class="card-header">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                            <h6>{{__('appfiy::messages.componentPropertiesUpdate')}}</h6>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('layouts.message')
                        <div class="row">
                            <div class="col-md-12">
                                {!! Form::model($records, ['method' => 'PATCH','autocomplete'=>'off', 'files'=> true, 'route'=> ['component_properties_update',app()->getLocale(), $component->id],'enctype'=>'multipart/form-data']) !!}

                                <div class="row">

                                    <table class="table table-striped table-responsive table-bordered">
                                        <thead>
                                        <th>{{__('appfiy::messages.layoutType')}}</th>
                                        <th>{{__('appfiy::messages.propertiesName')}}</th>
                                        <th>{{__('appfiy::messages.value')}}</th>
                                        {{--                                                <th>{{__('appfiy::messages.defaultValue')}}</th>--}}
                                        </thead>
                                        @if(count($records)>0)
                                            <tbody>
                                            @foreach($records as $comPro)
                                                @php $i=1 @endphp
                                                @foreach($comPro as $val)
                                                    <tr>
                                                        @if($i==1)
                                                            <td rowspan="{{count($comPro)}}" class="textCenter">
                                                                {{$val['layout_type_name']}}
                                                            </td>
                                                        @endif
                                                        <td>
                                                            {!! Form::text('name', $val['name'], array('class' => 'form-control','readonly'=>true)) !!}
                                                            <input type="hidden" name="component_properties_id[]" value="{{$val['id']}}">
                                                        </td>
                                                        <td>
                                                            @php
                                                                $dropdownValue = [];
                                                                if ($val['name'] == 'font_family'){
                                                                    $dropdownValue = [
                                                                          'Arial'=>'Arial',
                                                                          'Verdana'=>'Verdana',
                                                                          'Calibri'=>'Calibri',
                                                                          'Noto'=>'Noto',
                                                                    ];
                                                                }
                                                                if ($val['name'] == 'font_weight'){
                                                                    $dropdownValue = [
                                                                          'normal'=>'normal',
                                                                          'bold'=>'bold',
                                                                          'bolder'=>'bolder',
                                                                          'lighter'=>'lighter',
                                                                    ];
                                                                }
                                                                if ($val['name'] == 'font_style'){
                                                                    $dropdownValue = [
                                                                          'normal'=>'normal',
                                                                          'Verdana'=>'Verdana',
                                                                          'Calibri'=>'Calibri',
                                                                          'Noto'=>'Noto',
                                                                    ];
                                                                }
                                                                if ($val['name'] == 'text_overflow'){
                                                                    $dropdownValue = [
                                                                          'clip'=>'clip',
                                                                          'ellipsis'=>'ellipsis',
                                                                          'string'=>'string',
                                                                          'initial'=>'initial',
                                                                          'inherit'=>'inherit',
                                                                    ];
                                                                }
                                                                if ($val['name'] == 'text_font'){
                                                                    $dropdownValue = [
                                                                          'Arial'=>'Arial',
                                                                          'Verdana'=>'Verdana',
                                                                          'Calibri'=>'Calibri',
                                                                          'Noto'=>'Noto',
                                                                    ];
                                                                }
                                                            @endphp

                                                            @if($val['input_type'] == 'number')
                                                                {!! Form::number('value[]', $val['value'], array('class' => 'form-control')) !!}
                                                            @endif

                                                            @if($val['input_type'] == 'color')
                                                                {!! Form::color('value[]', $val['value'], array('class' => 'form-control')) !!}
                                                            @endif

                                                            @if($val['input_type'] == 'select')
                                                                {!! Form::select('value[]',$dropdownValue, $val['value'], array('class' => 'form-control form-select js-example-basic-single','style'=>'width:50% !important')) !!}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @php $i++ @endphp
                                                @endforeach
                                            @endforeach
                                            </tbody>
                                        @endif
                                    </table>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10" >
                                            <div class="from-group">
                                                <button type="submit" class="btn btn-primary " id="UserFormSubmit">Submit</button>
                                                <button type="reset" class="btn submit-button">Reset</button>
                                            </div>
                                        </div>


                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('CustomStyle')
    <style>
        .customButton{
            color: #000;
            background-color: #fff;
            border-color: #6c757d;
        }
        .imageText{
            background: blue;
            color: #fff;
            padding: 5px 5px;
            display: block;
            margin-top: 2px;
        }
        .textRed{
            color: #ff0000;
        }

        .height29{
            height: 29px;
        }
        .textCenter{
            text-align: center;
        }
        .displayNone{
            display: none;
        }

    </style>
@endpush

@section('footer.scripts')

    <script type="text/javascript">
        $(function () {
        });
    </script>

@endsection
