<!DOCTYPE html>
<html lang="en">
    @include('layouts.partials.head')
    <body style="background-color:#f4f4f4;">
        @include('layouts.partials.navbar')
        <div style="min-height: 55vh">
            @yield('content')
        </div>
        @include('layouts.partials.footer')
        @include('layouts.partials.scripts')
        @yield('scripts')
    </body>
</html>
