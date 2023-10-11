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
                                            <span class="textRed">*</span>
                                        </div>

                                        <div class="col-sm-4">
                                            {!! Form::text('icon_code', null, array('class' => 'form-control ','placeholder'=>__('appfiy::messages.enterIconName'))) !!}
                                            <span class="textRed">{!! $errors->first('icon_code') !!}</span>
                                        </div>

                                        <div class="col-sm-2">
                                            <label for="" class="form-label">{{__('appfiy::messages.event')}}</label>
                                            <span class="textRed">*</span>
                                        </div>

                                        <div class="col-sm-4">
                                            {!! Form::text('event', null, array('class' => 'form-control ','placeholder'=>__('appfiy::messages.EnterEvent'))) !!}
                                            <span class="textRed">{!! $errors->first('event') !!}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row mg-top">

                                        <div class="col-sm-2">
                                            <label for="" class="form-label">{{__('appfiy::messages.classType')}}</label>
{{--                                            <span class="textRed">*</span>--}}
                                        </div>

                                        <div class="col-sm-10">
                                            {!! Form::text('class_type', null, array('class' => 'form-control ','placeholder'=>__('appfiy::messages.EnterClassType'))) !!}
{{--                                            <span class="textRed">{!! $errors->first('class_type') !!}</span>--}}
                                        </div>
                                    </div>


                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2">
                                            {!! Form::label(__('appfiy::messages.appIcon'), __('appfiy::messages.appIcon'), array('class' => 'form-label','for'=>'formFile')) !!}
                                        </div>

                                        <div class="col-sm-10">
                                            <input class="form-control" name="app_icon" type="file" id="app_icon" accept="image/*">
                                            @if(isset($data->app_icon))
                                                <span class="imageText">{{$data->app_icon}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2">
                                            {!! Form::label(__('appfiy::messages.webIcon'), __('appfiy::messages.webIcon'), array('class' => 'form-label','for'=>'formFile')) !!}
                                        </div>

                                        <div class="col-sm-10">
                                            <input class="form-control" name="web_icon" type="file" id="web_icon" accept="image/*">
                                            @if(isset($data->web_icon))
                                                <span class="imageText">{{$data->web_icon}}</span>
                                            @endif
                                        </div>
                                    </div>

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
                                                        <input class="form-check-input isChecked ayatFormEdit" type="radio" name="is_multiple" id="is_multiple1" value="1" {{$Active}}>
                                                        <label class="form-check-label" for="is_multiple1">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input isChecked ayatFormEdit" type="radio" name="is_multiple" id="is_multiple2" value="0" {{$Inactive}}>
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
                                                        <input class="form-check-input isChecked " type="radio" name="is_active" id="inlineRadioActive1" value="1" {{$Active}}>
                                                        <label class="form-check-label" for="inlineRadioActive1">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input isChecked ayatFormEdit" type="radio" name="is_active" id="inlineRadioActive2" value="0" {{$Inactive}}>
                                                        <label class="form-check-label" for="inlineRadioActive2">No</label>
                                                    </div>
                                                    <span class="textRed">{!! $errors->first('is_multiple') !!}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2">
                                            {!! Form::label(__('appfiy::messages.layoutType'), __('appfiy::messages.layoutType'), array('class' => 'form-label','for'=>'formFile')) !!}
                                        </div>

                                        <div class="col-sm-10">
                                            @if(isset($layoutTypes) && count($layoutTypes)>0)
                                                @foreach($layoutTypes as $layout)
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" name="layout[]" type="checkbox" id="{{$layout->slug}}" value="{{$layout->id}}">
                                                        <label class="form-check-label" for="{{$layout->slug}}">{{$layout->name}}</label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mg-top">
                                        <div class="col-sm-2">
                                            <label for="" class="form-label">{{__('appfiy::messages.scope')}}</label>
                                            <span class="textRed">*</span>
                                        </div>

                                        <div class="col-sm-10">
                                            @php
                                                $scopeArray = json_decode($data['scope']);
                                            @endphp
                                            @if(isset($scopes) && count($scopes)>0)
                                                @foreach($scopes as $scope)
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" name="scope[]" type="checkbox" id="{{$scope}}" value="{{$scope}}" {{in_array($scope,$scopeArray)?'checked':''}}>
                                                        <label class="form-check-label" for="{{$scope}}">{{$scope}}</label>
                                                    </div>
                                                @endforeach
                                            <br><span class="textRed">{!! $errors->first('scope') !!}</span>
                                            @endif
                                        </div>
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

{{--    <script src="{{Module::asset('quran:js/sura-datatable.js')}}"></script>--}}
    <script type="text/javascript">
        $(function () {
            /*$(document).on("change", ".isChecked", function (e) {
                e.preventDefault();
            });*/
            /* DESIGNATION ADD */
            /*$(document).delegate('.modelShow','click',function(){
                var modelName = $(this).attr('modelname');
                if(modelName == 'designation'){
                    $('.modal-title').text('New Designation');
                    $('#modelForm').html('<input type="text" name="name" fieldName="designation" class="form-control fieldValue" placeholder="{{__('appfiy::messages.modelEnterDesig')}}" id="newDesignation">');
                }
                if (modelName == 'location'){
                    $('.modal-title').text('New Location');
                    $('#modelForm').html('<input type="text" name="name" fieldName="location" class="form-control fieldValue" placeholder="{{__('appfiy::messages.modelLocation')}}" id="newLocation">');
                }
                if (modelName == 'department'){
                    $('.modal-title').text('New Department');
                    $('#modelForm').html('<input type="text" name="name" fieldName="department" class="form-control fieldValue" placeholder="{{__('appfiy::messages.modelDepartment')}}" id="newDepartment">');
                }
                $("#allModalShow").modal('show');

            });*/

            /*Data insert from model designation/location/department*/
            /*$(document).delegate('.modelDataInsert','click',function(){
                var value = $('.fieldValue').val();
                var type = $('.fieldValue').attr('fieldname');
                var route = $('#createRouteforauthor').attr('data-href');
                var validation = true;

                if (type == 'designation'){
                    if (value == ''){
                        Swal.fire(
                            'Enter designation',
                            '',
                        )
                        return false
                        validation = false;
                    }
                }

                if (type == 'location'){
                    if (value == ''){
                        Swal.fire(
                            'Enter location',
                            '',
                        )
                        return false
                        validation = false;
                    }
                }

                if (type == 'department'){
                    if (value == ''){
                        Swal.fire(
                            'Enter department',
                            '',
                        )
                        return false
                        validation = false;
                    }
                }
                if (validation){
                    $.ajax({
                        url: route,
                        method: "get",
                        dataType: "json",
                        data: {value: value,type:type},
                        beforeSend: function( xhr ) {

                        }
                    }).done(function( response ) {
                        if (!response.exists) {
                            var allItems = response.dropdown;
                            var dropdownOption = '';
                            if (response.type == '1') {
                                var dropdownOption = '<option value="">{{__('appfiy::messages.selectDesignation')}}</option>';
                            }

                            if (response.type == '2') {
                                var dropdownOption = '<option value="">{{__('appfiy::messages.selectDepartment')}}</option>';
                            }

                            if (response.type == '3') {
                                var dropdownOption = '<option value="">{{__('appfiy::messages.selectLocation')}}</option>';
                            }

                            jQuery.each(allItems, function (i, item) {
                                dropdownOption += '<option value="' + i + '">' + item + '</option>';
                            });
                            if (response.type == '1') {
                                jQuery('#designation_id').html(dropdownOption);
                            }
                            if (response.type == '2') {
                                jQuery('#department_id').html(dropdownOption);
                            }
                            if (response.type == '3') {
                                jQuery('#location_id').html(dropdownOption);
                            }

                            $("#allModalShow").modal('hide');
                        }else{
                            Swal.fire(
                                response.exists,
                                '',
                            )
                        }
                    }).fail(function( jqXHR, textStatus ) {

                    });
                    return false;
                }
            });*/
        });
    </script>

@endsection
