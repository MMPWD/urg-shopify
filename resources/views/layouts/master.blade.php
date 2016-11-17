<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.head')

<body>


<div id="picker-container" style="z-index: 99999999;"></div>



<div class="page-wrapper" id="@yield('pageId')">


        @include('layouts.partials.header')




    <div class="main-wrapper">

        @include('layouts.partials.headings')

        <div class="content-wrapper">

            @yield('content')

        </div>


    </div>


</div>

@include('layouts.partials.footer')

@include('layouts.partials.scripts')


</body>
</html>