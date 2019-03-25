<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>티스토리 이웃 서비스, 티네스(Tines) @yield('title')</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="티스토리 이웃 서비스, 티네스(Tines)">
        <meta name="author" content="정만수">
        <meta name="keywords" content="티스토리, 티스토리 이웃, 티네스, TISTORY, Tines">

        <meta property="og:title" content="티스토리 이웃 서비스, 티네스(Tines)">
        <meta property="og:description" content="티스토리 이웃 서비스, 티네스(Tines)">
        <meta property="og:url" content="https://tines.kr">
        <meta property="og:site_name" content="Tines">
        <meta property="og:image" content="/images/og.png">

        {{-- Naver WebMaster --}}
        <meta name="naver-site-verification" content="1412f18c229e542a283cddee3e0d2353abedac3e"/>
        {{-- Google Search Console --}}
        <meta name="google-site-verification" content="N6eKnoibZ5TWYTT38T55jQ0NIGy6Yg1KZwlVYQTWm_E" />
        
        <link rel="shortcut icon" href="/images/favicon.png">
        <link rel="apple-touch-icon" href="/images/76x76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="/images/120x120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="/images/152x152.png" sizes="152x152">
        <link rel="apple-touch-icon" href="/images/180x180.png" sizes="180x180">
        
        {{-- Font --}}
        <link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/notosanskr.css">
        <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.4.1/css/solid.css">
        <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.4.1/css/fontawesome.css">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
        {{-- Toast --}}
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        {{-- resources/styl/app.styl --}}
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        {{-- AdSense --}}
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({
                google_ad_client: "ca-pub-2513331130923231",
                enable_page_level_ads: true
            });
        </script>
    </head>
    <body>
        <div id="app">
            {{-- Navigation --}}
            <app-navigation
                is_logined = "{{ $auth->check() }}"
                profile_image_url = "{{
                    $auth->check()
                        ? $auth->user()->blogs()
                            ->where('default', '=', '1')
                            ->first()
                            ->profileImageUrl
                        : null
                }}"
            ></app-navigation>
            
            {{-- Header --}}
            <app-header :recommends = "{{ json_encode($recommends) }}"></app-header>

            {{-- Added components --}}
            @yield('components')

            {{-- Main -> Thumbnail, Post --}}
            @yield('main')

            {{-- AdSense --}}
            {{-- <AdSense             
                data-ad-client="ca-pub-2513331130923231"
                data-ad-slot="5438558587">
            </AdSense> --}}

            {{-- Footer --}}
            <app-footer></app-footer>
        </div>
        {{-- jQuery --}}
        <script src="//code.jquery.com/jquery-3.3.1.js"></script>
        {{-- Toast --}}
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        {{-- resources/js/app.js --}}
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>