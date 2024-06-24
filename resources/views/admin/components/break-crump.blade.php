@props(['title', 'page', 'subpage', 'exportRoute'])
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">{{ $title }}</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page }}</li>
                @if (!empty($subpage))
                    <li class="breadcrumb-item active" aria-current="page">{{ $subpage }}</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <button type="button" class="btn btn-primary">{{ __('Actions') }}</button>
            <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                <a class="dropdown-item" href="{{ route('users') }}">{{ __('Manage users') }}</a>
                <a class="dropdown-item" href="{{ route('manage.roles') }}">{{ __('Manage roles') }}</a>
                <div class="dropdown-divider"></div>
                <button type="button" class="dropdown-item" id="importButton" data-bs-toggle="modal"
                    data-bs-target="#importModal">
                    {{ __('Import users') }}
                </button>
                <a class="dropdown-item" href="{{ $exportRoute }}">{{ __('Export users') }}</a>
                <button class="dropdown-item" onclick="window.location.reload()">{{ __('Refresh page') }}</button>
            </div>
        </div>
    </div>
</div>
