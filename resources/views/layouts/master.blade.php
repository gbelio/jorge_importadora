<!DOCTYPE html>
<html lang="en">
    @include('layouts.partials.head')
    <body style="background-color:#f4f4f4;">    
        @include('layouts.partials.navbar')
        @yield('content')
        @include('layouts.partials.footer')
        @include('layouts.partials.scripts')
        @yield('scripts')
    </body>
</html>