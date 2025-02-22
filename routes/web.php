<?php


use App\Livewire\Location\CityIndex;
use App\Livewire\Portfolio\LandIndex;
use Illuminate\Support\Facades\Route;
use App\Livewire\Contact\CompanyIndex;
use App\Livewire\Contact\CustomerIndex;
use App\Livewire\Contact\PersonnelIndex;
use App\Livewire\Location\DistrictIndex;
use App\Livewire\Location\NeighborhoodIndex;
use App\Livewire\Location\TownIndex;



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
Route::get('towns',TownIndex::class)->name('towns');
Route::get('districts',DistrictIndex::class)->name('districts');
Route::get('neighborhoods',NeighborhoodIndex::class)->name('neighborhoods');


Route::get('companies',CompanyIndex::class)->name('companies');
Route::get('customers',CustomerIndex::class)->name('customers');
Route::get('personnels',PersonnelIndex::class)->name('personnels');
Route::get('lands',LandIndex::class)->name('lands');
