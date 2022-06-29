<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['web'])->domain(env('APP_URL'))->group(function() {
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/aboutus', [\App\Http\Controllers\AboutController::class, 'index'])->name('aboutus');
    Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact');
    Route::get('/ourprojects', [\App\Http\Controllers\OurProjectController::class, 'index'])->name('ourprojects');
    Route::get('/ourteam', [\App\Http\Controllers\OurTeamController::class, 'index'])->name('ourteam');
    Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog');
    Route::get('/faq', [\App\Http\Controllers\FAQController::class, 'index'])->name('faq');
    Route::get('/ourservices', [\App\Http\Controllers\OurServicesController::class, 'index'])->name('ourservices');

    Route::get('/engineering', [\App\Http\Controllers\EngineeringController::class, 'index'])->name('engineering');
    Route::get('/cadastral', [\App\Http\Controllers\CadastralController::class, 'index'])->name('cadastral');
    Route::get('/aerial', [\App\Http\Controllers\AerialController::class, 'index'])->name('aerial');
    Route::get('/mapping', [\App\Http\Controllers\MappingController::class, 'index'])->name('mapping');
    Route::get('/sensing', [\App\Http\Controllers\RemotesensingController::class, 'index'])->name('sensing');
    Route::get('/hydrographic', [\App\Http\Controllers\HydrographicController::class, 'index'])->name('hydrographic');
    Route::get('/highway', [\App\Http\Controllers\HighwayRoadController::class, 'index'])->name('highway');
    Route::get('/services', [\App\Http\Controllers\ServicesController::class, 'index'])->name('services');
    
    Route::get('/godwin', [\App\Http\Controllers\GodwinController::class, 'index'])->name('godwin');
    Route::get('/hilary', [\App\Http\Controllers\HilaryController::class, 'index'])->name('hilary');
    Route::get('/john', [\App\Http\Controllers\JohnPreciousController::class, 'index'])->name('john');
    Route::get('/kerry', [\App\Http\Controllers\KerryController::class, 'index'])->name('kerry');
    Route::get('/merit', [\App\Http\Controllers\MeritController::class, 'index'])->name('merit');
    Route::get('/benjamin', [\App\Http\Controllers\BenjaminController::class, 'index'])->name('benjamin');
    Route::get('/team', [\App\Http\Controllers\TeamController::class, 'index'])->name('team');
    
});
