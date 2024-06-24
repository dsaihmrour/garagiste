<div id="successAlert" style="transition: opacity 0.5s ease-in-out; display:none"
    class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
    <div class="d-flex align-items-center">
        <div class="font-35 text-white"><i class='bx bxs-check-circle'></i></div>
        <div class="ms-3">
            <h6 class="mb-0 text-white">{{ __('Success Alert') }}</h6>
            <div class="text-white" id="alertSubTitle">{{ __('Success message') }}</div>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('Close') }}"></button>
</div>
