@php
    $ads = getPageAds();
@endphp

@extends('front.layout.main')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/front/soulmate-number/css/style.css?' . time()) }}">
@endpush

@section('content')
    <section class="eleven_phase pad_120" id="eleven-phase">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="discover_more text-center">
                        <img src="{{ asset('assets/front/soulmate-number/images/phase-10.webp') }}" alt="">
                        <button class="btn btn-primary click_fun">Discover More Love Insights</button>
                    </div>
                    <div class="dialog_box">
                        <p>Thank you for trusting me with your journey. Check your email for the complete reading and more love secrets!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>

    <script>
        $(document).ready(function () {
            $(".click_fun").click(function () {
                var slugs = '{!! $reportData->code !!}';
                window.location.href = "{{ URL::to('soulmate-number/report') }}/"+slugs;
            });
        });
    </script>
@endpush
<?php /* 
@php
    $ads = getPageAds();
@endphp

@extends('front.layout.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/front/css/home.css?' . time()) }}">
@endpush

@section('content')
    <div class="home-page-main">
        <section class="section-main">
            <div class="main-home-heading">
                <h1>Thanks You</h1>
                <div class="div-heading-line"></div>
                <br>
                <div class="row">
                    <div class="col-12 text-center">
                        <button class="btn btn-success click_fun" type="submit"><span class="w-100">View Report</span></button>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function () {
            $(".click_fun").click(function () {
                var slugs = '{!! $reportData->code !!}';
                window.location.href = "{{ URL::to('soulmate-number/report') }}/"+slugs;
            });
        });
    </script>
@endpush
*/ ?>