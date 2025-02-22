@props(['route' => '', 'icon' => ''])

@php
    $isActive = request()->routeIs($route);
@endphp

<a wire:navigate href="{{ route($route) }}" 
   class="flex items-center px-4 py-2 text-white rounded-md transition-colors {{ $isActive ? 'bg-indigo-700' : 'hover:bg-indigo-700' }}">
    <i class="{{ $icon }} w-4 h-4"></i>
    <span x-show="sidebarOpen" class="ml-3 text-sm">{{ $slot }}</span>
</a>
