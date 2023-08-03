<!DOCTYPE html>
<html lang="en">

<head>

    @include('includes.frontsite.meta')

    <title>@yield('title') | E-Laporan</title>

    @stack('before-style')
    @include('includes.frontsite.style')
    @stack('after-style')

</head>

<body>
    @include('sweetalert::alert')
    
    @yield('content')
</body>

</html>
