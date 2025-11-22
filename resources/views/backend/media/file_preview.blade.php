@if ($files->count() == 1)
    <h6 class="media-attachments-filter-heading mb-2">
        {{ translation('Media Details') }}
    </h6>
    <div class="attachment-details-wraper mt-30 mt-md-0">
        <div class="file-preview mb-3">
            <img src="{{ asset(getFilePath($files[0]->path)) }}" alt="{{ $files[0]->alt }}" class="w-100" />
        </div>
        <div class="attachment-details mb-3 pb-3 border-bottom2">
            <p class="attachment-info text-break"><span class="label">{{ translation('File Name:') }}</span>
                {{ $files[0]->title }}</p>
            <p class="attachment-info text-break"><span class="label">{{ translation('File Type:') }}</span>
                {{ $files[0]->mime_type }}
            </p>
            <p class="attachment-info text-break"><span class="label">{{ translation('File Size:') }}</span>
                {{ number_format($files[0]->size, 2) }} {{ translation('KB') }}
            </p>
            @if ($files[0]->user != null)
                <p class="attachment-info text-break"><span class="label">{{ translation('Uploaded By:') }}</span>
                    {{ $files[0]->user->name }}</p>
            @endif
            <p class="attachment-info text-break"><span class="label">{{ translation('Created At:') }}</span>
                {{ $files[0]->created_at->format('d M Y') }}</p>
            <p class="attachment-info text-break"><span class="label">{{ translation('Updated At:') }}</span>
                {{ $files[0]->updated_at->format('d M Y') }}</p>
        </div>
        <form class="d-none">
            <div class="d-flex gap-10 justify-content-end flex-wrap mt-2">
                <button type="button" class="btn btn-link text-danger">
                    {{ translation('Delete Permanently') }}
                </button>
            </div>
        </form>
    </div>
@else
    <h6 class="media-attachments-filter-heading mb-2">
        {{ $files->count() }} {{ translation('items selected') }}
    </h6>
    <div class="row">
        @foreach ($files as $file)
            <div class="col-lg-4 gap-1">
                <img src="{{ asset(getFilePath($file->path)) }}" alt="{{ $file->alt }}" class="w-100" />
            </div>
        @endforeach
    </div>
@endif
