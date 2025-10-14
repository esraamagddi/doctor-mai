<!DOCTYPE html>
<!--[if IE 9]><html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="{{ app()->getLocale() }}" dir="{{ $dir ?? 'ltr' }}"> <!--<![endif]-->
    @include('core::layouts.head')

<body>
    <div id="page-wrapper">
        <div class="preloader themed-background">
            <h1 class="push-top-bottom text-light text-center"><strong>corpintech</strong></h1>
            <div class="inner">
                <h3 class="text-light visible-lt-ie10"><strong>Loading..</strong></h3>
                <div class="preloader-spinner hidden-lt-ie10"></div>
            </div>
        </div>

        <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">

            <!-- Main Sidebar -->
            @include('core::layouts.sidebar')
            <!-- END Main Sidebar -->

            <!-- Main Container -->
            <div id="main-container">


                <!-- END Header -->
                @include('core::layouts.header')
                <!-- Page content -->
                <div id="page-content">
                    <!-- Dashboard Header -->
                    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->
                    @yield('content')
                </div>
                <!-- END Page Content -->

                <!-- Footer -->

                <!-- END Footer -->
            </div>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
    </div>
    <!-- END Page Wrapper -->

    @include('core::layouts.scripts')

</body>

</html>