@extends('core::layouts.backend')

@push('title') {{ __('statistics::messages.edit_statistics') }} @endpush

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="/cp"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('statistics.index') }}">{{ __('statistics::messages.statistics') }}</a></li>
    <li>{{ __('statistics::messages.edit') }}</li>
</ul>

<div class="block full">
    <div class="block-title d-flex align-items-center justify-content-between">
        <h2 class="m-0"><strong>{{ __('statistics::messages.edit_statistics') }} :</strong>
            {{ data_get($statistics->title, app()->getLocale(), data_get($statistics->title, 'en')) }}</h2>
        <div class="block-options pull-right">
            <a href="{{ route('statistics.index') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-arrow-left me-1"></i> {{ __('statistics::messages.back') }}
            </a>
        </div>
    </div>

    <form action="{{ route('statistics.update', ['statistics' => $statistics->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Tabs الرئيسية --}}
        <ul class="nav nav-tabs push" id="mainLangTabs" data-toggle="tabs">
            @foreach($langs as $i => $L)
                <li class="{{ $L->code === $activeLocale ? 'active' : '' }}">
                    <a href="#tab-{{ $L->code }}" data-lang="{{ $L->code }}">{{ $L->name }} ({{ $L->code }})</a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content">
            @foreach($langs as $lang)
                <div class="tab-pane {{ $lang->code === $activeLocale ? 'active' : '' }}" id="tab-{{ $lang->code }}" data-lang="{{ $lang->code }}">
                    {{-- Title --}}
                    <div class="form-group">
                        <label>{{ __('statistics::messages.title_' . $lang->code) }}</label>
                        <input type="text" name="title[{{ $lang->code }}]" class="form-control"
                               value="{{ old('title.' . $lang->code, $statistics->title[$lang->code] ?? '') }}"
                               placeholder="{{ __('statistics::messages.enter_title_' . $lang->code) }}">
                    </div>

                    {{-- Short Description --}}
                    <div class="form-group">
                        <label>{{ __('statistics::messages.short_description_' . $lang->code) }}</label>
                        <input type="text" name="short_description[{{ $lang->code }}]" class="form-control main-short-description"
                               value="{{ old('short_description.' . $lang->code, $statistics->short_description[$lang->code] ?? '') }}"
                               placeholder="{{ __('statistics::messages.enter_short_description_' . $lang->code) }}">
                    </div>

                    {{-- Description --}}
                    <div class="form-group">
                        <label>{{ __('statistics::messages.description_' . $lang->code) }}</label>
                        <textarea name="description[{{ $lang->code }}]" class="form-control" rows="4" id="editor-description-{{ $lang->code }}"
                                  placeholder="{{ __('statistics::messages.enter_description_' . $lang->code) }}">{{ old('description.' . $lang->code, $statistics->description[$lang->code] ?? '') }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-4">
            {{-- Image --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('statistics::messages.image') }}</label>
                    @if(!empty($statistics->image))
                        <div style="margin-bottom: 10px;">
                            <img src="{{ asset('storage/' . $statistics->image) }}" alt="Current Image"
                                 style="max-width: 150px; border: 1px solid #ddd; padding: 3px; border-radius: 4px;">
                        </div>
                    @endif
                    <input type="file" name="image" class="file-input" accept="image/*">
                </div>
            </div>

            {{-- Order --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('statistics::messages.order') }}</label>
                    <input type="number" name="order" class="form-control" min="0"
                           value="{{ old('order', $statistics->order) }}">
                </div>
            </div>

            {{-- Status --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('statistics::messages.status') }}</label>
                    <div>
                        <input type="hidden" name="status" value="0">
                        <label class="switch switch-danger">
                            <input type="checkbox" name="status" value="1" {{ old('status', $statistics->status) ? 'checked' : '' }}>
                            <span></span>
                        </label>
                        <span class="ms-2 align-middle">{{ __('statistics::messages.active') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistics Details --}}
        <h4 class="mt-4">{{ __('statistics::messages.details') }}</h4>
        <table class="table table-bordered" id="detailsTable">
            <thead>
            <tr>
                <th>{{ __('statistics::messages.number') }}</th>
                @foreach($langs as $lang)
                    <th>{{ __('statistics::messages.short_description_'.$lang->code) }}</th>
                @endforeach
                <th>{{ __('statistics::messages.icon') }}</th>
                <th>{{ __('statistics::messages.action') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($statistics->details as $index => $detail)
                <tr>
                    <td>
                        <input type="text" name="details[{{ $index }}][number]" class="form-control"
                               value="{{ $detail->number }}">
                    </td>
                    @foreach($langs as $lang)
                        <td>
                            <input type="text" name="details[{{ $index }}][short_description][{{ $lang->code }}]"
                                   class="form-control detail-short-description"
                                   value="{{ $detail->short_description[$lang->code] ?? '' }}"
                                   placeholder="{{ __('statistics::messages.short_description_' . $lang->code) }}">
                        </td>
                    @endforeach
                    <td>
                        @if(!empty($detail->icon))
                            <div style="margin-bottom: 10px;">
                                <img src="{{ asset('storage/' . $detail->icon) }}" alt="Icon"
                                     style="max-width: 50px; border: 1px solid #ddd; padding: 3px; border-radius: 4px;">
                            </div>
                            <input type="hidden" name="details[{{ $index }}][id]" value="{{ $detail->id }}">
                            <input type="hidden" name="details[{{ $index }}][icon_old]" value="{{ $detail->icon }}">
                        @endif
                        <input type="file" name="details[{{ $index }}][icon]" class="file-input" accept="image/*">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-row">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <button type="button" id="addRow" class="btn btn-sm btn-primary">
            <i class="fa fa-plus"></i> {{ __('statistics::messages.add_detail') }}
        </button>

        {{-- Actions --}}
        <div class="form-group form-actions mt-4">
            <button class="btn btn-sm btn-success"><i class="fa fa-save"></i> {{ __('statistics::messages.update') }}</button>
            <a href="{{ route('statistics.index') }}" class="btn btn-sm btn-warning">
                <i class="fa fa-repeat"></i> {{ __('statistics::messages.cancel') }}
            </a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    let rowIndex = {{ $statistics->details->count() }};
    const langs = @json($langs->pluck('code'));

    const mainLangTabs = document.querySelectorAll('#mainLangTabs a[data-lang]');
    mainLangTabs.forEach(tab => {
        tab.addEventListener('click', function(e){
            e.preventDefault();
            const selectedLang = this.getAttribute('data-lang');

            document.querySelectorAll('.detail-short-description').forEach(input => {
                const row = input.closest('tr').rowIndex - 1;
                input.name = `details[${row}][short_description][${selectedLang}]`;
                input.placeholder = "{{ __('statistics::messages.short_description_') }}" + selectedLang;
            });
        });
    });

    document.getElementById("addRow").addEventListener("click", function () {
        let tableBody = document.querySelector("#detailsTable tbody");
        let newRow = document.createElement("tr");

        let inputsHtml = `<td><input type="text" name="details[\${rowIndex}][number]" class="form-control"></td>`;
        langs.forEach(lang => {
            inputsHtml += `<td><input type="text" name="details[\${rowIndex}][short_description][${lang}]" class="form-control detail-short-description" placeholder="{{ __('statistics::messages.short_description_') }}${lang}"></td>`;
        });
        inputsHtml += `<td><input type="file" name="details[\${rowIndex}][icon]" class="file-input" accept="image/*"></td>`;
        inputsHtml += `<td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button></td>`;

        newRow.innerHTML = inputsHtml;
        tableBody.appendChild(newRow);
        rowIndex++;
    });

    document.addEventListener("click", function (e) {
        if (e.target.closest(".remove-row")) {
            e.target.closest("tr").remove();
        }
    });

    @foreach($langs as $lang)
        initCkEditor('editor-description-{{ $lang->code }}');
    @endforeach
});
</script>
@endpush
