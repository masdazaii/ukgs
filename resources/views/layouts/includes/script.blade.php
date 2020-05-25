<script src="{{ asset('limitless/global_assets/js/main/jquery.min.js') }}"></script>
<script src="{{ asset('limitless/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('limitless/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
<script src="{{ asset('limitless/global_assets/js/plugins/ui/ripple.min.js') }}"></script>
<!-- /core JS files -->

<script src="{{ asset('limitless/layout_1/assets/js/app.js') }}"></script>
<!-- /theme JS files -->

@yield('librariesJS')

@yield('script')

@stack('script')