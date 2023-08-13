<!DOCTYPE html>
<html lang="en">

<head>
    @include('sitelayouts.includes.head')
</head>

<body class="sb-nav-fixed">


    @include('sitelayouts.includes.nav')


    <div id="layoutSidenav">

        @include('sitelayouts.includes.sidebar')


        <div id="layoutSidenav_content">
            <main>
                @yield('main-contents')
            </main>


            @include('sitelayouts.includes.footer')


        </div>
    </div>

</body>


@include('sitelayouts.includes.scripts')

</html>