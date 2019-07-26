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
                            User Permissions
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-elevate btn-icon-sm">Back</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
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
                                    @if(!empty($dataArray))
                                        @foreach($dataArray as $key => $dt)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $dt['module'] }}</td>
                                                <td>
                                                    @foreach($dt['permissions'] as $per)
                                                        <a href="javascript:void(0)">{{ $per['permission'].' ' }}</a>
                                                    @endforeach
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
@endsection