@extends('core::layouts.backend')

@push('title') {{ __('faqs::messages.categories') }} @endpush
@section('content')
<ul class="breadcrumb breadcrumb-top">
  <li><a href="/cp"><i class="fa fa-home"></i></a></li>
  <li><a href="{{ route('faqs.categories.index') }}">{{ __('faqs::messages.categories') }}</a></li>
  <li>{{ __('faqs::messages.add') }}</li>
</ul>

<div class="block full">
  <div class="block-title d-flex align-items-center justify-content-between">
    <h2 class="m-0"><strong>{{ __('faqs::messages.categories') }}</strong></h2>
    <div class="block-options pull-right">
      <a href="{{ route('faqs.categories.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
  </div>

  <form action="{{ route('faqs.categories.store') }}" method="post" class="form-bordered">
    @csrf

{{-- Locale Tabs --}}
<ul class="nav nav-tabs push" data-toggle="tabs">
  @foreach($langs as $i => $L)
    <li class="{{ $L->code === $activeLocale ? 'active' : '' }}">
      <a href="#tab-{{ $L->code }}">{{ $L->name }} ({{ $L->code }})</a>
    </li>
  @endforeach
</ul>
<div class="tab-content">
  @foreach($langs as $lang)
  <div class="tab-pane {{ $lang->code === $activeLocale ? 'active' : '' }}" id="tab-{{ $lang->code }}">
    <div class="form-group">
      <label>{{ __('faqs::messages.title_'.$lang->code) }}</label>
      <input type="text" name="title[{{ $lang->code }}]" class="form-control" value="{{ old('title.'.$lang->code, $category->title[$lang->code] ?? '') }}">
    </div>
  </div>
  @endforeach
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>{{ __('faqs::messages.slug') }}</label>
      <input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug ?? '') }}">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>{{ __('faqs::messages.order') }}</label>
      <input type="number" name="order" class="form-control" value="{{ old('order', $category->order ?? 0) }}">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>{{ __('faqs::messages.status') }}</label><br>
      <input type="hidden" name="status" value="0">
      <input type="checkbox" name="status" value="1" {{ old('status', $category->status ?? 1) ? 'checked' : '' }}>
    </div>
  </div>
</div>

    <div class="form-group">
      <button class="btn btn-primary">{{ __('faqs::messages.save') }}</button>
      <a href="{{ route('faqs.categories.index') }}" class="btn btn-default">{{ __('faqs::messages.cancel') }}</a>
    </div>
  </form>
</div>
@endsection
