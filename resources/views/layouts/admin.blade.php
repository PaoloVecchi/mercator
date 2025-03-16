<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trans('panel.site_title') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body>
    @include('partials.navbar')
    <div class="d-flex">
    @include('partials.sidebar')
        <div id="content-home" class="content flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>
    <script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('sidebar-hidden');
        document.getElementById('content-home').classList.toggle('content-expanded');
    }
    </script>
    @yield('scripts')
    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</body>
</html>
