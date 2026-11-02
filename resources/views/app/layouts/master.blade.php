<!doctype html>
<html lang="fa" dir="rtl">
<head>
    @include('app.layouts.head-tag')
</head>
<body>


   @include('app.layouts.partials.header')



    @yield('content')



    <!-- start body -->
    <section class="container-xxl body-container">
        <aside id="sidebar" class="sidebar">

        </aside>
        <main id="main-body" class="main-body">

        </main>
    </section>  
    <!-- end body -->


@include('app.layouts.partials.footer')
@include('app.layouts.scripts')
</body>
</html>