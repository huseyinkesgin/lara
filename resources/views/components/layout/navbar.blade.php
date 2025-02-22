<header class="bg-white shadow h-16">
    <div class="flex items-center justify-between h-full px-4">
        <div class="flex items-center space-x-4">
            <span class="text-lg font-semibold text-gray-800">{{ $header ?? '' }}</span>
        </div>
        
        <div class="flex items-center space-x-4">
            <!-- Profile dropdown -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="ml-1">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link href="{{ route('profile.show') }}">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-dropdown-link href="{{ route('logout') }}"
                                    @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</header>
