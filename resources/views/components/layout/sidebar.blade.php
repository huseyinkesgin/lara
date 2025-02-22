<aside class="sidebar fixed top-0 left-0 z-40 h-screen text-sm" :class="sidebarOpen ? 'w-64' : 'w-16'" style="background-color: #1a237e;">
    <!-- Logo -->
    <div class="flex items-center justify-between h-16 px-4 text-white border-b border-indigo-800">
        <div class="flex items-center" :class="sidebarOpen ? 'justify-between w-full' : 'justify-center'">
            <span x-show="sidebarOpen" class="text-lg font-semibold">{{ config('app.name') }}</span>
            <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-md hover:bg-indigo-800">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="mt-4 px-2">
        <div class="space-y-1">
            <x-layout.menu-item route="dashboard" icon="fas fa-home">
                Dashboard
            </x-layout.menu-item>

            <x-layout.menu-group icon="fas fa-map-marked-alt" title="Lokasyon">
                <x-layout.menu-sub-item route="cities" icon="fas fa-city">
                    İller
                </x-layout.menu-sub-item>
                <x-layout.menu-sub-item route="towns" icon="fas fa-building">
                    İlçeler
                </x-layout.menu-sub-item>
                <x-layout.menu-sub-item route="districts" icon="fas fa-map-marker-alt">
                    Semtler
                </x-layout.menu-sub-item>
                <x-layout.menu-sub-item route="neighborhoods" icon="fas fa-home">
                    Mahalleler
                </x-layout.menu-sub-item>
            </x-layout.menu-group>

            <x-layout.menu-group icon="fas fa-briefcase" title="İletişim">
                <x-layout.menu-sub-item route="companies" icon="fas fa-building">
                    Firmalar
                </x-layout.menu-sub-item>
                <x-layout.menu-sub-item route="customers" icon="fas fa-user">
                    Müşteriler
                </x-layout.menu-sub-item>
                <x-layout.menu-sub-item route="personnels" icon="fas fa-user-tie">
                    Personel
                </x-layout.menu-sub-item>
            </x-layout.menu-group>
        </div>
    </nav>
</aside>
