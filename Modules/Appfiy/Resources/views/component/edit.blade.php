@extends('layouts.app')

@section('body')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                            <h6>{{__('appfiy::messages.componentUpdate')}}</h6>
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
                                {!! Form::model($data, ['method' => 'PATCH','autocomplete'=>'off', 'files'=> true, 'route'=> ['component_update',app()->getLocale(), $data->id],'enctype'=>'multipart/form-data']) !!}

                                <div class="row">

                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2">
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
                                        </div>
                                    </div>

                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2">
                                            <label for="" class="form-label">{{__('appfiy::messages.iconName')}}</label>
{{--                                            <span class="textRed">*</span>--}}
                                        </div>

                                        <div class="col-sm-4">
                                            {!! Form::text('icon_code', null, array('class' => 'form-control ','placeholder'=>__('appfiy::messages.enterIconName'))) !!}
                                            <span class="textRed">{!! $errors->first('icon_code') !!}</span>
                                        </div>

                                        <div class="col-sm-2">
                                            <label for="" class="form-label">{{__('appfiy::messages.event')}}</label>
{{--                                            <span class="textRed">*</span>--}}
                                        </div>

                                        <div class="col-sm-4">
                                            {!! Form::text('event', null, array('class' => 'form-control ','placeholder'=>__('appfiy::messages.EnterEvent'))) !!}
                                            <span class="textRed">{!! $errors->first('event') !!}</span>
                                        </div>
                                    </div>

                                    {{--<div class="form-group row mg-top">
                                        <div class="col-sm-2">
                                            <label for="" class="form-label">{{__('appfiy::messages.classType')}}</label>
                                            <span class="textRed">*</span>
                                        </div>
                                        <div class="col-sm-10">
                                            {!! Form::text('class_type', null, array('class' => 'form-control ','placeholder'=>__('appfiy::messages.EnterClassType'))) !!}
                                            <span class="textRed">{!! $errors->first('class_type') !!}</span>
                                        </div>
                                    </div>--}}

                                    <div class="form-group row mg-top">

                                        <div class="col-sm-2">
                                            <label for="" class="form-label">{{__('appfiy::messages.productType')}}</label>
                                        </div>
                                        @php
                                            $dropdownValue = [
                                                'Product' => 'Product',
                                                'Category' => 'Category'
                                            ];
                                        @endphp

                                        <div class="col-sm-4">
                                            {!! Form::select('product_type',$dropdownValue, $data['product_type'], array('class' => ' form-control form-select js-example-basic-single','placeholder'=>__('appfiy::messages.chooseProductType'))) !!}
                                        </div>
                                    </div>


                                    {{--<div class="form-group row mg-top">
                                        <div class="col-sm-2">
                                            {!! Form::label(__('appfiy::messages.appIcon'), __('appfiy::messages.appIcon'), array('class' => 'form-label','for'=>'formFile')) !!}
                                        </div>

                                        <div class="col-sm-10">
                                            <input class="form-control" name="app_icon" type="file" id="app_icon" accept="image/*">
                                            @if(isset($data->app_icon))
                                                <span class="imageText">{{$data->app_icon}}</span>
                                            @endif
                                        </div>
                                    </div>--}}

                                    {{--<div class="form-group row mg-top">
                                        <div class="col-sm-2">
                                            {!! Form::label(__('appfiy::messages.webIcon'), __('appfiy::messages.webIcon'), array('class' => 'form-label','for'=>'formFile')) !!}
                                        </div>

                                        <div class="col-sm-10">
                                            <input class="form-control" name="web_icon" type="file" id="web_icon" accept="image/*">
                                            @if(isset($data->web_icon))
                                                <span class="imageText">{{$data->web_icon}}</span>
                                            @endif
                                        </div>
                                    </div>--}}

                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2">
                                            {!! Form::label(__('appfiy::messages.image'), __('appfiy::messages.image'), array('class' => 'form-label','for'=>'formFile')) !!}
                                        </div>

                                        <div class="col-sm-10">
                                            <input class="form-control" name="image" type="file" id="image" accept="image/*">
                                            @if(isset($data->image))
                                                <span class="imageText">{{$data->image}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2">
                                            <label for="layout_type_id" class="form-label">{{__('appfiy::messages.layoutType')}}</label>
                                            <span class="textRed">*</span>
                                        </div>

                                        <div class="col-sm-4">
                                            {!! Form::select('layout_type_id',$layoutTypes?$layoutTypes:[], $data['layout_type_id'], array('class' => ' form-control form-select js-example-basic-single','placeholder'=>__('appfiy::messages.chooseLayoutType'))) !!}
                                            <br><span class="textRed">{!! $errors->first('layout_type_id') !!}</span>
                                        </div>
                                    </div>


                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2">
                                            <label for="" class="form-label">{{__('appfiy::messages.styleGroup')}}</label>
                                            <span class="textRed">*</span>
                                        </div>

                                        <div class="col-sm-10">
                                            @if(count($styleGroups)>0)
                                                @foreach($styleGroups as $styleGroup)
                                                    <div class="form-check form-check-inline">
                                                        <input style="margin-top: 0px" class="form-check-input" name="style_group[]" type="checkbox" id="{{$styleGroup['slug']}}" value="{{$styleGroup['id']}}"
                                                        @if(count($componentStyleIdArray)>0)
                                                            {{in_array($styleGroup['id'],$componentStyleIdArray)?'checked':''}}
                                                            @endif
                                                        >
                                                        <label class="form-check-label" for="{{$styleGroup['slug']}}">{{$styleGroup['name']}}</label>
                                                    </div>
                                                @endforeach
                                                <br><span class="textRed">{!! $errors->first('style_group') !!}</span>
                                            @endif
                                        </div>
                                    </div>



                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2">
                                            <label for="" class="form-label">{{__('appfiy::messages.globalScope')}}</label>
                                            <span class="textRed">*</span>
                                        </div>

                                        <div class="col-sm-10">
                                            @php
                                                $scopeArray = json_decode($data['scope']);
                                            @endphp
                                            @if(count($scopeArrayData['global-scope'])>0)
                                                @foreach($scopeArrayData['global-scope'] as $scopeGlobal)
                                                    <div class="form-check form-check-inline">
                                                        <input style="margin-top: 0px" class="form-check-input" name="scope[]" type="checkbox" id="{{$scopeGlobal['slug']}}" value="{{$scopeGlobal['slug']}}"
                                                            @if(isset($scopeArray) && count($scopeArray)>0)
                                                                {{in_array($scopeGlobal['slug'],$scopeArray)?'checked':''}}
                                                            @endif
                                                        >
                                                        <label class="form-check-label" for="{{$scopeGlobal['slug']}}">{{$scopeGlobal['name']}}</label>
                                                    </div>
                                                @endforeach
                                            <br><span class="textRed">{!! $errors->first('scope') !!}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2">
                                            <label for="" class="form-label">{{__('appfiy::messages.pageScope')}}</label>
{{--                                            <span class="textRed">*</span>--}}
                                        </div>

                                        <div class="col-sm-10">
                                            @php
                                                $scopeArray = json_decode($data['scope']);
                                            @endphp
                                            @if(count($scopeArrayData['page-scope'])>0)
                                                @foreach($scopeArrayData['page-scope'] as $scopePage)
                                                    <div class="form-check form-check-inline">
                                                        <input style="margin-top: 0px" class="form-check-input" name="scope[]" type="checkbox" id="{{$scopePage['slug']}}" value="{{$scopePage['slug']}}"
                                                            @if(isset($scopeArray) && count($scopeArray)>0)
                                                                {{in_array($scopePage['slug'],$scopeArray)?'checked':''}}
                                                            @endif
                                                        >
                                                        <label class="form-check-label" for="{{$scopePage['slug']}}">{{$scopePage['name']}}</label>
                                                    </div>
                                                @endforeach
{{--                                            <br><span class="textRed">{!! $errors->first('scope') !!}</span>--}}
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2">
                                            <label for="" class="form-label">{{__('appfiy::messages.isMultiple')}}</label>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="from-group">
                                                <?php
                                                $Active = '';
                                                $Inactive = '';
                                                if (isset($data->is_multiple)){
                                                    if ($data->is_multiple == 1){
                                                        $Active = 'checked="checked"';
                                                    }else{
                                                        $Inactive = 'checked="checked"';
                                                    }
                                                }else{
                                                    $Inactive = 'checked="checked"';
                                                }
                                                ?>
                                                <div class="input-group mb-3">
                                                    <div class="form-check form-check-inline">
                                                        <input style="margin-top: 0px" class="form-check-input isChecked ayatFormEdit" type="radio" name="is_multiple" id="is_multiple1" value="1" {{$Active}}>
                                                        <label class="form-check-label" for="is_multiple1">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input style="margin-top: 0px" class="form-check-input isChecked ayatFormEdit" type="radio" name="is_multiple" id="is_multiple2" value="0" {{$Inactive}}>
                                                        <label class="form-check-label" for="is_multiple2">No</label>
                                                    </div>
                                                    <span class="textRed">{!! $errors->first('is_multiple') !!}</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2">
                                            <label for="" class="form-label">{{__('appfiy::messages.IsActive')}}</label>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="from-group">
                                                <?php
                                                $Active = '';
                                                $Inactive = '';
                                                if (isset($data->is_active)){
                                                    if ($data->is_active == 1){
                                                        $Active = 'checked="checked"';
                                                    }else{
                                                        $Inactive = 'checked="checked"';
                                                    }
                                                }else{
                                                    $Inactive = 'checked="checked"';
                                                }
                                                ?>
                                                <div class="input-group mb-3">
                                                    <div class="form-check form-check-inline">
                                                        <input style="margin-top: 0px" class="form-check-input isChecked " type="radio" name="is_active" id="inlineRadioActive1" value="1" {{$Active}}>
                                                        <label class="form-check-label" for="inlineRadioActive1">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input style="margin-top: 0px" class="form-check-input isChecked ayatFormEdit" type="radio" name="is_active" id="inlineRadioActive2" value="0" {{$Inactive}}>
                                                        <label class="form-check-label" for="inlineRadioActive2">No</label>
                                                    </div>
                                                    <span class="textRed">{!! $errors->first('is_multiple') !!}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mg-top">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10" >
                                            <div class="from-group">
                                                <button type="submit" class="btn btn-primary " id="UserFormSubmit">Next</button>
                                                <button type="reset" class="btn submit-button">Reset</button>
                                            </div>
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

    <div class="modal fade" id="allModalShow" tabindex="-1" aria-labelledby="allModalShowModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="appfiypleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="modelForm">

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn customButton" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>                    <button type="button" class="btn btn-primary modelDataInsert">Save changes</button>
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

    </script>

@endsection
