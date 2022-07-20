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
    Route::get('/bluelake', [\App\Http\Controllers\BlueLakeController::class, 'index'])->name('bluelake');
    Route::get('/choicecity', [\App\Http\Controllers\ChoicecityController::class, 'index'])->name('choicecity');
    Route::get('/destiny', [\App\Http\Controllers\DestinyLayoutController::class, 'index'])->name('destiny');
    Route::get('/gateway', [\App\Http\Controllers\GatewayLayoutController::class, 'index'])->name('gateway');
    Route::get('/goldengate', [\App\Http\Controllers\GoldenGateController::class, 'index'])->name('goldengate');
    Route::get('/moniclayout', [\App\Http\Controllers\MonicLayoutController::class, 'index'])->name('moniclayout');
    Route::get('/peacelayout', [\App\Http\Controllers\PeaceLayoutController::class, 'index'])->name('peacelayout');
    Route::get('/rosary', [\App\Http\Controllers\OurladyController::class, 'index'])->name('rosary');
    Route::get('/civilservant', [\App\Http\Controllers\CivilservantController::class, 'index'])->name('civilservant');
    Route::get('/godfrey', [\App\Http\Controllers\GodfreyOkoyeController::class, 'index'])->name('godfrey');
    Route::get('/plentiff', [\App\Http\Controllers\PlentiffController::class, 'index'])->name('plentiff');
    Route::get('/housing', [\App\Http\Controllers\HousingController::class, 'index'])->name('housing');
    Route::get('/forms', [\App\Http\Controllers\FormsController::class, 'index'])->name('forms');
    Route::get('/propertysearchform', [\App\Http\Controllers\PropertySearchFormController::class, 'index'])->name('propertysearchform');
    Route::get('/plancollectionform', [\App\Http\Controllers\PlanCollectionFormController::class, 'index'])->name('plancollectionform');
    Route::get('/cisform', [\App\Http\Controllers\CISFormsController::class, 'index'])->name('cisform');
    Route::get('/applicationform', [\App\Http\Controllers\ApplicationFormsController::class, 'index'])->name('applicationform');
    Route::get('/siteinspectionform', [\App\Http\Controllers\SiteInspectionFormController::class, 'index'])->name('siteinspectionform');

   Route::get('/apartmentdesign', [\App\Http\Controllers\ApartmentController::class, 'index'])->name('apartmentdesign');
   Route::get('/bridge', [\App\Http\Controllers\BridgeContractController::class, 'index'])->name('bridge');
   Route::get('/buildingconstruction', [\App\Http\Controllers\BuildingConstructionController::class, 'index'])->name('buildingconstruction');
   Route::get('/chikeanigbo', [\App\Http\Controllers\ChikeanigboController::class, 'index'])->name('chikeanigbo');
   Route::get('/enugustate', [\App\Http\Controllers\EnugustateController::class, 'index'])->name('enugustate');
   Route::get('/highwaycontract', [\App\Http\Controllers\HighwaycontractController::class, 'index'])->name('highwaycontract');
   Route::get('/housingplanning', [\App\Http\Controllers\HousePlanningController::class, 'index'])->name('housingplanning');
   Route::get('/institutedesign', [\App\Http\Controllers\InstituteDesignController::class, 'index'])->name('institutedesign');
   Route::get('/malldesign', [\App\Http\Controllers\MalldesignController::class, 'index'])->name('malldesign');
   Route::get('/nwoko', [\App\Http\Controllers\NwokoFamilyController::class, 'index'])->name('nwoko');
   Route::get('/railwayconstruction', [\App\Http\Controllers\RailwayconstructionController::class, 'index'])->name('railwayconstruction');
   Route::get('/triumphantlayout', [\App\Http\Controllers\TriumphantlayoutController::class, 'index'])->name('triumphantlayout');
   Route::get('/umuobunafamily', [\App\Http\Controllers\UmuobunafamilyController::class, 'index'])->name('umuobunafamily');
   Route::get('/umuokofamily', [\App\Http\Controllers\UmuokofamilyController::class, 'index'])->name('umuokofamily');
   Route::get('/uprightlayout', [\App\Http\Controllers\UprightAlayoutController::class, 'index'])->name('uprightlayout');
   Route::get('/victorylayout', [\App\Http\Controllers\VictoryController::class, 'index'])->name('victorylayout');
   Route::get('/uprightcity', [\App\Http\Controllers\UprightCityController::class, 'index'])->name('uprightcity');

    
});
