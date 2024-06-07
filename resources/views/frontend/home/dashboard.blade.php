@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} || e-Commerce HTML Template
@endsection

@section('content')
    <!--============================
                                                                            BANNER PART 2 START
                                                                        ==============================-->
    @include('frontend.home.section.slider')
    <!--============================
                                                                            BANNER PART 2 END
                                                                        ==============================-->


    <!--============================
                                                                            FLASH SELL START
                                                                        ==============================-->
    @include('frontend.home.section.flash')
    <!--============================
                                                                            FLASH SELL END
                                                                        ==============================-->


    <!--============================
                                                                           MONTHLY TOP PRODUCT START
                                                                        ==============================-->
    @include('frontend.home.section.top-category-product')
    <!--============================
                                                                           MONTHLY TOP PRODUCT END
                                                                        ==============================-->


    <!--============================
                                                                            BRAND SLIDER START
                                                                        ==============================-->
    @include('frontend.home.section.brand-slider')
    <!--============================
                                                                            BRAND SLIDER END
                                                                        ==============================-->


    <!--============================
                                                                            SINGLE BANNER START
                                                                        ==============================-->
    @include('frontend.home.section.single')
    <!--============================
                                                                            SINGLE BANNER END
                                                                        ==============================-->


    <!--============================
                                                                            HOT DEALS START
                                                                        ==============================-->
    @include('frontend.home.section.hot-deals')
    <!--============================
                                                                            HOT DEALS END
                                                                        ==============================-->


    <!--============================
                                                                            ELECTRONIC PART START
                                                                        ==============================-->
    @include('frontend.home.section.category-product-slider-one')
    <!--============================
                                                                            ELECTRONIC PART END
                                                                        ==============================-->


    <!--============================
                                                                            ELECTRONIC PART START
                                                                        ==============================-->
    @include('frontend.home.section.category-product-slider-two')
    <!--============================
                                                                            ELECTRONIC PART END
                                                                        ==============================-->


    <!--============================
                                                                            LARGE BANNER  START
                                                                        ==============================-->
    @include('frontend.home.section.large-banner')
    <!--============================
                                                                            LARGE BANNER  END
                                                                        ==============================-->


    <!--============================
                                                                            WEEKLY BEST ITEM START
                                                                        ==============================-->
    @include('frontend.home.section.weekly-best-item')
    <!--============================
                                                                            WEEKLY BEST ITEM END
                                                                        ==============================-->


    <!--============================
                                                                          HOME SERVICES START
                                                                        ==============================-->
    {{-- @include('frontend.home.section.home-service') --}}
    <!--============================
                                                                            HOME SERVICES END
                                                                        ==============================-->


    <!--============================
                                                                            HOME BLOGS START
                                                                        ==============================-->
    {{-- @include('frontend.home.section.home-blogs') --}}
    <!--============================
                                                                            HOME BLOGS END
                                                                        ==============================-->
@endsection
