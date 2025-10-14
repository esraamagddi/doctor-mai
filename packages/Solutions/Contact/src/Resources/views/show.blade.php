@extends('core::layouts.backend')

@push('title')
    {{ __('contact::messages.contact_messages') }}
@endpush

@section('content')
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="/cp"><i class="fa fa-home"></i></a></li>
        <li><a href="{{ route('contact.index') }}">{{ __('contact::messages.contact_messages') }}</a></li>
        <li>{{ __('contact::messages.show') }}</li>
    </ul>

    <div class="block full">
        <div class="block-title d-flex align-items-center justify-content-between">
            <h2 class="m-0"><strong>{{ __('contact::messages.message') }} #{{ $message->id }}</strong></h2>
            <div class="block-options pull-right">
                <a href="{{ route('contact.index') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-arrow-left me-1"></i> {{ __('contact::messages.back') }}
                </a>
            </div>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="m-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif

        <div class="row">
            {{-- المحتوى الرئيسي --}}
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title" style="line-height:1.4">
                            {{ $message->subject ?: __('contact::messages.no_subject') }}
                        </h3>
                        <small class="text-muted pull-right">
                            <i class="fa fa-clock-o"></i>
                            {{ $message->created_at->format('Y-m-d H:i') }}
                        </small>
                    </div>

                    <div class="panel-body">
                        {!! nl2br(e($message->message)) !!}
                    </div>
                </div>
            </div>

            {{-- الشريط الجانبي --}}
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>{{ __('contact::messages.details') }}</strong>
                    </div>

                    <div class="panel-body">
                        <table class="table table-condensed m-b-0">
                            <tr>
                                <th>{{ __('contact::messages.from') }}</th>
                                <td>{{ $message->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('contact::messages.email') }}</th>
                                <td>
                                    @if ($message->email)
                                        <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('contact::messages.phone') }}</th>
                                <td>
                                    @if ($message->phone)
                                        <a
                                            href="tel:{{ preg_replace('/\s+/', '', $message->phone) }}">{{ $message->phone }}</a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('contact::messages.status') }}</th>
                                <td>
                                    @if ($message->is_read)
                                        <span class="label label-success">{{ __('contact::messages.read') }}</span>
                                    @else
                                        <span class="label label-default">{{ __('contact::messages.unread') }}</span>
                                    @endif
                                </td>
                            </tr>
                        </table>


                        @if (is_array($message->attachments) && count($message->attachments))
                            <hr>
                            <p class="m-b-5"><strong>{{ __('contact::messages.attachments') }}</strong></p>
                            <ul class="list-unstyled">
                                @foreach ($message->attachments as $file)
                                    <li>
                                        <i class="fa fa-paperclip"></i>
                                        <a href="{{ asset('storage/' . $file) }}" target="_blank">{{ basename($file) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <hr>

                        {{-- أزرار الأكشنز --}}
                        <div class="btn-toolbar" role="toolbar">
                            <div class="btn-group" role="group">
                                <form action="{{ route('contact.mark', $message) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="read" value="{{ $message->is_read ? 0 : 1 }}">
                                    <button class="btn btn-default btn-sm">
                                        <i class="fa fa-check-square-o"></i>
                                        {{ $message->is_read ? __('contact::messages.mark_as_unread') : __('contact::messages.mark_as_read') }}
                                    </button>
                                </form>
                            </div>

                            <div class="btn-group" role="group">
                                <form action="{{ route('contact.destroy', $message) }}" method="post"
                                    onsubmit="return confirm('{{ __('contact::messages.confirm_delete') }}')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> {{ __('contact::messages.delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div> {{-- /panel-body --}}
                </div>
            </div>
        </div>

    </div>
@endsection
