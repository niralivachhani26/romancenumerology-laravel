@php
	$ads = getPageAds();
@endphp

@extends('front.layout.main')

@push('styles')
	<link
        href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{!! asset('assets/front/love-aura/css/style.css?v='.time()) !!}">	
@endpush

@section('content')
	<div class="rose_page">
        <section class="banner_main">
            <div class="container">
                @if (!empty($ads->horizontal_ad))
                    <div class="ad-section">
                        {!! $ads->horizontal_ad !!}
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner_box text-center">
                            <h1 class="title">I sense a change in your aura today… What could it be?</h1>
                            <img class="image-1" src="{!! asset('assets/front/love-aura/images/img-1.png') !!}" alt="">
                            <p class="sub_title mb-4 pb-2">Tap on the aura to reveal your love message</p>
                        </div>
                    </div>
                </div>
                @if (!empty($ads->multiplex_ad))
                    <div class="multiplex-ad-section mb-4 pb-2">
                        {!! $ads->multiplex_ad !!}
                    </div>
                @elseif (!empty($ads->horizontal_ad))
                    <div class="multiplex-ad-section">
                        {!! $ads->horizontal_ad !!}
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection

@push('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".image-1").click(function () {
                $(this).attr("src", "{!! asset('assets/front/love-aura/images/img-2.png') !!}");
                $(this).attr("class", "image-2");

                setTimeout(function () {
                    window.location.href = "{!! URL::to('love-aura/result') !!}";
                }, 2000);
            });
        });
    </script>
@endpush