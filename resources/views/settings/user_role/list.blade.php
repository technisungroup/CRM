@extends('layouts.super-admin')
@section('contents')
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="alert alert-success">
            {{ \Illuminate\Support\Facades\Session::get('success') }}
        </div>
    @endif
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">


            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            User Role List
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">

                                <a href="{{ route('user-role.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                    ADD New Record
                                </a>

                                <a href="{{ route('home') }}" class="btn btn-secondary btn-elevate btn-icon-sm">Back</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        {{--<div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="kt_table_1_length">
                                    <label>Show
                                        <select name="kt_table_1_length" aria-controls="kt_table_1" class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="kt_table_1_filter" class="dataTables_filter">
                                    <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="kt_table_1"></label>
                                </div>
                            </div>
                        </div>--}}
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="" role="grid" aria-describedby="kt_table_1_info">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!$data->isEmpty())
                                        @foreach($data as $key => $dt)
                                            <tr class="tr-{{$dt->id}}">
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $dt->title }}</td>
                                                <td>
                                                    <a  href="{{ route('user-role.edit',$dt->id) }}" id="btn-edit-{{$dt->id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>

                                                    <form action="{{route('user-role.destroy',$dt->id)}}" id="user-role_delete_{{$dt->id}}" method="post" class="d-inline-block">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" onclick="deleteUserRole(this,'{{ $dt->id }}')" id="btn-{{$dt->id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                                            <i class="fa fa-trash-o text-danger" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
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
                        {{-- <div class="row">
                             <div class="col-sm-12 col-md-5">
                                 <div class="dataTables_info" id="kt_table_1_info" role="status" aria-live="polite">
                                     Showing 1 to 10 of 50 entries
                                 </div>
                             </div>
                             <div class="col-sm-12 col-md-7">
                                 <div class="dataTables_paginate paging_simple_numbers" id="kt_table_1_paginate">
                                     <ul class="pagination">
                                         <li class="paginate_button page-item previous disabled" id="kt_table_1_previous"><a href="#" aria-controls="kt_table_1" data-dt-idx="0" tabindex="0" class="page-link"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
                                         <li class="paginate_button page-item active"><a href="#" aria-controls="kt_table_1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                         <li class="paginate_button page-item "><a href="#" aria-controls="kt_table_1" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                         <li class="paginate_button page-item "><a href="#" aria-controls="kt_table_1" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                         <li class="paginate_button page-item "><a href="#" aria-controls="kt_table_1" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                         <li class="paginate_button page-item "><a href="#" aria-controls="kt_table_1" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                         <li class="paginate_button page-item next" id="kt_table_1_next"><a href="#" aria-controls="kt_table_1" data-dt-idx="6" tabindex="0" class="page-link"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                     </ul>
                                 </div>
                             </div>
                         </div>--}}
                    </div>
                    <!--end: Datatable -->
                </div>
            </div>	</div>
        <!-- end:: Content -->
    </div>
@endsection
@section('scripts')
    <script>
        function deleteUserRole(ths,id){

            if(confirm("Are you sure") == true) {

                var trid = "tr-" + id;
                var btnid = "btn-" + id;
                trid = trid.split('-');
                btnid = btnid.split('-');
                if (id == trid[1] && btnid['1'] == id && $(ths).attr('id') == 'btn-'+id) {
                    $('#user-role_delete_' + id).submit();
                }else{
                    alert("sorry there are something wrong");
                }
            }
        }
    </script>
@endsection