<!DOCTYPE html>
<html lang="en">
<head>
  @include('layouts.includes.head')
  <!-- /global stylesheets -->

  @include('layouts.includes.script')

</head>

<body>

  <!-- Main navbar -->
  @include('layouts.includes.navbar')
  <!-- /main sidebar -->
  <div class="page-content">
    @include('layouts.includes.menu')
    <!-- Main content -->
    <div class="content-wrapper">

      <!-- Page header -->
      
      <!-- /page header -->


      <!-- Content area -->
      <div class="content">
        @yield('content')
      </div>
      <!-- /content area -->

      <!-- Footer -->
      @include('layouts.includes.footer')
      <!-- /footer -->

    </div>
    <!-- /main content -->

  </div>
  <!-- /page content -->

</body>
</html>
