<!DOCTYPE html>
<html lang="en">
{{-- @php
    $ads = getPageAds();
@endphp --}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php
        $slug = request()->path();
        // App\Helpers::logPageDetails($slug);
        if(!isset($seo) || empty($seo)){
            $seo = getMetaData($slug);
        }
    @endphp
    @if (isset($seo) && !empty($seo))

        <title>{{ $seo->meta_title }}</title>
        <meta name="description" content="{{ $seo->meta_description }}" />
        <meta name="keywords" content="{{ $seo->meta_keyword }}" />
        <link rel="canonical" href="{{ url("$slug") }}" />

        <meta property="og:title" content="{{ $seo->meta_title }}" />
        <meta property="og:image" content="{{ $seo->getImage() }}">
        <meta property="og:description" content="{{ $seo->meta_description }}" />
        <meta property="og:url" content="{{ url("$slug") }}" />
        <meta property="og:site_name" content="{{ env('APP_NAME') }}" />

        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:image" content="{{ $seo->getImage() }}" />
        <meta name="twitter:site" content="{{ env('APP_NAME') }}" />
        <meta name="twitter:creator" content="{{ env('APP_NAME') }}" />
        <meta name="twitter:title" content="{{ $seo->meta_title }}" />
        <meta name="twitter:description" content="{{ $seo->meta_description }}" />
    @else

        <title>{{ env('APP_NAME') }}</title>

    @endif
    <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '3205220713112180'); // Replace with your pixel ID
    fbq('track', 'PageView'); // Tracks page views
    fbq('track', 'Lead'); // Tracks leads
    </script>
    <noscript>
    <img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=3205220713112180&ev=PageView&noscript=1"
    />
    <img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=3205220713112180&ev=Lead&noscript=1"
    />
    </noscript>
    <!-- End Meta Pixel Code -->
    <link rel="shortcut icon" href="{{ url('quiz/public/assets/front/images/Logo-Cosmic-1.png') }}" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/fontawesome-free/css/all.min.css')}}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="{{asset('assets/admin/plugins/nprogress/nprogress.css')}}" rel="stylesheet" />
    <script src="{{asset('assets/admin/plugins/nprogress/nprogress.js')}}"></script>
    <link href="{{asset('assets/admin/plugins/toaster/toastr.min.css')}}" rel="stylesheet" />
    <script src="{{asset('assets/admin/plugins/toaster/toastr.min.js')}}"></script>

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/front/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/layout.css?'). time() }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/common.css?'). time() }}">

    {{-- Montserrat --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    {{-- Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    {{-- Lora --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @stack('styles')

    @if (!empty($ads->header_script))
        {!! $ads->header_script !!}
    @endif

    <script>
        $(document).ready(function(){
            setTimeout(() => {
                $('img').attr('loading', '');
            }, 2000);
        });
    </script>
    @if (!isset($withOutHeader) || $withOutHeader != true)
        <script async src="https://fundingchoicesmessages.google.com/i/pub-6794512269391342?ers=1" nonce="7Q9CAshGAcMtP2N4VwKiEQ"></script><script nonce="7Q9CAshGAcMtP2N4VwKiEQ">(function() {function signalGooglefcPresent() {if (!window.frames['googlefcPresent']) {if (document.body) {const iframe = document.createElement('iframe'); iframe.style = 'width: 0; height: 0; border: none; z-index: -1000; left: -1000px; top: -1000px;'; iframe.style.display = 'none'; iframe.name = 'googlefcPresent'; document.body.appendChild(iframe);} else {setTimeout(signalGooglefcPresent, 0);}}}signalGooglefcPresent();})();</script>
    @endif
</head>

<body>
    {{-- @php
        echo '<pre>';
        print_r($ads);
        die();
    @endphp --}}
    <script>
        NProgress.configure({ showSpinner: false });
        NProgress.start();
    </script>


    @if (!isset($withOutHeader) || $withOutHeader != true)
        @include('front.include.navbar')
    @endif

    <div class="">
        @if (!empty($ads->vertical_ad))
            <div class="vertical-ad left-ads">
                {!! $ads->vertical_ad !!}
            </div>
            <div class="vertical-ad right-ads">
                {!! $ads->vertical_ad !!}
            </div>
        @endif

        @yield('content')
    </div>

    @if (!isset($withOutFooter) || $withOutFooter != true)
        @include('front.include.footer')
    @endif


    <script src="{{ asset('assets/front/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @if (!empty($ads->footer_script))
        {!! $ads->footer_script !!}
    @endif


    @stack('scripts')

    <script>
        $(document).ready(function(){
            NProgress.done();
        });
    </script>

</body>

</html>
