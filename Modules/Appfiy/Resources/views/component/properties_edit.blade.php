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
                                            <label for="" class="form-label">{{__('appfiy::messages.scope')}} &nbsp;&nbsp; : </label>
                                        </div>
                                        <div class="col-sm-3"><label for="" class="form-label">{{$component->scope}}</label></div>

                                        <div class="col-sm-2 text-end">
                                            <label for="" class="form-label">{{__('appfiy::messages.classType')}} &nbsp;&nbsp; : </label>
                                        </div>

                                        <div class="col-sm-3"><label for="" class="form-label">{{$component->class_type}}</label></div>
                                    </div>

                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2 text-end">
                                            <label for="" class="form-label">{{__('appfiy::messages.layoutType')}} &nbsp;&nbsp; : </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <label for="" class="form-label">
                                        @if(isset($componentLayout) && count($componentLayout)>0)
                                            @php $i=1 @endphp
                                            @foreach($componentLayout as $comLay)
                                                {{($i==1?'':', ').$comLay['name']}}
                                                        @php $i++ @endphp
                                            @endforeach
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
                            {{--<div class="btn-toolbar mb-2 mb-md-0">
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
                            </div>--}}
                        </div>
                    </div>

                    <div class="card-body">
                        @include('layouts.message')
                        <div class="row">
                            <div class="col-md-12">
                                {{--                                {!! Form::model($data, ['method' => 'PATCH','autocomplete'=>'off', 'files'=> true, 'route'=> ['component_update',app()->getLocale(), $data->id],'enctype'=>'multipart/form-data']) !!}--}}

                                <div class="row">

                                    <div class="form-group row mg-top">
                                        <table class="table table-striped table-responsive table-bordered">
                                            <thead>
                                                <th>{{__('appfiy::messages.layoutType')}}</th>
                                                <th>{{__('appfiy::messages.propertiesName')}}</th>
                                                <th>{{__('appfiy::messages.value')}}</th>
                                                <th>{{__('appfiy::messages.defaultValue')}}</th>
                                            </thead>
                                            @if(isset($componentLayoutProperties) && count($componentLayoutProperties)>0)
                                                <tbody>
                                                    @foreach($componentLayoutProperties as $comPro)
                                                        <tr>
                                                            <td>
                                                                {!! Form::text('layout_type_name', $comPro->layout_type_name, array('class' => 'form-control','readonly'=>true)) !!}
                                                            </td>
                                                            <td>
                                                                {!! Form::text('name', $comPro->name, array('class' => 'form-control','readonly'=>true)) !!}
                                                                <input type="hidden" name="component_properties_id[]" value="{{$comPro->id}}">
                                                            </td>
                                                            <td>
                                                                @php
                                                                    $dropdownValue = [];
                                                                    if ($comPro->name == 'font_family'){
                                                                        $dropdownValue = [
                                                                              'Arial'=>'Arial',
                                                                              'Verdana'=>'Verdana',
                                                                              'Calibri'=>'Calibri',
                                                                              'Noto'=>'Noto',
                                                                        ];
                                                                    }
                                                                    if ($comPro->name == 'font_weight'){
                                                                        $dropdownValue = [
                                                                              'normal'=>'normal',
                                                                              'bold'=>'bold',
                                                                              'bolder'=>'bolder',
                                                                              'lighter'=>'lighter',
                                                                        ];
                                                                    }
                                                                    if ($comPro->name == 'font_style'){
                                                                        $dropdownValue = [
                                                                              'normal'=>'normal',
                                                                              'Verdana'=>'Verdana',
                                                                              'Calibri'=>'Calibri',
                                                                              'Noto'=>'Noto',
                                                                        ];
                                                                    }
                                                                    if ($comPro->name == 'text_overflow'){
                                                                        $dropdownValue = [
                                                                              'clip'=>'clip',
                                                                              'ellipsis'=>'ellipsis',
                                                                              'string'=>'string',
                                                                              'initial'=>'initial',
                                                                              'inherit'=>'inherit',
                                                                        ];
                                                                    }
                                                                    if ($comPro->name == 'text_font'){
                                                                        $dropdownValue = [
                                                                              'Arial'=>'Arial',
                                                                              'Verdana'=>'Verdana',
                                                                              'Calibri'=>'Calibri',
                                                                              'Noto'=>'Noto',
                                                                        ];
                                                                    }
                                                                @endphp

                                                                @if($comPro->input_type == 'number')
                                                                    {!! Form::number('value[]', $comPro->value, array('class' => 'form-control')) !!}
                                                                @endif

                                                                @if($comPro->input_type == 'color')
                                                                    {!! Form::color('value[]', $comPro->value, array('class' => 'form-control')) !!}
                                                                @endif

                                                                @if($comPro->input_type == 'select')
{{--                                                                    {!! Form::text('rrr[]', $comPro->value, array('class' => 'form-control')) !!}--}}
                                                                    {!! Form::select('value[]',$dropdownValue, $comPro->value, array('class' => 'form-control')) !!}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            @endif
                                        </table>
                                        {{--<div class="col-sm-2">
                                            <label for="" class="form-label">{{__('appfiy::messages.name')}}</label>
                                            <span class="textRed">*</span>
                                        </div>

                                        <div class="col-sm-4">
                                            {!! Form::text('name', null, array('class' => 'form-control ','placeholder'=>__('appfiy::messages.enterComponentName'))) !!}
                                            <span class="textRed">{!! $errors->first('name') !!}</span>
                                        </div>

                                        <div class="col-sm-2">
                                            <label for="" class="form-label">{{__('appfiy::messages.label')}}</label>
                                            <span class="textRed">*</span>
                                        </div>

                                        <div class="col-sm-4">
                                            {!! Form::text('label', null, array('class' => 'form-control ','placeholder'=>__('appfiy::messages.enterComponentLabel'))) !!}
                                            <span class="textRed">{!! $errors->first('label') !!}</span>
                                        </div>--}}
                                    </div>

                                    <div class="row mg-top">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10" >
                                            <div class="from-group">
                                                <button type="submit" class="btn btn-primary " id="UserFormSubmit">Submit</button>
                                                <button type="reset" class="btn submit-button">Reset</button>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                {{--                                {!! Form::close() !!}--}}
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
