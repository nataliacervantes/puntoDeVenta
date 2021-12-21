<!DOCTYPE html>
<html lang="en">
    @include('layouts.head')
    <body>
        @include('layouts.header')
        <!-- START MAIN CONTENT -->
        <div class="main_content">
            @yield('content')

        </div>
        <!-- END MAIN CONTENT -->
        @include('layouts.scripts')
        @yield('scripts')
    </body>
</html>
