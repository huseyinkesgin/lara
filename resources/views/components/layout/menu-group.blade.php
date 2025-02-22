@props(['title' => '', 'icon' => ''])

@php
    $hasActiveChild = collect($attributes->get('routes', []))->contains(function($route) {
        return request()->routeIs($route);
    });
@endphp

<div class="menu-group" x-data="{ open: @json($hasActiveChild) }">
    <button @click="open = !open" 
            class="w-full flex items-center px-4 py-2 text-white rounded-md transition-colors hover:bg-indigo-800"
            :class="{ 'bg-indigo-800': open }">
        <i class="{{ $icon }} w-5 h-5"></i>
        <span x-show="sidebarOpen" class="ml-3 flex-1 text-left">{{ $title }}</span>
        <i x-show="sidebarOpen" class="fas fa-chevron-down w-5 h-5 transition-transform" :class="{ 'transform rotate-180': open }"></i>
    </button>

    <div x-show="open" x-collapse class="mt-1 space-y-1 pl-4">
        {{ $slot }}
    </div>
</div>
