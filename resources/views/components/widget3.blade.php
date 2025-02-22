@props([ 'title' => null, 'icon' => null])

<div class="items-center gap-3 p-3 bg-gradient-to-r
 from-yellow-500 to-orange-500 text-white rounded-lg shadow-md justify-center border border-yellow-500">
    <div>
        <h1 class="text-2xl font-semibold"><i class="fas {{ $icon }} mr-2"></i>{{ $title }}</h1>
    </div>
    <div class="pt-3 text-4xl font-bold text-center">{{ $slot }}</div>
</div>
