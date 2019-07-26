@extends('layouts.super-admin')
@section('contents')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">


            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Users List
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">

                                <a href="{{ route('users.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                    ADD New User
                                </a>

                                <a href="{{ route('home') }}" class="btn btn-secondary btn-elevate btn-icon-sm">Back</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kt-portlet__body">

                    @if(\Illuminate\Support\Facades\Session::has('success'))
                        <div class="alert alert-success">
                            {{ \Illuminate\Support\Facades\Session::get('success') }}
                        </div>
                    @endif
                    <!--begin: Datatable -->
                    <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="" role="grid" aria-describedby="kt_table_1_info">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>User Role</th>
                                        <th>Branch</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!$data->isEmpty())
                                        @foreach($data as $key => $dt)
                                            <tr class="tr-{{$dt->id}}">
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $dt->name }}</td>
                                                <td>{{ $dt->first_name }}</td>
                                                <td>{{ $dt->last_name }}</td>
                                                <td>{{ $dt->email }}</td>
                                                <td>{{ $dt->phone }}</td>
                                                <td>{{ $dt->userRole->title }}</td>
                                                <td>{{ $dt->branch->title }}</td>
                                                <td>
                                                    <a  href="{{!empty($dt->deleted_at) ? "javascript:void()" : route('users.edit',$dt->id) }}" id="btn-edit-{{$dt->id}}"
                                                        {{ !empty($dt->deleted_at) ? "onclick=editAlert() " : '' }}
                                                        class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
                                                        <i class="fa fa-pencil {{ !empty($dt->deleted_at) ? ' text-danger': '' }}" aria-hidden="true"></i>
                                                    </a>

                                                    <a  href="{{!empty($dt->deleted_at) ? "javascript:void()" : route('user-permissions',$dt->id) }}" id="btn-edit-{{$dt->id}}"
                                                        {{ !empty($dt->deleted_at) ? "onclick=checkPermissionsAlert() " : '' }}
                                                        class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Permissions">
                                                        <i class="fa fa-lock {{ !empty($dt->deleted_at) ? ' text-danger': '' }}" aria-hidden="true"></i>
                                                    </a>
                                                    @if(empty($dt->deleted_at))
                                                    <form action="{{route('users.destroy',$dt->id)}}" id="users_delete_{{$dt->id}}" method="post" class="d-inline-block">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" onclick="deleteUser(this,'{{ $dt->id }}')" id="btn-{{$dt->id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Activated">
                                                            {{--<i class="fa fa-trash-o text-danger" aria-hidden="true"></i>--}}
                                                            <i class="fa fa-toggle-on text-success" aria-hidden="true"></i>
                                                            {{--Deactivate--}}
                                                        </button>
                                                    </form>
                                                    @else
                                                        <a  href="{{ route('user-inactive',$dt->id) }}" id="btn-edit-{{$dt->id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Deactivated">
                                                            {{--<i class="fa fa-pencil" aria-hidden="true"></i>--}}
                                                            <i class="fa fa-toggle-off text-danger" aria-hidden="true"></i>
                                                        </a>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr rowspan="3">
                                            <td>No Data</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--end: Datatable -->
                </div>
            </div>	</div>
        <!-- end:: Content -->
    </div>
@endsection
@section('scripts')
    <script>
        function deleteUser(ths,id){

            if(confirm("Are you sure") == true) {

                var trid = "tr-" + id;
                var btnid = "btn-" + id;
                trid = trid.split('-');
                btnid = btnid.split('-');
                if (id == trid[1] && btnid['1'] == id && $(ths).attr('id') == 'btn-'+id) {
                    $('#users_delete_' + id).submit();
                }else{
                    alert("sorry there are something wrong");
                }
            }
        }
        function editAlert(){

            alert("sorry user is deactivated please activate the user before edit or update ");
        }
        function checkPermissionsAlert(){

            alert("sorry user is deactivated please activate the user for check permissions");
        }
    </script>
@endsection