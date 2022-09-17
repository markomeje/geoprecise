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

    Route::get('/login', function () {
        return redirect()->route('login.ui');
    })->name('login');

    Route::get('/signup', function () {
        return redirect()->route('signup.ui');
    })->name('signup');

    Route::get('/logout', function () {
        return redirect()->route('auth.logout');
    })->name('logout');

    Route::prefix('image')->group(function () {
        Route::post('/upload', [\App\Http\Controllers\Admin\ImagesController::class, 'upload'])->name('admin.image.upload');
        Route::match(['delete', 'post'], '/delete', [\App\Http\Controllers\Admin\ImagesController::class, 'delete'])->name('admin.image.delete');
    });
});

/**
 * Everything to do with account authentication, verification and authorization
 */
Route::middleware(['web'])->domain(env('AUTH_URL'))->group(function() {
    Route::get('/', function () {
        return redirect()->route('home'); 
    });

    Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('auth.logout');
    Route::middleware(['guest'])->group(function() {
        Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login.ui');
        Route::get('/signup', [\App\Http\Controllers\Auth\SignupController::class, 'index'])->name('signup.ui');
        Route::post('/signup', [\App\Http\Controllers\Auth\SignupController::class, 'signup'])->name('auth.signup');
        Route::post('/signup/verify', [\App\Http\Controllers\Auth\SignupController::class, 'verify'])->name('signup.verify');

        Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('auth.login');
        Route::post('/email/verify', [\App\Http\Controllers\Auth\SignupController::class, 'signup'])->name('email.verify');
    });
});

Route::domain(env('ADMIN_URL'))->middleware(['auth', 'admin'])->group(function() {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin');
    Route::prefix('clients')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\ClientsController::class, 'index'])->name('admin.clients');
        Route::get('/profile/{id}', [\App\Http\Controllers\Admin\ClientsController::class, 'profile'])->name('admin.clients.profile');
        Route::post('/add', [\App\Http\Controllers\Admin\ClientsController::class, 'add'])->name('admin.client.add');
    });

    Route::prefix('staff')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\StaffController::class, 'index'])->name('admin.staff');
        Route::get('/profile/{id}', [\App\Http\Controllers\Admin\StaffController::class, 'profile'])->name('admin.staff.profile');
        Route::post('/add', [\App\Http\Controllers\Admin\StaffController::class, 'add'])->name('admin.staff.add');
    });

    Route::prefix('payments')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\PaymentsController::class, 'index'])->name('admin.payments');
        Route::post('/record', [\App\Http\Controllers\Admin\PaymentsController::class, 'record'])->name('admin.payment.record');
        Route::post('/approve', [\App\Http\Controllers\Admin\PaymentsController::class, 'approve'])->name('admin.payment.approve');
    });

    Route::prefix('fees')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\FeesController::class, 'index'])->name('admin.fees');
    });

    Route::prefix('layouts')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\LayoutsController::class, 'index'])->name('admin.layouts');
        Route::post('/add', [\App\Http\Controllers\Admin\LayoutsController::class, 'add'])->name('admin.layout.add');
        Route::post('/edit/{id}', [\App\Http\Controllers\Admin\LayoutsController::class, 'edit'])->name('admin.layout.edit');
        Route::get('/plots/{id}/{name}', [\App\Http\Controllers\Admin\LayoutsController::class, 'plots'])->name('admin.layouts.plots');
    });

    Route::prefix('psrs')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\PsrsController::class, 'index'])->name('admin.psrs');
        Route::post('/add/{client_id}', [\App\Http\Controllers\Admin\PsrsController::class, 'add'])->name('admin.psr.add');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\PsrsController::class, 'delete'])->name('admin.psr.delete');
        
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\PsrsController::class, 'edit'])->name('admin.psr.edit');
        Route::post('/save/{id}', [\App\Http\Controllers\Admin\PsrsController::class, 'save'])->name('admin.psr.save');
        Route::get('/plots/{id}/{name}', [\App\Http\Controllers\Admin\PsrsController::class, 'plots'])->name('admin.layouts.plots');
    });

    Route::prefix('plots')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\PlotsController::class, 'index'])->name('admin.plots');
        Route::post('/add', [\App\Http\Controllers\Admin\PlotsController::class, 'add'])->name('admin.plot.add');
        Route::post('/edit/{id}', [\App\Http\Controllers\Admin\PlotsController::class, 'edit'])->name('admin.plot.edit');
    });

    Route::prefix('surveys')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\SurveysController::class, 'index'])->name('admin.surveys');
        Route::post('/add/{client_id}', [\App\Http\Controllers\Admin\SurveysController::class, 'add'])->name('admin.survey.add');
        Route::post('/save/{id}', [\App\Http\Controllers\Admin\SurveysController::class, 'save'])->name('admin.survey.save');

        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\SurveysController::class, 'edit'])->name('admin.survey.edit');
        Route::get('/apply/{client_id}', [\App\Http\Controllers\Admin\SurveysController::class, 'apply'])->name('admin.survey.apply');

        Route::post('/plot/add', [\App\Http\Controllers\Client\PlotController::class, 'add'])->name('admin.client.plot.add');
        Route::post('/plot/delete', [\App\Http\Controllers\Client\PlotController::class, 'delete'])->name('admin.client.plot.delete');
    });

    Route::prefix('documents')->group(function () {
        Route::get('/', [\App\Http\Controllers\DocumentsController::class, 'index'])->name('admin.documents');
        Route::post('/upload', [\App\Http\Controllers\DocumentsController::class, 'upload'])->name('admin.document.upload');
        Route::post('/change', [\App\Http\Controllers\DocumentsController::class, 'change'])->name('admin.document.change');

        Route::post('/delete/{id}', [\App\Http\Controllers\DocumentsController::class, 'delete'])->name('admin.document.delete'); 
    });

    Route::prefix('sibs')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\PsrsController::class, 'index'])->name('admin.sibs');
    });

    Route::prefix('pcfs')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\PcfsController::class, 'index'])->name('admin.pcfs');
    });
});

Route::domain(env('CLIENT_URL'))->middleware(['auth', 'client'])->group(function() {
    Route::get('/', [\App\Http\Controllers\Client\DashboardController::class, 'index'])->name('client');
    Route::get('/profile', [\App\Http\Controllers\Client\ProfileController::class, 'index'])->name('client.profile');

    Route::prefix('documents')->group(function () {
        Route::get('/', [\App\Http\Controllers\DocumentsController::class, 'index'])->name('client.documents');
        Route::post('/upload', [\App\Http\Controllers\DocumentsController::class, 'upload'])->name('client.document.upload');
        Route::post('/change', [\App\Http\Controllers\DocumentsController::class, 'change'])->name('client.document.change');

        Route::post('/delete/{id}', [\App\Http\Controllers\DocumentsController::class, 'delete'])->name('client.document.delete'); 
    });

    Route::prefix('plots')->group(function () {
        Route::get('/', [\App\Http\Controllers\Client\ProfileController::class, 'index'])->name('client.plots');
        Route::post('/add', [\App\Http\Controllers\Client\PlotController::class, 'add'])->name('client.plot.add');
        Route::post('/delete', [\App\Http\Controllers\Client\PlotController::class, 'delete'])->name('client.plot.delete');
    });

    Route::get('/payments', [\App\Http\Controllers\Client\PaymentController::class, 'index'])->name('client.payments');
    Route::post('/payment/process', [\App\Http\Controllers\Client\PaymentController::class, 'pay'])->name('payment.process');

    Route::post('/profile/edit/{id}', [\App\Http\Controllers\Client\ProfileController::class, 'edit'])->name('client.profile.edit');

    Route::prefix('forms')->group(function () {
        Route::get('/', [\App\Http\Controllers\Client\FormsController::class, 'index'])->name('client.forms');
        Route::get('/{id}/{slug}', [\App\Http\Controllers\Client\FormsController::class, 'form'])->name('client.form');
    });

    Route::prefix('psr')->group(function () {
        Route::post('/save', [\App\Http\Controllers\Client\PsrController::class, 'save'])->name('client.psr.save');
    });

    Route::prefix('survey')->group(function () {
        Route::post('/add', [\App\Http\Controllers\Client\SurveyController::class, 'add'])->name('client.survey.add');
        Route::get('/edit/{id}', [\App\Http\Controllers\Client\SurveyController::class, 'edit'])->name('client.survey.edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Client\SurveyController::class, 'edit'])->name('client.survey.update');
    });

    Route::prefix('sib')->group(function () {
        Route::post('/add', [\App\Http\Controllers\Client\SibController::class, 'add'])->name('client.sib.add');
        Route::get('/edit/{id}', [\App\Http\Controllers\Client\SibController::class, 'edit'])->name('client.sib.edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Client\SibController::class, 'edit'])->name('client.sib.update');
    });
});
