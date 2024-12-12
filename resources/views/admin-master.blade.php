<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.admin.head')
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-dark position-absolute w-100"></div>
    @include('layouts.admin.sidebar')
    <main class="main-content position-relative border-radius-lg ">
        @include('layouts.admin.nav')
        @yield('content')
    </main>
    @include('layouts.admin.scripts')
</body>

</html>
