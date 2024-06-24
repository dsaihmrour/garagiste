@props(['exportRoute', 'title'])
<form action="{{ $exportRoute }}" method="GET" class="dropdown-item">
    @csrf
    <button type="submit" style="background-color: transparent" class="border-0">{{ __('Export') }}
        {{ __($title) }}</button>
</form>
