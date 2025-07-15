<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Staff Panel - Reward System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    @stack('styles')
</head>
<body class="bg-gray-100 p-8 font-sans">

    <header class="mb-10">
        @include('staff.layouts.header')
    </header>

    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
