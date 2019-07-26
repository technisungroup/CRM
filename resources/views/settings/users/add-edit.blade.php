@extends('layouts.super-admin')
@section('contents')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-lg-6">
                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Users Form
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        @if(!$errors->isEmpty())

                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <form method="post" action="{{ !empty($data->id) ?  route('users.update',$data->id) :  route('users.store')  }}" class="kt-form">
                            @csrf
                            @if(!empty($data->id)) @method('put') @endif
                            <div class="kt-portlet__body">
                                    <div class="form-group">
                                        <label>User name</label>
                                        <input type="text" name="username" class="form-control" value="{{ !empty($data->name) ? $data->name : old('username') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>First name</label>
                                        <input type="text" name="first_name" class="form-control" value="{{ !empty($data->first_name) ? $data->first_name : old('first_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Last name</label>
                                        <input type="text" name="last_name" class="form-control" value="{{ !empty($data->last_name) ? $data->name : old('last_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control" value="{{ !empty($data->email) ? $data->email : old('email') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control" value="{{ !empty($data->phone) ? $data->phone : old('phone') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelect1">User Role</label>
                                        <select class="form-control" id="user_role" name="user_role">
                                            <option value="">Select User Role</option>
                                            @foreach($userRoles as $key => $role)
                                                <option {{ (!empty($data->user_role) && $data->user_role == $role->id || old('user_role') == $role->id ) ? 'selected' : '' }}
                                                        value="{{ $role->id }}">{{ $role->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelect1">Branch</label>
                                        <select class="form-control" id="branch" name="branch">
                                            <option value="">Select Branch</option>
                                            @foreach($locations as $key => $location)
                                                <option {{ (!empty($data->user_location_id) && $data->user_location_id == $location->id || old('branch') == $location->id ) ? 'selected' : '' }}
                                                        value="{{ $location->id }}">{{ $location->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label>Module:</label>
                                            @foreach($modules as $key => $module)
                                            <div class="kt-checkbox-inline">
                                                <label class="kt-checkbox kt-checkbox--brand">
                                                    <input type="checkbox" {{ (!empty($selectedModules['modules'][$key+1]) && $selectedModules['modules'][$key+1] == $module->id ) ? 'checked' : '' }}
                                                           onchange="givePermissions({{ $module->id }})" id="module_{{ $module->id }}" name="modules[]" value="{{ $module->id }}">
                                                    <label for="module_{{ $module->id }}">{{ $module->title }}</label>
                                                    <span></span>
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="col-lg-9">
                                            <label>Permission:</label>
                                            @php $i = '1' @endphp
                                            @foreach($modules as $key => $module)
                                            <div class="kt-checkbox-inline">
                                                @foreach($permissions as $pKey => $permission)
                                                <label class="kt-checkbox kt-checkbox--brand" id="label-permission_{{$module->id.'_'.$permission->id }}">
                                                    <input type="checkbox" class="permission-{{ $module->id }}"
                                                           @if(!empty($data->id) &&  !$data->userPermissions->isEmpty())
                                                               @foreach($data->userPermissions as $userPermission)
                                                                       {{ ($userPermission->module_id == $module->id && $userPermission->permission_id == $permission->id) ? 'checked' : '' }}
                                                               @endforeach
                                                           @endif
                                                           id="permission_{{ $module->id }}_{{ $permission->id }}" name="permissions[{{ $module->id }}][]" value="{{ $permission->id }}">
                                                    <label for="permission_{{ $module->id }}_{{ $permission->id }}">{{ $permission->title }}</label>
                                                    <span></span>
                                                </label>
                                                    @php $i++ @endphp
                                                @endforeach
                                            </div>
                                                @php $i++ @endphp
                                            @endforeach
                                        </div>
                                    </div>
                                    @if(empty($data->id))
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" name="password" class="form-control" value="{{ !empty($data->password) ? $data->password : old('password') }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm-password</label>
                                            <input type="text" name="confirm_password" class="form-control" value="{{ !empty($data->confirm_password) ? $data->confirm_password : old('confirm_password') }}">
                                        </div>
                                    @endif
                                </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function givePermissions(id){

            if($('#module_'+id).is(':checked') == true){

                $('#permission_'+id+'_3').attr('checked',true);
                $('#permission_'+id+'_3').attr('onclick',"return false");
            }else if($('#module_'+id).is(':checked') == false){

                $('#permission_'+id+'_3').removeAttr('onclick');
                //$('#permission_'+id+'_3').attr('checked',false);
                $('.permission-'+id).each(function (i,v){
                    var pid = $(v).attr('id');
                    $('#'+pid).attr('checked',false);
                    $('#'+pid).parent('label').find('span').html('');
                    $('#label-'+pid).find('span').html('');
                });
            }
        }
    </script>
@endsection