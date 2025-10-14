@extends('core::layouts.backend')

@push('title') {{ __('faqs::messages.faqs') }} @endpush
@section('content')
<ul class="breadcrumb breadcrumb-top">
  <li><a href="/cp"><i class="fa fa-home"></i></a></li>
  <li><a href="{{ route('faqs.index') }}">{{ __('faqs::messages.faqs') }}</a></li>
  <li>{{ __('faqs::messages.edit') }}</li>
</ul>

<div class="block full">
  <div class="block-title d-flex align-items-center justify-content-between">
    <h2 class="m-0"><strong>{{ __('faqs::messages.faqs') }}</strong></h2>
    <div class="block-options pull-right">
      <a href="{{ route('faqs.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
  </div>

  <form action="{{ route('faqs.update', $faq) }}" method="post" class="form-bordered">
    @csrf @method('PUT')

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
      <label>{{ __('faqs::messages.question_'.$lang->code) }}</label>
      <input type="text" name="question[{{ $lang->code }}]" class="form-control" value="{{ old('question.'.$lang->code, $faq->question[$lang->code] ?? '') }}">
    </div>
    <div class="form-group">
      <label>{{ __('faqs::messages.answer_'.$lang->code) }}</label>
      <textarea name="answer[{{ $lang->code }}]" class="form-control" rows="4">{{ old('answer.'.$lang->code, $faq->answer[$lang->code] ?? '') }}</textarea>
    </div>
  </div>
  @endforeach
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>{{ __('faqs::messages.category') }}</label>
      <select name="category_id" class="form-control">
        <option value="">{{ __('faqs::messages.categories') }}</option>
        @foreach($categories as $cat)
          <option value="{{ $cat->id }}" {{ (old('category_id', $faq->category_id ?? '')==$cat->id)?'selected':'' }}>
            {{ $cat->title['ar'] ?? $cat->title['en'] ?? '—' }}
          </option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group">
      <label>{{ __('faqs::messages.order') }}</label>
      <input type="number" name="order" class="form-control" value="{{ old('order', $faq->order ?? 0) }}">
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>{{ __('faqs::messages.status') }}</label><br>
      <input type="hidden" name="status" value="0">
      <input type="checkbox" name="status" value="1" {{ old('status', $faq->status ?? 1) ? 'checked' : '' }}>
    </div>
  </div>
</div>

    <div class="form-group">
      <button class="btn btn-primary">{{ __('faqs::messages.save') }}</button>
      <a href="{{ route('faqs.index') }}" class="btn btn-default">{{ __('faqs::messages.cancel') }}</a>
    </div>
  </form>
</div>
@endsection
