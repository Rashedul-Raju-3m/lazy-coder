@extends('layouts.app')

@section('body')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                            <h6>{{__('exam::messages.employeeEdit')}}</h6>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group me-2">

                                    <a href="{{route('employee_add', app()->getLocale())}}" title="" class="module_button_header">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-plus-circle"></i> {{__('exam::messages.Add Button')}}
                                        </button>
                                    </a>

                                    <a href="{{route('employee_list', app()->getLocale())}}" title="" class="module_button_header">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-list"></i> {{__('exam::messages.list Button')}}
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
                                    <div class="col-md-6">
                                        <div class="row paddingRemove">
                                            <div class="col-md-2 width30"><label for="" class="form-label">{{__('exam::messages.name')}} </label></div>
                                            <div class="col-md-1 width10"><label for="" class="form-label">:</label></div>
                                            <div class="col-md-3 width60">{{$employee->name}}</div>
                                        </div>

                                        <div class="row paddingRemove">
                                            <div class="col-md-2 width30">
                                                <label for="" class="form-label">
                                                    {{__('exam::messages.employeeId')}}
                                                </label>
                                            </div>
                                            <div class="col-md-1 width10"><label for="" class="form-label">:</label></div>
                                            <div class="col-md-3 width60">{{$employee->employee_id}}</div>
                                        </div>

                                        <div class="row paddingRemove">
                                            <div class="col-md-2 width30">
                                                <label for="" class="form-label">
                                                    {{__('exam::messages.mobile')}}
                                                </label>
                                            </div>
                                            <div class="col-md-1 width10"><label for="" class="form-label">:</label></div>
                                            <div class="col-md-3 width60">{{$employee->mobile}}</div>
                                        </div>

                                        <div class="row paddingRemove">
                                            <div class="col-md-2 width30">
                                                <label for="" class="form-label">
                                                    {{__('exam::messages.email')}}
                                                </label>
                                            </div>
                                            <div class="col-md-1 width10"><label for="" class="form-label">:</label></div>
                                            <div class="col-md-3 width60">{{$employee->email}}</div>
                                        </div>

                                        <div class="row paddingRemove">
                                            <div class="col-md-2 width30">
                                                <label for="" class="form-label">
                                                    {{__('exam::messages.presentAdd')}}
                                                </label>
                                            </div>
                                            <div class="col-md-1 width10"><label for="" class="form-label">:</label></div>
                                            <div class="col-md-3 width60">{{$employee->present_address}}</div>
                                        </div>

                                        <div class="row paddingRemove">
                                            <div class="col-md-2 width30">
                                                <label for="" class="form-label">
                                                    {{__('exam::messages.permanentAdd')}}
                                                </label>
                                            </div>
                                            <div class="col-md-1 width10"><label for="" class="form-label">:</label></div>
                                            <div class="col-md-3 width60">{{$employee->permanent_address}}</div>
                                        </div>

                                        <div class="row paddingRemove">
                                            <div class="col-md-2 width30">
                                                <label for="" class="form-label">
                                                    {{__('exam::messages.education')}}
                                                </label>
                                            </div>
                                            <div class="col-md-1 width10"><label for="" class="form-label">:</label></div>
                                            <div class="col-md-3 width60">{{$employee->education}}</div>
                                        </div>

                                        <div class="row paddingRemove">
                                            <div class="col-md-2 width30">
                                                <label for="" class="form-label">
                                                    {{__('exam::messages.designation')}}
                                                </label>
                                            </div>
                                            <div class="col-md-1 width10"><label for="" class="form-label">:</label></div>
                                            <div class="col-md-3 width60">{{$employee->designationName}}</div>
                                        </div>

                                        <div class="row paddingRemove">
                                            <div class="col-md-2 width30">
                                                <label for="" class="form-label">
                                                    {{__('exam::messages.location')}}
                                                </label>
                                            </div>
                                            <div class="col-md-1 width10"><label for="" class="form-label">:</label></div>
                                            <div class="col-md-3 width60">{{$employee->locationName}}</div>
                                        </div>

                                        <div class="row paddingRemove">
                                            <div class="col-md-2 width30">
                                                <label for="" class="form-label">
                                                    {{__('exam::messages.department')}}
                                                </label>
                                            </div>
                                            <div class="col-md-1 width10"><label for="" class="form-label">:</label></div>
                                            <div class="col-md-3 width60">{{$employee->departmentName}}</div>
                                        </div>

                                        <div class="row paddingRemove">
                                            <div class="col-md-2 width30">
                                                <label for="" class="form-label">
                                                    {{__('exam::messages.joinDate')}}
                                                </label>
                                            </div>
                                            <div class="col-md-1 width10"><label for="" class="form-label">:</label></div>
                                            <div class="col-md-3 width60">{{$employee->join_date}}</div>
                                        </div>

                                        <div class="row paddingRemove">
                                            <div class="col-md-2 width30">
                                                <label for="" class="form-label">
                                                    {{__('exam::messages.image')}}
                                                </label>
                                            </div>
                                            <div class="col-md-1 width10"><label for="" class="form-label">:</label></div>
                                            <div class="col-md-3 width60">{{$employee->image}}</div>
                                        </div>

                                        <div class="row paddingRemove">
                                            <div class="col-md-2 width30">
                                                <label for="" class="form-label">
                                                    {{__('exam::messages.signature')}}
                                                </label>
                                            </div>
                                            <div class="col-md-1 width10"><label for="" class="form-label">:</label></div>
                                            <div class="col-md-3 width60">{{$employee->signature}}</div>
                                        </div>

                                        <div class="row paddingRemove">
                                            <div class="col-md-2 width30">
                                                <label for="" class="form-label">
                                                    {{__('messages.userRole')}}
                                                </label>
                                            </div>
                                            <div class="col-md-1 width10"><label for="" class="form-label">:</label></div>
                                            <div class="col-md-3 width60">
                                                @foreach($roles as $role)
                                                    <span class="badge bg-success">{{$role}}</span>
                                                @endforeach
                                            </div>
                                        </div>


                                    </div>

                                    <div class="col-md-6">
                                        <div class="row paddingRemove">
                                            <img src="{{asset('upload/employee/'.$employee->image)}}" alt="{{$employee->name}}" style="width: 250px;">
                                        </div>
                                    </div>
                                </div>
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
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
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

    <script src="{{Module::asset('quran:js/sura-datatable.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $(document).on("change", ".isChecked", function (e) {
                e.preventDefault();
            });
            /* DESIGNATION ADD */
            $(document).delegate('.modelShow','click',function(){
                var modelName = $(this).attr('modelname');
                if(modelName == 'designation'){
                    $('.modal-title').text('New Designation');
                    $('#modelForm').html('<input type="text" name="name" fieldName="designation" class="form-control fieldValue" placeholder="{{__('exam::messages.modelEnterDesig')}}" id="newDesignation">');
                }
                if (modelName == 'location'){
                    $('.modal-title').text('New Location');
                    $('#modelForm').html('<input type="text" name="name" fieldName="location" class="form-control fieldValue" placeholder="{{__('exam::messages.modelLocation')}}" id="newLocation">');
                }
                if (modelName == 'department'){
                    $('.modal-title').text('New Department');
                    $('#modelForm').html('<input type="text" name="name" fieldName="department" class="form-control fieldValue" placeholder="{{__('exam::messages.modelDepartment')}}" id="newDepartment">');
                }
                $("#allModalShow").modal('show');

            });

            /*Data insert from model designation/location/department*/
            $(document).delegate('.modelDataInsert','click',function(){
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
                                var dropdownOption = '<option value="">{{__('exam::messages.selectDesignation')}}</option>';
                            }

                            if (response.type == '2') {
                                var dropdownOption = '<option value="">{{__('exam::messages.selectDepartment')}}</option>';
                            }

                            if (response.type == '3') {
                                var dropdownOption = '<option value="">{{__('exam::messages.selectLocation')}}</option>';
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
            });
        });
    </script>

@endsection
