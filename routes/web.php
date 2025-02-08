<?php


use App\Livewire\Location\CityIndex;
use App\Livewire\Location\DistrictIndex;
use App\Livewire\Location\NeighbourhoodIndex;
use App\Livewire\Contact\CompanyIndex;
use App\Livewire\Contact\CustomerIndex;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('cities',CityIndex::class)->name('cities');
Route::get('districts',DistrictIndex::class)->name('districts');
Route::get('neighbourhoods',NeighbourhoodIndex::class)->name('neighbourhoods');
Route::get('companies',CompanyIndex::class)->name('companies');
Route::get('customers',CustomerIndex::class)->name('customers');
