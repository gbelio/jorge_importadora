<!DOCTYPE html>
<html lang="en">
    @include('layouts.partials.head')
    <body>    
        @include('layouts.partials.navbar')
        @yield('content')
        @include('layouts.partials.footer')
        @include('layouts.partials.scripts')     
    </body>
</html>


