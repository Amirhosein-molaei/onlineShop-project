<!doctype html>
<html lang="fa" dir="rtl">
<head>
    @include('auth.layouts.head-tag')
    <title>
        @yield('title')
    </title>
</head>
<body>

    @yield('content')
    
    @include('auth.layouts.scripts')
</body>
</html>