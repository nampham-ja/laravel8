@extends('web.layouts.web_master')

@section('main_content')
    <!-- ======= About Section ======= -->
    @include('web.home.about_home')
    <!-- End About Section -->

    <!-- ======= Services Section ======= -->
    @include('web.home.services_home')
    <!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    @include('web.home.portfolio_home')
    <!-- End Portfolio Section -->

    <!-- ======= Our Clients Section ======= -->
    @include('web.home.clients_home')
    <!-- End Our Clients Section -->
@endsection
