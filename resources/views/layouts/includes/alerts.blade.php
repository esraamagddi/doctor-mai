<script>
    @if (session('failed'))
        show_toastr('{{ __('Failed!') }}', '{{ session('failed') }}', 'failed');
    @endif
    @if ($errors = session('errors'))
        @if (is_object($errors))
            @foreach ($errors->all() as $error)
                show_toastr('{{ __('Error!') }}', '{{ $error }}', 'danger');
            @endforeach
        @else
            show_toastr('{{ __('Error!') }}', '{{ session('errors') }}', 'danger');
        @endif
    @endif
    @if (session('successful'))
        show_toastr('{{ __('Successfully!') }}', '{{ session('successful') }}', 'success');
    @endif
    @if (session('success'))
        show_toastr('{{ __('Success!') }}', '{{ session('success') }}', 'success');
    @endif
    @if (session('warning'))
        show_toastr('{{ __('Warning!') }}', '{{ session('warning') }}', 'warning');
    @endif
    @if (session('status'))
        show_toastr('{{ __('Great!') }}', '{{ session('status') }}', 'info');
    @endif
</script>

<script>
    $(document).on('click', '.delete-action', function() {
        var form_id = $(this).attr('data-form-id');
        $.confirm({
            title: '{{ __('Alert!') }}',
            content: '{{ __('Are you sure?') }}',
            buttons: {
                confirm: function() {
                    $("#" + form_id).submit();
                },
                cancel: function() {}
            }
        });
    });
</script>

<script>
    const sweetAlert = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success m-1',
            cancelButton: 'btn btn-danger m-1'
        },
        buttonsStyling: false,
        title: '{{ __("Are you sure ?") }}',
        text: '{{ __("This action cannot be undone. Do you want to continue?") }}',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '{{ __('Next Page') }}',
        cancelButtonText: '{{ __('No') }}',
        reverseButtons: true
    });
</script>
