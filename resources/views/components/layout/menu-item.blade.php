@props(['route' => '', 'icon' => ''])

@php
    $isActive = request()->routeIs($route);
@endphp

<a href="{{ route($route) }}" 
   class="flex items-center px-4 py-2 text-white rounded-md transition-colors {{ $isActive ? 'bg-indigo-800' : 'hover:bg-indigo-800' }}">
    <i class="{{ $icon }} w-5 h-5"></i>
    <span x-show="sidebarOpen" class="ml-3">{{ $slot }}</span>
</a>
