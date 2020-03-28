<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@yield('title')</title>
    @include('admin.partials._header')
    @yield('stylesheets')
  
  </head>
  <body id="page-top">
     <div id="wrapper">

        @include('admin.partials._sidebar')

    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">

          <div id="content-wrapper" class="d-flex flex-column">
              <!-- Main Content -->
              <div id="content">
                   @include('admin.partials._navbar')
      <div>@include('partials._message')</div>
                   
                   @yield('content')
              </div>
          </div>

     </div>

  @include('admin.partials._scripts')
	@yield('scripts')
  </body>
</html>