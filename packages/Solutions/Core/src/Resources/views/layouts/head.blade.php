<head>
    <meta charset="utf-8">
    <title>Corpintech | @stack('title')</title>
    <meta name="description" content="Corpintech">
    <meta name="author" content="Corpintech">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/backend/img/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/backend/img/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/backend/img/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/backend/img/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/backend/img/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/backend/img/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/backend/img/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/backend/img/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/backend/img/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/backend/img/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/backend/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/backend/img/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/backend/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/backend/img/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#fd7032">
    <meta name="msapplication-TileImage" content="{{ asset('assets/backend/img/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#fd7032">
    <link rel="shortcut icon" href="{{ asset('assets/backend/img/favicon/favicon.png') }}">
    @if($dir === 'ltr')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/bootstrap-ltr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/main-ltr.css') }}?v={{ time() }}">
    @elseif($dir === 'rtl')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/bootstrap-rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/main-rtl.css') }}?v={{ time() }}">
    @endif
    <link rel="stylesheet" href="{{ asset('assets/backend/css/themes.css') }}">
    <script src="{{ asset('assets/backend/js/vendor/modernizr.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <style>


.file-input:focus {
    outline: none !important;
    border-color: #004080 !important;
    box-shadow: 0 0 5px rgba(0,64,128,0.5) !important;
}

.file-input::-webkit-file-upload-button {
    background-color: #e56442 !important;
    color: #fff !important;
    border: none !important;
    border-radius: 4px !important;
    cursor: pointer !important;
    transition: background-color 0.3s ease !important;
}

.file-input::-webkit-file-upload-button:hover {
    background-color: #e56442 !important;
}

.file-input::file-selector-button {
    background-color: #e56442 !important;
    color: #fff !important;
    border: none !important;
    padding: 6px 12px !important;
    border-radius: 4px !important;
    cursor: pointer !important;
    transition: background-color 0.3s ease !important;
    
}

.file-input::file-selector-button:hover {
    background-color: #e56442 !important;
}
input[type="file"] {
    padding-top: 0px !important;
    margin-bottom: 1rem !important; 
}
    @stack('styles')
   
</style>
</head>