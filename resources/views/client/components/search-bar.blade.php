@props(['route', 'searchItem'])
<div class="position-relative">
    <form id="searchForm">
        <input type="text" name="search" class="form-control ps-5 radius-30"
            placeholder="{{ __('Search') }} {{ __($searchItem) }}" id="searchInput" value="">
        <button type="submit" class="d-none"></button> <!-- to submit the form -->
        <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
        <!-- Check if search query exists -->
        @if (request()->input('search'))
            <button type="button" onclick="window.location.href = '{{ $route }}'"
                class="position-absolute end-0 top-50 translate-middle-y border-0 bg-transparent me-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-x text-primary">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        @endif
    </form>

</div>
