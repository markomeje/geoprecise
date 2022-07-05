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
    Route::get('/geopadmin', [\App\Http\Controllers\GeopadminController::class, 'index'])->name('geopadmin');
    Route::get('/commercial', [\App\Http\Controllers\CommercialController::class, 'index'])->name('commercial');
    Route::get('/construction', [\App\Http\Controllers\ConstructionController::class, 'index'])->name('construction');
    Route::get('/interior', [\App\Http\Controllers\PlanningController::class, 'index'])->name('interior');
    Route::get('/technology', [\App\Http\Controllers\TechnologyController::class, 'index'])->name('technology');
    Route::get('/standard', [\App\Http\Controllers\StandardController::class, 'index'])->name('standard');
    Route::get('/innovation', [\App\Http\Controllers\InnovationController::class, 'index'])->name('innovation');
    Route::get('/improve', [\App\Http\Controllers\ImproveController::class, 'index'])->name('improve');
    Route::get('/education', [\App\Http\Controllers\EducationController::class, 'index'])->name('education');
    Route::get('/categoryconstruction', [\App\Http\Controllers\CategoryConstructionController::class, 'index'])->name('categoryconstruction');
    Route::get('/building', [\App\Http\Controllers\BuildingController::class, 'index'])->name('building');
    Route::get('/benefit', [\App\Http\Controllers\BenefitController::class, 'index'])->name('benefit');
    Route::get('/3dprint', [\App\Http\Controllers\DPrintController::class, 'index'])->name('3dprint');
    Route::get('/design', [\App\Http\Controllers\DesignController::class, 'index'])->name('design');
    Route::get('/business', [\App\Http\Controllers\BusinessController::class, 'index'])->name('business');
    Route::get('/department', [\App\Http\Controllers\DepartmentController::class, 'index'])->name('department');
    Route::get('/marketing', [\App\Http\Controllers\MarketingController::class, 'index'])->name('marketing');
    Route::get('/resource', [\App\Http\Controllers\ResourcesController::class, 'index'])->name('resource');
    Route::get('/partner', [\App\Http\Controllers\PartnerController::class, 'index'])->name('partner');
    Route::get('/agreement', [\App\Http\Controllers\AgreementConstructionController::class, 'index'])->name('agreement');
    Route::get('/industry', [\App\Http\Controllers\IndustryConstructionController::class, 'index'])->name('industry');
    Route::get('/cleaning', [\App\Http\Controllers\IndustrialCleaningController::class, 'index'])->name('cleaning');
    Route::get('/cleaning05', [\App\Http\Controllers\Cleaning05Controller::class, 'index'])->name('cleaning05');
    Route::get('/cleaning06', [\App\Http\Controllers\Cleaning06Controller::class, 'index'])->name('cleaning06');
    Route::get('/archive', [\App\Http\Controllers\ArchiveController::class, 'index'])->name('archive');
    Route::get('/archive01', [\App\Http\Controllers\Archive01Controller::class, 'index'])->name('archive01');
    Route::get('/archive03', [\App\Http\Controllers\Archive03Controller::class, 'index'])->name('archive03');
    Route::get('/archive04', [\App\Http\Controllers\Archive04Controller::class, 'index'])->name('archive04');
    Route::get('/archive06', [\App\Http\Controllers\Archive06Controller::class, 'index'])->name('archive06');
    Route::get('/archive12', [\App\Http\Controllers\Archive12Controller::class, 'index'])->name('archive12');
    Route::get('/archive18', [\App\Http\Controllers\Archive18Controller::class, 'index'])->name('archive18');
});
