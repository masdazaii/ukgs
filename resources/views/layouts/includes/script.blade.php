<script src="{{ asset('limitless/global_assets/js/main/jquery.min.js') }}"></script>
<script src="{{ asset('limitless/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('limitless/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
<script src="{{ asset('limitless/global_assets/js/plugins/ui/ripple.min.js') }}"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script src="{{ asset('limitless/global_assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
<script src="{{ asset('limitless/global_assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
<script src="{{ asset('limitless/global_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
<script src="{{ asset('limitless/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
<script src="{{ asset('limitless/global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
<script src="{{ asset('limitless/global_assets/js/plugins/pickers/daterangepicker.js') }}"></script>

<script src="{{ asset('limitless/layout_1/assets/js/app.js') }}"></script>
<script src="{{ asset('limitless/global_assets/js/demo_pages/dashboard.js') }}"></script>
<!-- /theme JS files -->

@yield('librariesJS')

@yield('script')

@stack('script')