@props(['importRoute', 'title'])
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">{{ __('Import') }} {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ $importRoute }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="position-relative mb-3">
                        <input type="file" name="file" class="form-control ps-5 radius-30" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-success">{{ __('Import') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
