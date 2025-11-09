@props(['page'])
<x-filament-fabricator::layouts.base :title="$page->title">

    <x-filament-fabricator::page-blocks :blocks="$page->blocks" />

     {{-- Footer Here --}}
</x-filament-fabricator::layouts.base>
