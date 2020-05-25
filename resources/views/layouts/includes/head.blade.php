<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>UKSGS - Sistem pemeriksaan uks berbasis web</title>

<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="{{ asset('limitless/global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('limitless/global_assets/css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('limitless/layout_1/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('limitless/layout_1/assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('limitless/layout_1/assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('limitless/layout_1/assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('limitless/layout_1/assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">

@yield('librariesCSS')

@yield('css')

@stack('css')