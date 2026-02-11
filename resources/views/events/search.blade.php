
@extends('layouts.filter')
@section('content')
    <div class="container" style="margin-top: 55px;">
        <div class="row justify-content-center">
            <div class="container margin_60">
                <div class="row">
                    <aside class="col-lg-3">
                        <!-- Фильтры -->
                        <div id="filters_col">
                            <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false"
                               aria-controls="collapseFilters" id="filters_col_bt">
                                <i class="icon_set_1_icon-65"></i>
                                {{ __('translate.Filters') }}
                            </a>
                            <div class="collapse show" id="collapseFilters">
                                <div class="filter-type">
                                    <input type="text" class="form-control" id="firstname_booking" name="term"
                                           value="" placeholder="Search by name, description ...">
                                </div>
                                <div class="filter_type">
                                    <h6>Price</h6>
                                    <input type="text" id="range" name="price" value=""
                                           data-from="0" data-to="100" class="irs-hidden-input" tabindex="-1" readonly="">
                                </div>
                            </div>
                        </div>
                        <!-- Помощь -->
                        <div class="box_style_2">
                            <i class="icon_set_1_icon-57"></i>
                            <h4>Need <span>Help?</span></h4>
                            <a href="tel://+970599593301" style="font-size: 12px;" class="phone">+38(099)217-5697</a>
                            <small>Monday to Friday 9.00am - 7.30pm</small>
                        </div>
                    </aside>
                    <!-- Список событий -->
                    <div class="col-lg-9">
                        <div id="tools">
                            <div class="row">
                                <div class="col-md-3 col-sm-4 col-6"></div>
                                <div class="col-md-6 col-sm-4 d-none d-sm-block text-right ml-auto">
                                    <span style="font-size: 20px;">{{ __('translate.All events') }} 23 789</span>
                                </div>
                            </div>
                        </div>
                        @foreach($events as $event)
                            <div class="row" style="min-height:233px; border: 1px solid #dddddd; border-radius: 5px;">
                                <div class="col-lg-4 col-md-4">
                                    <div class="ribbon_3 popular">
                                        <span>{{ $event->discounte ? '- ' . $event->discounte . '%' : 'FREE' }}</span>
                                    </div>
                                    <div class="img_list">
                                        <a href="{{ url('/tours/' . $event->id) }}">
                                            <img src="{{ $event->first_image_path }}" alt="Image">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="tour_list_desc">
                                        <div class="rating">
                                            <i class="icon-smile"></i>
                                            <i class="icon-smile"></i>
                                            <i class="icon-smile"></i>
                                            <i class="icon-smile"></i>
                                            <i class="icon-smile"></i>
                                        </div>
                                        <a href="{{ url('/tours/' . $event->id) }}" class="tour_title">
                                            <strong>{{ $event->title }}</strong>
                                        </a>
                                        <p>{!! $event->short_description !!}</p>
                                        <i style="font-size: