{{-- Core --}}
<script src="{{ asset('assets/backend/js/vendor/jquery.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/plugins.js') }}"></script>
<script src="{{ asset('assets/backend/js/app.js') }}"></script>

<script src="{{ asset('assets/backend/js/pages/index.js') }}"></script>
<script>jQuery(function () { if (window.Index && Index.init) Index.init(); });</script>

<link rel="stylesheet" href="{{ asset('assets/backend/js/helpers/ckeditor/skins/bootstrapck/editor.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/js/helpers/ckeditor/plugins/copyformatting/styles/copyformatting.css') }}">

<script src="{{ asset('assets/backend/js/helpers/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/backend/js/helpers/ckeditor/config.js') }}"></script>
<script src="{{ asset('assets/backend/js/helpers/ckeditor/lang/en.js') }}"></script>
<script src="{{ asset('assets/backend/js/helpers/ckeditor/styles.js') }}"></script>

<script src="{{ asset('assets/backend/js/ckeditor-init.js') }}"></script>
@stack('scripts')