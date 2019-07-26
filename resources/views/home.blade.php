@extends('layouts.super-admin')
@section('contents')

    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="col-xl-4 col-lg-6 order-lg-2 order-xl-1">
        <!--begin:: Widgets/Audit Log-->
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Settings
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane active" id="kt_widget4_tab11_content">
                        <div class="kt-scroll ps ps--active-y" data-scroll="true">
                            <div class="kt-list-timeline">
                                <div class="kt-list-timeline__items">
                                    <div class="kt-list-timeline__item">
                                        <span class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>
                                        <span class="kt-list-timeline__text">
                                                <a href="{{ route('modules.index') }}">Modules</a>
                                        </span>
                                        {{--<span class="kt-list-timeline__time">Just now</span>--}}
                                    </div>
                                    <div class="kt-list-timeline__item">
                                        <span class="kt-list-timeline__badge kt-list-timeline__badge--info"></span>
                                        <span class="kt-list-timeline__text">
                                            <a href="{{ route('user-role.index') }}">User Roles</a>
                                        </span>
                                        {{--<span class="kt-list-timeline__time">14 mins</span>--}}
                                    </div>
                                    <div class="kt-list-timeline__item">
                                        <span class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>
                                        <span class="kt-list-timeline__text">
                                            <a href="{{ route('locations.index') }}">Locations</a>
                                        </span>
                                        {{--<span class="kt-list-timeline__time">20 mins</span>--}}
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
    </div>
@endsection
