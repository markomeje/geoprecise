<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Plot, Client, Survey, Form, Staff};
use Carbon\Carbon;
use Validator;
use Pdf;

class SurveysController extends Controller
{
    //
    public function index($limit = 20)
    {
        return view('admin.surveys.index', ['title' => 'All Surveys', 'surveys' => Survey::latest()->paginate($limit)]);
    }

    public function pdf($id) {
        $survey = Survey::find($id);
        if (empty($survey)) return [];

        $pdf = Pdf::loadView('admin.surveys.pdf', ['survey' => $survey]);
        $fileName = \Str::slug(ucwords($survey->client_name));
        return $pdf->download('report.pdf');
    }

    //
    public function approve($id = 0)
    {
        return view('admin.surveys.approve', ['title' => 'Approval Surveying Application', 'survey' => Survey::find($id)]);
    }

    public function search()
    {
        $query = request()->get('search');
        $surveys = Survey::search(['client.fullname', 'seller_name', 'seller_address', 'client.phone', 'purchaser_name', 'purchaser_address', 'approval_name', 'approval_address'], $query)->paginate(24);
        return view('admin.surveys.search')->with(['surveys' => $surveys]);
    }
}
