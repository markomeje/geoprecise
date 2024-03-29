<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\{Survey, Sib, Psr, Plan, Reprinting};
use Validator;
use Exception;

class PlotController extends Controller
{
    //
    public function add()
    {
        $data = request()->all(['plot_number', 'model_id', 'model']);
        $validator = Validator::make($data, [
            'plot_number' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors(),
            ]);
        }

        $id = $data['model_id'] ?? null;
        switch ($data['model']) {
            case 'survey':
                $model = Survey::find($id);
                break;
            case 'sib':
                $model = Sib::find($id);
                break;
            case 'psr':
                $model = Psr::find($id);
                break;
            case 'plan':
                $model = Plan::find($id);
                break;
            case 'reprinting':
                $model = Reprinting::find($id);
                break;
            default:
                $model = null;
                break;
        }
        
        if (empty($model)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        }

        if ((boolean)($model->approved ?? 0) === true || (empty($model->payment) ? '' : $model->payment->status) === 'paid') {
            return response()->json([
                'status' => 0,
                'info' => 'Not allowed after Payment'
            ]);
        }

        $plot_number = $data['plot_number'] ?? '';
        $plot_numbers = str_contains($model->plot_numbers, '-') ? explode('-', $model->plot_numbers) : $model->plot_numbers;

        if (is_array($plot_numbers) && in_array($plot_number, $plot_numbers)) {
            return response()->json([
                'status' => 0,
                'info' => 'Plot number already added.',
            ]);
        }

        if(is_string($plot_numbers) && ($plot_numbers == $plot_number)) {
            return response()->json([
                'status' => 0,
                'info' => 'Plot number already added.',
            ]);
        }

        $model->plot_numbers = empty($model->plot_numbers) ? $plot_number : $model->plot_numbers.'-'.$plot_number;
        if(!empty($model->status)) {
            $model->status = 'active';
        }
        
        if($model->update()) {
            return response()->json([
                'status' => 1,
                'info' => 'Plot number added.',
                'redirect' => '',
            ]);
        }

        return response()->json([
            'status' => 0,
            'info' => 'Operatio failed. Try again.'
        ]);
    }

    public function delete()
    {
        $data = request()->all(['plot_number', 'model', 'model_id']);
        $model = $data['model'] ?? '';
        $id = $data['model_id'] ?? 0;
        $plot_number = $data['plot_number'] ?? '';

        if (empty($plot_number) || empty($model) || empty($id)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid operation. Try again.'
            ]);
        }

        switch ($model) {
            case 'survey':
                $model = Survey::find($id);
                break;
            case 'sib':
                $model = Sib::find($id);
                break;
            case 'psr':
                $model = Psr::find($id);
                break;
            default:
                $model = '';
                break;
        }

        if (empty($model)) {
            return response()->json([
                'status' => 0,
                'info' => 'Model not found.'
            ]);
        }

        // if ((boolean)($model->approved ?? 0) == true || (empty($model->payment) ? '' : $model->payment->status) == 'paid') {
        //     return response()->json([
        //         'status' => 0,
        //         'info' => 'Not allowed after payment or approval'
        //     ]);
        // }

        $plot_numbers = str_contains($model->plot_numbers, '-') ? explode('-', $model->plot_numbers) : $model->plot_numbers;
        if (is_array($plot_numbers)) {
            if (($key = array_search($plot_number, $plot_numbers)) !== false) {
                unset($plot_numbers[$key]);
            }

            $plot_numbers = implode('-', $plot_numbers);
        }else {
            $plot_numbers = null;
        }

        $model->plot_numbers = $plot_numbers;
        if ($model->update()) {
            return response()->json([
                'status' => 1,
                'info' => 'Operation successful.',
                'redirect' => ''
            ]);
        }

        return response()->json([
            'status' => 0,
            'info' => 'Operation failed. Try again.'
        ]);
    }

}
