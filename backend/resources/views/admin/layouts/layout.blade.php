<!-- /resources/views/admin/layouts/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Admin Panel')</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
</head>
<body>
  <div class="container">
    @include('admin.layouts.sidebar') <!-- Sidebar inclusion -->

    <div class="content">
      @yield('content') <!-- Content section where the individual pages will load -->
    </div>
  </div>
</body>
</html>
