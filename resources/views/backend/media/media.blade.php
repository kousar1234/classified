@if ($is_multiple)
    <div id="multipla-media-input-{{ $name }}">

    </div>
@else
    <input type="hidden" name="{{ $name }}" id="input-{{ $name }}" value="{{ $value }}">
@endif

<div class="image-box">
    <div class="d-flex flex-wrap gap-10">
        @if (!$is_multiple)
            <div class="media-input-container {{ $width == '100' ? 'w-100' : '' }}">
                <img src="{{ asset(getFilePath($value, true)) }}" alt="{{ $name }}" width="150"
                    class="media-input-preview {{ $width == '100' ? 'w-100' : '' }}"
                    id="media-input-preview-{{ $name }}" />
                <button type="button" title="Remove {{ $name }}" class="input-remove-btn"
                    onclick="removeFileInputValue('{{ $name }}','{{ getPlaceHolder() }}', {{ $is_multiple ? 'true' : 'false' }})"><i
                        class="fas fa-times"></i></button>
            </div>
        @endif

    </div>
    <div class="image-box-actions">
        <button type="button" class="btn-link bg-transparent border-0 media-choose-btn" id="in_choose"
            data-toggle="modal" data-target="#mediaManagerModal"
            onclick="getMediaModalData('{{ $name }}', {{ $media_ids }}, {{ $is_multiple ? 'true' : 'false' }})">
            {{ translation('Chosse File') }}
        </button>
    </div>
</div>
