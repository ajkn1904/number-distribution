<!DOCTYPE html>
<html lang="en">

<head>
    @include('SuperAdmin.includes.head')
</head>

<body class="sb-nav-fixed">


    @include('SuperAdmin.includes.nav')


    <div id="layoutSidenav">

        @include('SuperAdmin.includes.sidebar')


        <div id="layoutSidenav_content">
            <main>
                @yield('main-contents')
            </main>


            @include('SuperAdmin.includes.footer')


        </div>
    </div>

</body>


@include('SuperAdmin.includes.scripts')

</html>